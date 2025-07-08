<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Series;
use App\Models\Item;
use App\Models\LendItem;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        $q = Series::query();
        $q->limit(10);
        return $this->localeView('front/%s/search', [
            'list' => $q->get(),
        ]);
    }

    public function series($id)
    {
        $series = Series::find($id);
        return $this->localeView('front/%s/series', [
            'series' => $series,
        ]);
    }

    public function item($id)
    {
        $item = Item::find($id);
        return $this->localeView('front/%s/item', [
            'series' => $item->series,
            'item' => $item,
        ]);
    }

    public function cart()
    {
        return $this->localeView('front/%s/cart', [
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
        return $this->localeView('front/%s/cart_complete', [
            'disabled_cart'         => true,
            'disabled_header_cart'  => true,
            'lend_item'             => $lend,
        ]);
    }

}
