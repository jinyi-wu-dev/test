<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

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
        return view('admin/feature/create');
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
        return view('admin/feature/edit', compact(
            'feature'
        ));
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


    protected function save(Request $request, Feature $feature=null) {
        $request->validate([
            'title' => 'required',
        ]);

        if (is_null($feature)) {
            $feature = new Feature($request->all());
        } else {
            $feature->fill($request->all());
        }
        $feature->save();

        $feature->uploadImage($request->file('image'));

        return $feature;
    }
}
