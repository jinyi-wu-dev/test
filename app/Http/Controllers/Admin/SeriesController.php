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

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
        $series = $query->paginate(config('system.pagination.num_of_item'));
        return view('admin/series/index', compact(
            'series'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/series/create', [
            'icons'      => Icon::all(),
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
