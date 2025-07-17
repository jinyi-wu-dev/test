<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LendItem;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;


class LendItemController extends Controller
{
    protected function query(Request $request) {
        $q = LendItem::query();
        if ($request->start) {
            $q->whereDate('requested_at', '>=', $request->start);
        }
        if ($request->end) {
            $q->whereDate('requested_at', '<=', $request->end);
        }
        return $q;
    }

    public function index(Request $request)
    {
        return view('admin/lend_item/index', [
            'lend_items' => $this->query($request)->paginate(config('pagination.num_of_item'))->withQueryString(),
        ]);
    }

    public function csv(Request $request)
    {
        $list = $this->query($request)->get();
        return new StreamedResponse(function() use($list) {
            $fh = fopen('php://output', 'w');

            fputcsv($fh, mb_convert_encoding([
                'ID',
                '品目タイプ',
                'ジャンル',
                '品名',
                'シリーズ型式',
                '型式',
                '台数',
                '備考欄',
                'ご依頼日',
                '都道府県',
                '会社名',
                '名前',
            ], 'cp932', 'utf8'));
            foreach ($list as $lend) {
                foreach ($lend->items as $item) {
                    fputcsv($fh, mb_convert_encoding([
                        $lend->id,
                        $item->series->category->label(),
                        $item->series->genre->label(),
                        $item->series->japanese_detail->name,
                        $item->series->model,
                        $item->model,
                        $item->pivot->num_of_item,
                        $lend->remarks,
                        $lend->requested_at,
                        $lend->user->prefecture->label(),
                        $lend->user->company,
                        $lend->user->name,
                    ], 'cp932', 'utf8'));
                }
            }

            fclose($fh);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="rentals.csv"',
        ]);
    }
}
