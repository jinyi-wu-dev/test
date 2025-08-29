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
            if ($lang!='ja') {
                $values = $values + $multi_params['ja'];
            }
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

    /*
     * --------------------------------------------------------------------------------------------
     *  CSV
     * --------------------------------------------------------------------------------------------
     */
    public function export_csv(Request $request)
    {
        $list = $this->query($request)->get();
        return new StreamedResponse(function() use ($list) {
            $fh = fopen('php://output', 'w');

            fputcsv($fh, mb_convert_encoding([
                'ID',
                'NEWステータス',
                '公開ステータス',
                '生産終了ステータス',
                '物流向け',
                '提携企業製品',
                'シリーズ型式',
                '品目タイプ',
                'ジャンル',
                '型式一覧表に表示する項目：タイプ',
                '型式一覧表に表示する項目：型式',
                '型式一覧表に表示する項目：品番',
                '型式一覧表に表示する項目：器具重量',
                '型式一覧表に表示する項目：その他',
                '型式一覧表に表示する項目：適合規格',
                '型式一覧表に表示する項目：発光色（ピーク波長、色温度）',
                '型式一覧表に表示する項目：CH数',
                '型式一覧表に表示する項目：消費電力',
                '型式一覧表に表示する項目：SAG値',
                '型式一覧表に表示する項目：入力電圧',
                '型式一覧表に表示する項目：調光制御',
                '型式一覧表に表示する項目：合計容量',
                '型式一覧表に表示する項目：CH数',
                '型式一覧表に表示する項目：入力',
                '型式一覧表に表示する項目：出力',
                '型式一覧表に表示する項目：外部ON/OFF',
                '型式一覧表に表示する項目：外部調光制御',
                '型式一覧表に表示する項目：透過率',
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
            fputcsv($fh, [config('system.csv.series.identifier')]);

            foreach ($list as $series) {
                fputcsv($fh, mb_convert_encoding([
                    $series->id,
                    $series->is_new                         ? '1' : '0',
                    $series->is_publish                     ? '1' : '0',
                    $series->is_end                         ? '1' : '0',
                    $series->is_logistics                   ? '1' : '0',
                    $series->is_partner                     ? '1' : '0',
                    $series->japanese_detail->model,
                    $series->category->label(),
                    $series->genre->label(),
                    $series->show_type                      ? '1' : '0',
                    $series->show_model                     ? '1' : '0',
                    $series->show_product_number            ? '1' : '0',
                    $series->show_weight                    ? '1' : '0',
                    $series->show_other                     ? '1' : '0',
                    $series->show_compatible_standards      ? '1' : '0',
                    $series->show_luminous_color            ? '1' : '0',
                    $series->show_lt_num_of_ch              ? '1' : '0',
                    $series->show_power_consumption         ? '1' : '0',
                    $series->show_sag                       ? '1' : '0',
                    $series->show_input_voltage             ? '1' : '0',
                    $series->show_diming_controll           ? '1' : '0',
                    $series->show_total_capacity            ? '1' : '0',
                    $series->show_ct_num_of_ch              ? '1' : '0',
                    $series->show_input                     ? '1' : '0',
                    $series->show_output                    ? '1' : '0',
                    $series->show_external_onoff            ? '1' : '0',
                    $series->show_external_diming_control   ? '1' : '0',
                    $series->show_throughput                ? '1' : '0',
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
            'Content-Disposition'   => sprintf('attachment; filename="%s"', config('system.csv.series.filename')),
        ]);
    }

    public function import_csv(Request $request) {
        $file = $request->file('csv');
        if ($file) {
            try {
                $inserts = [];
                $updates = [];
                $error = '';

                $fp = fopen($file->getRealPath(), 'r');
                fgetcsv($fp);
                fgetcsv($fp);
                $line = fgetcsv($fp);
                if ($line[0]!='[series]') {
                    throw new \Exception('ファイル内容が不正です');
                }

                $series = null;
                $model = '';
                $no = 3;
                while(($line=fgetcsv($fp))!==false) {
                    $no++;
                    $line = mb_convert_encoding($line, 'utf8', 'cp932');
                    if (in_array($line[0], config('system.language.list'))) {
                        if (!$series) {
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
                        continue;
                    } else if (is_numeric($line[0])) {
                        $create = false;
                        $s = Series::find($line[0]);
                        if (!$s) {
                            $create = true;
                            $s = new Series();
                            $s->insert(
                                ['id' => $line[0]]
                            );
                            $s = Series::find($line[0]);
                        }
                        if ($s) {
                            $s->is_new          = $line[1];
                            $s->is_publish      = $line[2];
                            $s->is_end          = $line[3];
                            $s->is_logistics    = $line[4];
                            $s->is_partner      = $line[5];

                            $model = $line[6];

                            $tmp = array_search($line[7], config('enums.system.category'));
                            if ($tmp===false) {
                                throw new \Exception('"品目タイプ" が不正です');
                            }
                            $s->category = $tmp;

                            $tmp = array_search($line[8], config('enums.system.genre'));
                            if ($tmp===false) {
                                throw new \Exception('"ジャンル" が不正です');
                            }
                            $s->genre = $tmp;
                            
                            $s->show_type = $line[9];
                            $s->show_model = $line[10];
                            $s->show_product_number = $line[11];
                            $s->show_weight = $line[12];
                            $s->show_other = $line[13];
                            $s->show_compatible_standards = $line[14];
                            $s->show_luminous_color = $line[15];
                            $s->show_lt_num_of_ch = $line[16];
                            $s->show_power_consumption = $line[17];
                            $s->show_sag = $line[18];
                            $s->show_input_voltage = $line[19];
                            $s->show_diming_controll = $line[20];
                            $s->show_total_capacity = $line[21];
                            $s->show_ct_num_of_ch = $line[22];
                            $s->show_input = $line[23];
                            $s->show_output = $line[24];
                            $s->show_external_onoff = $line[25];
                            $s->show_external_diming_control = $line[26];
                            $s->show_throughput = $line[27];

                            $s->memo            = $line[28];

                            $s->save();
                            if ($create) {
                                $inserts[] = $s->id;
                            } else {
                                $updates[] = $s->id;
                            }

                            $s->icons()->sync(explode(',', $line[29]));
                            $s->features()->sync(explode(',', $line[30]));

                            $series = $s;
                            continue;
                        }
                    } else if ($line[0]=='') {
                        throw new \Exception('"ID" もしくは "言語" が空です');
                    } else {
                        throw new \Exception('"ID" もしくは "言語" が不正です');
                    }
                    throw new \Exception('未知の不正です');
                }
            } catch (\Exception $e) {
                $error = $no . '行目：' . $e->getMessage();
            }

            echo "新規作成";
            print_r($inserts);
            echo "更新";
            print_r($updates);
            echo $error;
            exit;
        }
    }

}
