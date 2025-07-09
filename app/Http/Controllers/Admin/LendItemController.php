<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LendItem;
use Illuminate\Http\Request;


class LendItemController extends Controller
{
    public function index(Request $request)
    {
        $q = LendItem::query();
        return view('admin/lend_item/index', [
            'lend_items' => $q->get(),
        ]);
    }
}
