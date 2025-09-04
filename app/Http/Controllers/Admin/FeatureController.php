<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;
use App\Models\FeatureDetail;
use App\Enums\Layout;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = Feature::paginate(config('pagination.num_of_item'));
        return view('admin/feature/index', compact(
            'features'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/feature/create', [
            'layouts'   => Layout::keyLabel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $feature = $this->save($request);
        return redirect()
            ->route('admin.feature.index')
            ->with('message', sprintf(config('system.messages.create_succeeded'), $feature->id));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feature)
    {
        return view('admin/feature/edit', [
            'layouts'   => Layout::keyLabel(),
            'feature'   => $feature,
            'details'   => $feature->details->keyBy('language'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        $this->save($request, $feature);
        return redirect()
            ->route('admin.feature.index')
            ->with('message', sprintf(config('system.messages.update_succeeded'), $feature->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)
    {
        $feature->delete();
        return redirect()
            ->route('admin.feature.index')
            ->with('message', sprintf(config('system.messages.delete_succeeded'), $feature->id));
    }

    public function destroy_multiple(Request $request)
    {
        foreach ($request->removes as $id) {
            $feature = Feature::find($id);
            $feature->delete();
        }
        return redirect()
            ->route('admin.feature.index')
            ->with('message', sprintf(config('system.messages.delete_succeeded'), implode(',', $request->removes)));
    }


    protected function save(Request $request, Feature $feature=null) {
        $request->validate([
            'layout' => 'required',
        ]);
        list($single_params, $multi_params) = $this->splitMultiParameters($request->all());

        if (is_null($feature)) {
            $feature = new Feature($single_params);
        } else {
            $feature->fill($single_params);
        }
        $feature->save();

        $details = $feature->details->keyBy('language');
        foreach ($multi_params as $lang => $values) {
            unset($values['image']);
            FeatureDetail::updateOrInsert([
                'feature_id' => $feature->id,
                'language'  => $lang,
            ], array_merge([
                'feature_id' => $feature->id,
                'language'  => $lang,
            ], $values));

            if (isset($details[$lang])) {
                $details[$lang]->uploadFile('image', $request->file($lang.':image'));
            }
        }


        return $feature;
    }
}
