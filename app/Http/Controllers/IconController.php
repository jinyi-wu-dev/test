<?php

namespace App\Http\Controllers;

use App\Models\Icon;
use Illuminate\Http\Request;

class IconController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $icons = Icon::paginate(config('pagination.num_of_item'));
        return view('admin/icon/index', compact(
            'icons'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/icon/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $icon = $this->save($request);
        return redirect()
            ->route('admin.icon.index')
            ->with('message', sprintf(config('system.messages.create_succeeded'), $icon->id));
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
    public function edit(Icon $icon)
    {
        return view('admin/icon/edit', compact(
            'icon'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Icon $icon)
    {
        $this->save($request, $icon);
        return redirect()
            ->route('admin.icon.index')
            ->with('message', sprintf(config('system.messages.update_succeeded'), $icon->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Icon $icon)
    {
        $icon->delete();
        return redirect()
            ->route('admin.icon.index')
            ->with('message', sprintf(config('system.messages.delete_succeeded'), $icon->id));
    }

    public function destroy_multiple(Request $request)
    {
        foreach ($request->removes as $id) {
            $icon = Icon::find($id);
            $icon->delete();
        }
        return redirect()
            ->route('admin.icon.index')
            ->with('message', sprintf(config('system.messages.delete_succeeded'), implode(',', $request->removes)));
    }


    protected function save(Request $request, Icon $icon=null) {
        $request->validate([
            'title' => 'required',
        ]);

        if (is_null($icon)) {
            $icon = new Icon($request->all());
        } else {
            $icon->fill($request->all());
        }
        $icon->save();

        $icon->uploadFile('image', $request->file('image'));

        return $icon;
    }
}
