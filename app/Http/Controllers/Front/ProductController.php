<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Series;
use App\Models\Item;
use App\Models\LendItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected function makeQuery(Request $request) {
        $has_lighting = false;
        $has_controller = false;
        foreach ($request->all() as $k => $v) {
            if (str_contains($k, 'lighting_')) {
                $this->has_lighting = true;
            }
            if (str_contains($k, 'lighting_')) {
                $this->has_lighting = true;
            }
        }

        $q = Series::query();
        $q = DB::table('series');
        $q->join('items', 'series.id', '=', 'items.series_id');
        $q->leftJoin('lighting_items', function($join) {
            $join->on('items.id', '=', 'lighting_items.item_id')
                ->where('lighting_items.language', '=', 'ja');
        });
        $q->leftJoin('controller_items', function($join) {
            $join->on('items.id', '=', 'controller_items.item_id')
                ->where('controller_items.language', '=', 'ja');
        });

        $q = $q->select([
            'series.id as series_id',
            'items.id as item_id',
        ]);

        if ($request->has('keywords')) {
            foreach ($this->splitKeywords($request->keywords) as $key) {
                $q->where(function($query) use ($key) {
                    $query->where('series.model', 'LIKE', "%{$key}%")
                        ->orWhere('items.model', 'LIKE', "%{$key}%");
                });
            }
        }
        if ($request->has('only_end')) {
            $q->where(function($query) {
                $query->where('series.is_end', '1')
                    ->orWhere('items.is_end', '1');
            });
        } else {
        if (!$request->has('include_end')) {
            $q->where(function($query) {
                $query->where('series.is_end', '0')
                    ->where('items.is_end', '0');
            });
        }
        }
        if ($request->has('only_new')) {
            $q->where(function($query) {
                $query->where('series.is_new', '1')
                    ->orWhere('items.is_new', '1');
            });
        }
        if ($request->has('lighting_genres')) {
            $q->whereIn('series.genre', $request->lighting_genres);
        }
        if ($request->has('lighting_logistics')) {
            $q->where('series.is_logistics', '1');
        }
        if ($request->has('lighting_partner')) {
            $q->where('series.is_partner', '1');
        }
        if ($request->has('lighting_colors')) {
            $q->whereIn('lighting_items.color', $request->lighting_colors);
        }
        if ($request->has('lighting_inputs')) {
            $inputs =  $request->lighting_inputs;
            $q->where(function($query) use($inputs) {
                foreach ($inputs as $k => $v) {
                    if ($k==0) {
                        $query->where('lighting_items.input', $v);
                    } else {
                        $query->orWhere('lighting_items.input', $v);
                    }
                }
            });
        }
        if ($request->filled('lighting_pc_min')) {
            $q->whereRaw('CAST(lighting_items.power_consumption as SIGNED) >= ?', $request->lighting_pc_min);
        }
        if ($request->filled('lighting_pc_max')) {
            $q->whereRaw('CAST(lighting_items.power_consumption as SIGNED) <= ?', $request->lighting_pc_max);
        }
        if ($request->filled('lighting_weight_min')) {
            $q->whereRaw('CAST(items.weight as FLOAT) >= ?', $request->lighting_weight_min);
        }
        if ($request->filled('lighting_weight_max')) {
            $q->whereRaw('CAST(items.weight as FLOAT) <= ?', $request->lighting_weight_max);
        }

        if ($request->has('controller_genres')) {
            $q->whereIn('series.genre', $request->controller_genres);
        }
        if ($request->has('controller_controls')) {
            $q->whereIn('controller_items.dimmable_control', $request->controller_controls);
        }
        if ($request->has('controller_inputs')) {
            $inputs =  $request->controller_inputs;
            $q->where(function($query) use($inputs) {
                foreach ($inputs as $k => $v) {
                    if ($k==0) {
                        $query->where('controller_items.input', $v);
                    } else {
                        $query->orWhere('controller_items.input', $v);
                    }
                }
            });
        }
        if ($request->has('controller_external_switch')) {
            $q->where('controller_items.is_external_switch', '1');
        }
        if ($request->has('controller_ethernet')) {
            $q->where('controller_items.is_ethernet', '1');
        }
        if ($request->has('controller_rs232c')) {
            $q->where('controller_items.is_rs232c', '1');
        }
        if ($request->has('controller_8bit')) {
            $q->where('controller_items.is_8bit_parallel', '1');
        }
        if ($request->has('controller_10bit')) {
            $q->where('controller_items.is_10bit_parallel', '1');
        }
        if ($request->has('controller_analog')) {
            $q->where('controller_items.is_analog', '1');
        }
        if ($request->filled('controller_ch')) {
            $q->where('controller_items.num_of_ch', '>=', $request->controller_ch);
        }
        if ($request->filled('controller_capacity_min')) {
            $q->whereRaw('CAST(controller_items.total_capacity as SIGNED) >= ?', $request->controller_capacity_min);
        }
        if ($request->filled('controller_capacity_max')) {
            $q->whereRaw('CAST(controller_items.total_capacity as SIGNED) <= ?', $request->controller_capacity_max);
        }
        if ($request->filled('controller_weight_min')) {
            $q->whereRaw('CAST(items.weight as FLOAT) >= ?', $request->controller_weight_min);
        }
        if ($request->filled('controller_weight_max')) {
            $q->whereRaw('CAST(items.weight as FLOAT) <= ?', $request->controller_weight_max);
        }

        if ($request->has('genres')) {
            $q->whereIn('series.genre', $request->genres);
        }

        //$q->dd();
        return $q;
    }

    public function search(Request $request)
    {
        $query = $this->makeQuery($request);
        $list = [];
        $count_series = 0;
        $count_item = 0;
        foreach ($query->get() as $info) {
            if (!isset($list[$info->series_id])) {
                $count_series++;
                $list[$info->series_id] = [];
            }
            $count_item++;
            $list[$info->series_id][] = $info->item_id;
        }
        return $this->languageView('search', [
            'list'          => $list,
            'num_of_series' => $count_series,
            'num_of_items'  => $count_item,
        ]);
    }

    public function series($id)
    {
        $series = Series::find($id);
        return $this->languageView('series', [
            'series' => $series,
        ]);
    }

    public function item($id)
    {
        $item = Item::find($id);
        return $this->languageView('item', [
            'series' => $item->series,
            'item' => $item,
        ]);
    }

    public function cart()
    {
        return $this->languageView('cart', [
            'disabled_header_cart' => true,
        ]);
    }

    public function cart_complete(Request $request)
    {
        /*
        $lend = new LendItem($request->all());
        $lend->user_id = Auth::user()->id;
        $lend->save();
        foreach ($request->items as $key => $item_id) {
            $lend->items()->attach($item_id, ['num_of_item' => $request->num_of_items[$key]]);
        }
         */
        $lend = LendItem::find(2);
        return $this->languageView('cart_complete', [
            'disabled_cart'         => true,
            'disabled_header_cart'  => true,
            'lend_item'             => $lend,
        ]);
    }

}
