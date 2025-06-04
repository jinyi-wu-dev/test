<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\Item;
use App\Models\CableItem;
use App\Models\CableItemGroup;
use App\Models\CableItemGroupDetail;
use App\Models\LightingItem;
use Illuminate\Http\Request;

class CableItemGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $groups = CableItemGroup::paginate(config('system.pagination.num_of_item'));
        return view('admin/cable_item_group/index', [
            'groups' => $groups,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/cable_item_group/create', [
            'series'        => Series::pluck('model', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $group = new CableItemGroup();
        $group->save();
        return redirect()
            ->route('admin.group.index')
            ->with('message', sprintf(config('system.messages.create_succeeded'), $item->id));
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CableItemGroup $group)
    {
        return view('admin/cable_item_group/edit', [
            'group'         => $group,
            'first_item'    => $group->first_item(),
            'details'       => $group->details->keyBy('language'),
            'series'        => Series::pluck('model', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CableItemGroup $group)
    {
        $request->validate([
        ]);
        list($single_params, $multi_params) = $this->splitMultiParameters($request->all());
        $group->fill($multi_params['group']);
        $group->save();

        list($single_params, $detail_params) = $this->splitMultiParameters($multi_params['detail']);
        foreach ($detail_params as $lang => $values) {
            CableItemGroupDetail::updateOrInsert([
                'cable_item_group_id'   => $group->id,
                'language'  => $lang,
            ], array_merge([
                'cable_item_group_id'   => $group->id,
                'language'  => $lang,
            ], $values));
        }

        list($single_params, $cable_params) = $this->splitMultiParameters($multi_params['cable']);
        $shape_cable_params = [];
        foreach ($single_params['cable_ids'] as $pos => $id) {
            $params = [];
            foreach ($cable_params as $label => $values) {
                if (in_array($label, ['common2'])) {
                    continue;
                }
                foreach ($values as $key => $vals) {
                    $params[$key] = $vals[$pos];
                }
                $shape_cable_params[$id][$label] = $params;
            }
        }
        foreach ($group->items() as $item) {
            $item->fill($multi_params['item']);
            $item->fill($shape_cable_params[$item->id]['common']);
            $item->is_lend = in_array($item->id, $cable_params['common2']['is_lend']);
            $item->save();

            unset($shape_cable_params[$item->id]['common']);
            foreach ($shape_cable_params[$item->id] as $lang => $values) {
                CableItem::updateOrInsert([
                    'item_id'   => $item->id,
                    'language'  => $lang,
                ], array_merge([
                    'item_id'   => $item->id,
                    'language'  => $lang,
                ], $values));
            }
        }

        return redirect()
            ->route('admin.group.index')
            ->with('message', sprintf(config('system.messages.update_succeeded'), $group->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CableItemGroup $group)
    {
        $id = $group->id;
        $group->delete();
        return redirect()
            ->route('admin.group.index')
            ->with('message', sprintf(config('system.messages.delete_succeeded'), $id));
    }

    public function update_groups(Request $request)
    {
        foreach ($request->group_ids as $group_id) {
            $group = CableItemGroup::find($group_id);
            foreach ($group->items() as $item) {
                $item->is_new = in_array($group_id, $request->is_new_group_ids ?? []);
                $item->is_end = in_array($group_id, $request->is_end_group_ids ?? []);
                $item->is_publish = in_array($group_id, $request->is_publish_group_ids ?? []);
                $item->is_lend = in_array($item->id, $request->is_lend_item_ids ?? []);
                $item->save();
            }
        }
        return redirect()
            ->route('admin.group.index')
            ->withInput($request->only('keyword'))
            ->with('message', sprintf(config('system.messages.update_succeeded'), implode(',', $request->group_ids)));
    }

    public function destroy_groups(Request $request)
    {
        foreach ($request->removes as $id) {
            $group = CableItemGroup::find($id);
            $group->delete();
        }
        return redirect()
            ->route('admin.group.index')
            ->with('message', sprintf(config('system.messages.delete_succeeded'), implode(',', $request->removes)));
    }

    public function add_item(Request $request, CableItemGroup $group)
    {
        $item = new Item();
        $item->save();

        $group->addItem($item->id);
        $group->save();

        return redirect()
            ->route('admin.group.edit', $group)
            ->with('message', sprintf(config('system.messages.create_succeeded'), $item->id));
    }
    
    public function destroy_items(Request $request, CableItemGroup $group) {
        $group->removeItems($request->removes);
        $group->save();

        foreach ($request->removes as $id) {
            $item = Item::find($id);
            $item->delete();
        }

        return redirect()
            ->route('admin.group.edit', $group)
            ->with('message', sprintf(config('system.messages.delete_succeeded'), implode(',', $request->removes)));
    }


}
