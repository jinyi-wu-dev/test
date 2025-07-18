<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Series;
use App\Models\Item;
use App\Models\LightingItem;
use App\Models\ControllerItem;
use App\Models\CableItem;
use App\Models\OptionItem;
use App\Models\Icon;
use App\Models\Feature;
use App\Enums\Category;
use App\Enums\Genre;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected function query($request) {
        return match ($request->category) {
            'lighting' => $this->lightingItemQuery($request),
            'controller' => $this->controllerItemQuery($request),
            'option' => $this->optionItemQuery($request),
        };
    }
    
    protected function lightingItemQuery($request) {
        $query = Item::lightings();
        $keyword = $request->keyword ? $request->keyword : old('keyword');
        /*
        if ($keyword) {
            $query->join('model_lightings', 'models.id', '=', 'model_lightings.model_id');
            foreach (preg_split('/[ 　]++/', $keyword, 0, PREG_SPLIT_NO_EMPTY) as $key) {
                $query->whereAny([
                    'item.model',
                    'item.memo',
                    'series_details.name',
                    'series_details.body1',
                ],
                'LIKE',
                "%{$key}%"
                );
            }
            $query->groupBy('item.id');
        }
         */
        return $query;
    }

    protected function controllerItemQuery($request) {
        $query = Item::controllers();
        $keyword = $request->keyword ? $request->keyword : old('keyword');
        /*
        if ($keyword) {
            $query->join('model_lightings', 'models.id', '=', 'model_lightings.model_id');
            foreach (preg_split('/[ 　]++/', $keyword, 0, PREG_SPLIT_NO_EMPTY) as $key) {
                $query->whereAny([
                    'item.model',
                    'item.memo',
                    'series_details.name',
                    'series_details.body1',
                ],
                'LIKE',
                "%{$key}%"
                );
            }
            $query->groupBy('item.id');
        }
         */
        return $query;
    }

    protected function optionItemQuery($request) {
        $query = Item::options();
        $keyword = $request->keyword ? $request->keyword : old('keyword');
        /*
        if ($keyword) {
            $query->join('model_lightings', 'models.id', '=', 'model_lightings.model_id');
            foreach (preg_split('/[ 　]++/', $keyword, 0, PREG_SPLIT_NO_EMPTY) as $key) {
                $query->whereAny([
                    'item.model',
                    'item.memo',
                    'series_details.name',
                    'series_details.body1',
                ],
                'LIKE',
                "%{$key}%"
                );
            }
            $query->groupBy('item.id');
        }
         */
        return $query;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'category' => 'required',
        ]);

        $query = $this->query($request);
        $items = $query->paginate(config('system.pagination.num_of_item'));
        $items->appends(['category'=>$request->category]);
        return view('admin/item/index', [
            'items'     => $items,
            'category'  => Category::from($request->category),
        ]);
    }

    public function csv(Request $request)
    {
        $request->validate([
            'category' => 'required',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'category'  => 'required',
        ]);
        return view('admin/item/create', [
            'category'      => Category::from($request->category),
            'categories'    => Category::keyLabel(),
            'series'        => Series::pluck('model', 'id'),
            'controllers'   => Series::controller()->pluck('model', 'id'),
            'cables'        => Series::cable()->pluck('model', 'id'),
            'options'       => Series::option()->pluck('model', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = $this->save($request);
        return redirect()
            ->route('admin.item.index', ['category' => $request->category])
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
    public function edit(Item $item)
    {
        $details = match ($item->series->category) {
            Category::LIGHTING      => $item->lighting_items->keyBy('language'),
            Category::CONTROLLER    => $item->controller_items->keyBy('language'),
            Category::OPTION        => $item->option_items->keyBy('language'),
        };
        return view('admin/item/edit', [
            'item'          => $item,
            'category'      => $item->series->category,
            'details'       => $details,
            'series'        => Series::pluck('model', 'id'),
            'controllers'   => Series::controller()->pluck('model', 'id'),
            'cables'        => Series::cable()->pluck('model', 'id'),
            'options'       => Series::option()->pluck('model', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $this->save($request, $item);
        return redirect()
            ->route('admin.item.index', ['category'=>$item->series->category])
            ->with('message', sprintf(config('system.messages.update_succeeded'), $item->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $id = $item->id;
        $item->delete();
        return redirect()
            ->route('admin.item.index')
            ->with('message', sprintf(config('system.messages.delete_succeeded'), $id));
    }

    public function update_multiple(Request $request)
    {
        foreach ($request->ids as $id) {
            $item = Item::find($id);
            $item->is_new = in_array($id, $request->is_new_ids ?? []);
            $item->is_end = in_array($id, $request->is_end_ids ?? []);
            $item->is_publish = in_array($id, $request->is_publish_ids ?? []);
            $item->is_lend = in_array($id, $request->is_lend_ids ?? []);
            $item->save();
        }
        return redirect()
            ->route('admin.item.index', ['category'=>$item->series->category])
            ->withInput($request->only('keyword'))
            ->with('message', sprintf(config('system.messages.update_succeeded'), implode(',', $request->ids)));
    }

    public function destroy_multiple(Request $request)
    {
        foreach ($request->removes as $id) {
            $item = Item::find($id);
            $item->delete();
        }
        return redirect()
            ->route('admin.item.index')
            ->with('message', sprintf(config('system.messages.delete_succeeded'), implode(',', $request->removes)));
    }


    protected function save(Request $request, Item $item=null) {
        $request->validate([
            'series_id'  => 'required',
        ]);
        list($single_params, $multi_params) = $this->splitMultiParameters($request->all());

        if (is_null($item)) {
            $item = new Item($single_params);
        } else {
            $item->fill($single_params);
        }
        $item->is_RoHS = $request->cs_rohs=='RoHS';
        $item->is_RoHS2 = $request->cs_rohs=='RoHS2';
        $item->is_CN_RoHSe1 = $request->cs_crohs=='e_1';
        $item->is_CN_RoHS102 = $request->cs_crohs=='10_2';
        $item->is_CE_IEC = $request->cs_ce=='iec';
        $item->is_CE_EN = $request->cs_ce=='en';
        $item->is_UKCA = $request->cs_ukca=='ukca';
        $item->is_PSE = $request->cs_pse=='pse';
        $item->save();

        $item->uploadFile('3d_model_stl', $request->file('3d_model_stl'));
        $item->uploadFile('3d_model_step', $request->file('3d_model_step'));

        $commons = [];
        if (isset($multi_params['_c'])) {
            $commons = $multi_params['_c'];
            unset($multi_params['_c']);
            foreach ($multi_params as $key => $val) {
                $multi_params[$key] = array_merge($multi_params[$key], $commons);
            }
        }

        switch ($request->category) {
        case Category::LIGHTING->value:
            $this->saveLighting($item, $request, $multi_params);
            $this->syncRelatedSeries(CATEGORY::CONTROLLER, $request->controllers, $item->related_controllers());
            $this->syncRelatedSeries(CATEGORY::CABLE, $request->cables, $item->related_cables());
            $this->syncRelatedSeries(CATEGORY::OPTION, $request->options, $item->related_options());
            break;
        case CATEGORY::CONTROLLER->value:
            $this->saveController($item, $request, $multi_params);
            $this->syncRelatedSeries(CATEGORY::CABLE, $request->cables, $item->related_cables());
            $this->syncRelatedSeries(CATEGORY::OPTION, $request->options, $item->related_options());
            break;
        case CATEGORY::OPTION->value:
            $this->saveOption($item, $request, $multi_params);
            $this->syncRelatedSeries(CATEGORY::OPTION, $request->options, $item->related_options());
            break;
        }

        if (isset($single_params['icons'])) {
            $item->icons()->sync($single_params['icons']);
        }
        if (isset($single_params['features'])) {
            $item->features()->sync($single_params['features']);
        }

        return $item;
    }

    protected function syncRelatedSeries($category, $ids, $related_series) {
        $rs = [];
        foreach ($ids as $id) {
            if ($id>0) {
                $rs[$id] = ['category' => $category];
            }
        }
        $related_series->sync($rs);
    }

    protected function saveLighting($item, $request, $multi_params) {
        $details = $item->lighting_items->keyBy('language');
        foreach ($multi_params as $lang => $values) {
            unset($values['external_view_pdf']);
            unset($values['external_view_dxf']);
            LightingItem::updateOrInsert([
                'item_id'   => $item->id,
                'language'  => $lang,
            ], array_merge([
                'item_id'   => $item->id,
                'language'  => $lang,
            ], $values));
            $details[$lang]->uploadFile('external_view_pdf', $request->file($lang.':external_view_pdf'));
            $details[$lang]->uploadFile('external_view_dxf', $request->file($lang.':external_view_dxf'));
        }
    }
    
    protected function saveController($item, $request, $multi_params) {
        $details = $item->controller_items->keyBy('language');
        foreach ($multi_params as $lang => $values) {
            unset($values['external_view_pdf']);
            unset($values['external_view_dxf']);
            ControllerItem::updateOrInsert([
                'item_id'   => $item->id,
                'language'  => $lang,
            ], array_merge([
                'item_id'   => $item->id,
                'language'  => $lang,
            ], $values));
            $details[$lang]->uploadFile('external_view_pdf', $request->file($lang.':external_view_pdf'));
            $details[$lang]->uploadFile('external_view_dxf', $request->file($lang.':external_view_dxf'));
        }
    }
    
    protected function saveOption($item, $request, $multi_params) {
        $details = $item->option_items->keyBy('language');
        foreach ($multi_params as $lang => $values) {
            unset($values['external_view_pdf']);
            unset($values['external_view_dxf']);
            OptionItem::updateOrInsert([
                'item_id'   => $item->id,
                'language'  => $lang,
            ], array_merge([
                'item_id'   => $item->id,
                'language'  => $lang,
            ], $values));
            $details[$lang]->uploadFile('external_view_pdf', $request->file($lang.':external_view_pdf'));
            $details[$lang]->uploadFile('external_view_dxf', $request->file($lang.':external_view_dxf'));
        }
    }
    
}
