<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Series;
use App\Models\Item;
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

}
