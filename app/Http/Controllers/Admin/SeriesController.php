<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Series;
use App\Models\SeriesDetail;
use App\Models\Icon;
use App\Models\Feature;
use App\Enums\Category;
use App\Enums\Genre;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SeriesController extends Controller
{
    protected function query(Request $request) {
        $keyword = $request->keyword ? $request->keyword : old('keyword');
        $query = Series::query();
        if ($keyword) {
            $query->join('series_details', 'series.id', '=', 'series_details.series_id');
            foreach (preg_split('/[ 　]++/', $keyword, 0, PREG_SPLIT_NO_EMPTY) as $key) {
                $query->whereAny([
                    'series.model',
                    'series.memo',
                    'series_details.name',
                    'series_details.body1',
                ],
                'LIKE',
                "%{$key}%"
                );
            }
            $query->groupBy('series.id');
        }
        return $query;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('admin/series/index', [
            'series'    => $this->query($request)->paginate(config('system.pagination.num_of_item')),
        ]);
    }

    public function export_csv(Request $request)
    {
        $list = $this->query($request)->get();
        return new StreamedResponse(function() use ($list) {
            $fh = fopen('php://output', 'w');

            fputcsv($fh, mb_convert_encoding([
                'ID',
                'シリーズ型式',
                '品目タイプ',
                'ジャンル',
                'NEWステータス',
                '公開ステータス',
                '生産終了ステータス',
                '物流向け',
                '提携企業製品',
                '型式一覧表に表示する項目',
                '備考欄',
                'アイコン',
                '特徴・特性',
            ], 'cp932', 'utf8'));
            fputcsv($fh, mb_convert_encoding([
                '言語',
                'シリーズ名',
                '本文１',
                '本文２',
                '本文３',
                '注意書き',
            ], 'cp932', 'utf8'));
            fputcsv($fh, mb_convert_encoding([
                '',
            ], 'cp932', 'utf8'));
            foreach ($list as $series) {
                $shows = [];
                foreach (config('enums.system.series_show') as $k => $v) {
                    if ($series->{$k}) {
                        $shows[] = $v;
                    }
                }
                fputcsv($fh, mb_convert_encoding([
                    $series->id,
                    $series->japanese_detail->model,
                    $series->category->label(),
                    $series->genre->label(),
                    $series->is_new ? '1' : '0',
                    $series->is_publish ? '1' : '0',
                    $series->is_end ? '1' : '0',
                    $series->is_logistics ? '1' : '0',
                    $series->is_partner ? '1' : '0',
                    implode(',', $shows),
                    $series->memo,
                    implode(',', $series->icons()->pluck('icon_id')->toArray()),
                    implode(',', $series->features()->pluck('feature_id')->toArray()),
                ], 'cp932', 'utf8'));
                foreach (config('system.language.list') as $lang) {
                    $detail = $series->details()->where('language', $lang)->first();
                    fputcsv($fh, mb_convert_encoding([
                        $lang,
                        $detail->name,
                        $detail->body1,
                        $detail->body2,
                        $detail->body3,
                        $detail->note,
                    ], 'cp932', 'utf8'));

                }
            }

            fclose($fh);
        }, 200, [
            'Content-Type'          => 'text/csv',
            'Content-Disposition'   => sprintf('attachment; filename="leimac_series_%s.csv"', date('Ymd')),
        ]);
    }

    public function import_csv(Request $request) {
        $file = $request->file('csv');
        if ($file) {
            $inserts = [];
            $updates = [];
            $error = null;
            $fp = fopen($file->getRealPath(), 'r');
            fgetcsv($fp);
            fgetcsv($fp);
            fgetcsv($fp);
            $no = 3;
            try {
                $series = null;
                $model = '';
                while(($line=fgetcsv($fp))!==false) {
                    $no++;
                    $line = mb_convert_encoding($line, 'utf8', 'cp932');
                    if (in_array($line[0], config('system.language.list'))) {
                        if (!$series) {
                            throw new \Exception('シリーズが不明です');
                        }
                        if (!in_array($line[0], config('system.language.list'))) {
                            throw new \Exception('シリーズが不明です');
                        }
                        $detail = $series->details()->where('language', $line[0])->first();
                        if (!$detail) {
                            $detail = new SeriesDetail([
                                'series_id' => $series->id,
                                'language'  => $line[0],
                            ]);
                        }
                        $detail->name       = $line[1];
                        $detail->model      = $model;
                        $detail->body1      = $line[2];
                        $detail->body2      = $line[3];
                        $detail->body3      = $line[4];
                        $detail->note       = $line[5];
                        $detail->save();
                    } else {
                        $s = null;
                        if (is_numeric($line[0])) {
                            $s = Series::find($line[0]);
                            if (!$s) {
                                throw new \Exception('シリーズが存在しません');
                            }
                        } else if ($line[0]=='') {
                            $s = new Series();
                        } else {
                            throw new \Exception('"ID" が不正です');
                        }
                        if ($s) {
                            $tmp = array_search($line[2], config('enums.system.category'));
                            if ($tmp===false) {
                                throw new \Exception('"品目タイプ" が不正です');
                            }
                            $s->category = $tmp;

                            $tmp = array_search($line[3], config('enums.system.genre'));
                            if ($tmp===false) {
                                throw new \Exception('"ジャンル" が不正です');
                            }
                            $s->genre = $tmp;
                            
                            $s->is_new          = $line[4];
                            $s->is_publish      = $line[5];
                            $s->is_end          = $line[6];
                            $s->is_logistics    = $line[7];
                            $s->is_partner      = $line[8];
                            $s->memo            = $line[10];

                            $on_shows = explode(',', $line[9]);
                            foreach (config('enums.system.series_show') as $k => $v) {
                                $s->{$k} = in_array($v, $on_shows);
                            }

                            $new = $s->id ? false : true;
                            $s->save();
                            if ($new) {
                                $inserts[] = $s->id;
                            } else {
                                $updates[] = $s->id;
                            }

                            $s->icons()->sync(explode(',', $line[11]));
                            $s->features()->sync(explode(',', $line[12]));

                            $model = $line[1];
                            $series = $s;
                            continue;
                        }
                    }
                    throw new \Exception('未知の不正です');
                }
            } catch (\Exception $e) {
                $error = $no . '行目：' . $e->getMessage();
            }

            echo $error;
            exit;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/series/create', [
            'icons'             => Icon::all(),
            'feature_options'   => Feature::all()->pluck('title', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $series = $this->save($request);
        return redirect()
            ->route('admin.series.index')
            ->with('message', sprintf(config('system.messages.create_succeeded'), $series->id));
    }

    /**
     * Display the specified resource.
     */
    public function show(Series $series)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Series $series)
    {
        return view('admin/series/edit', [
            'series'            => $series,
            'details'           => $series->details->keyBy('language'),
            'categories'        => Category::keyLabel(),
            'genres'            => Genre::keyLabel(),
            'icons'      => Icon::all(),
            'icon_checked'      => $series->icons()->pluck('icon_id')->toArray(),
            'feature_options'   => Feature::all()->pluck('title', 'id'),
            'feature_checked'   => $series->features()->pluck('feature_id')->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Series $series)
    {
        $this->save($request, $series);
        return redirect()
            ->route('admin.series.index')
            ->with('message', sprintf(config('system.messages.update_succeeded'), $series->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Series $series)
    {
        $id = $series->id;
        $series->delete();
        return redirect()
            ->route('admin.series.index')
            ->with('message', sprintf(config('system.messages.delete_succeeded'), $id));
    }

    public function update_multiple(Request $request)
    {
        foreach ($request->ids as $id) {
            $series = Series::find($id);
            $series->is_new = in_array($id, $request->is_new_ids ?? []);
            $series->is_end = in_array($id, $request->is_end_ids ?? []);
            $series->is_publish = in_array($id, $request->is_publish_ids ?? []);
            $series->save();
        }
        return redirect()
            ->route('admin.series.index')
            ->withInput($request->only('keyword'))
            ->with('message', sprintf(config('system.messages.update_succeeded'), implode(',', $request->ids)));
    }

    public function destroy_multiple(Request $request)
    {
        foreach ($request->removes as $id) {
            $series = Series::find($id);
            $series->delete();
        }
        return redirect()
            ->route('admin.series.index')
            ->with('message', sprintf(config('system.messages.delete_succeeded'), implode(',', $request->removes)));
    }


    protected function save(Request $request, Series $series=null) {
        $data = $request->validate([
            'category'  => 'required',
            'icons'     => ['', function($attr, $value, $fail) {
                if (count($value)>8) {
                    $fail('アイコンは選択できるのは8以内です');
                }
            }],
            'features'  => ['', function($attr, $value, $fail) {
                if (count($value)>20) {
                    $fail('特性・特徴は選択できるのは20以内です');
                }
            }],
        ]);
        list($single_params, $multi_params) = $this->splitMultiParameters($request->all());

        if (is_null($series)) {
            $series = new Series($single_params);
        } else {
            $series->fill($single_params);
        }
        $series->save();
        $series->uploadFile('image', $request->file('image'));
        $series->uploadFile('pamphlet', $request->file('pamphlet'));
        $series->uploadFile('catalogue', $request->file('catalogue'));
        $series->uploadFile('manual', $request->file('manual'));

        foreach ($multi_params as $lang => $values) {
            SeriesDetail::updateOrInsert([
                'series_id' => $series->id,
                'language'  => $lang,
            ], array_merge([
                'series_id' => $series->id,
                'language'  => $lang,
            ], $values));
        }

        if (isset($single_params['icons'])) {
            $series->icons()->sync($single_params['icons']);
        }
        if (isset($single_params['features'])) {
            $series->features()->sync($single_params['features']);
        }

        return $series;
    }
}
