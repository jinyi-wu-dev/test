<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Series;
use App\Models\Item;
use App\Models\CableItem;
use App\Models\CableItemGroup;
use App\Models\CableItemGroupDetail;
use App\Models\LightingItem;
use App\Enums\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
            'series'        => Series::where('category', Category::CABLE)->pluck('model', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $group = $this->save($request);
        return redirect()
            ->route('admin.cable.index')
            ->with('message', sprintf(config('system.messages.create_succeeded'), $group->id));
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
    public function edit($id)
    {
        $group = CableItemGroup::find($id);
        return view('admin/cable_item_group/edit', [
            'group'         => $group,
            'first_item'    => $group->first_item(),
            'details'       => $group->details->keyBy('language'),
            'series'        => Series::where('category', Category::CABLE)->pluck('model', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $group = CableItemGroup::find($id);
        $this->save($request, $group);

        return redirect()
            ->route('admin.cable.index')
            ->with('message', sprintf(config('system.messages.update_succeeded'), $group->id));
    }

    protected function save(Request $request, CableItemGroup $group=null)
    {
        $request->validate([
            'group:series_id'  => 'required',
        ]);
        list($single_params, $multi_params) = $this->splitMultiParameters($request->all());
        if (!$group) {
            $group = new CableItemGroup($multi_params['group']);
        } else {
            $group->fill($multi_params['group']);
        }
        $group->save();
        $group->uploadFile('3d_model_stl', $request->file('3d_model_stl'));
        $group->uploadFile('3d_model_step', $request->file('3d_model_step'));

        list($single_params, $detail_params) = $this->splitMultiParameters($multi_params['detail']);
        $details = $group->details->keyBy('language');
        foreach ($detail_params as $lang => $values) {
            CableItemGroupDetail::updateOrInsert([
                'cable_item_group_id'   => $group->id,
                'language'  => $lang,
            ], array_merge([
                'cable_item_group_id'   => $group->id,
                'language'  => $lang,
            ], $values));

            if (isset($details[$lang])) {
                $details[$lang]->uploadFile('external_view_pdf', $request->file($lang.':external_view_pdf'));
                $details[$lang]->uploadFile('external_view_dxf', $request->file($lang.':external_view_dxf'));
            }
        }

        if (isset($multi_params['cable'])) {
            list($single_params, $cable_params) = $this->splitMultiParameters($multi_params['cable']);
            $shape_cable_params = [];
            foreach ($single_params['cable_ids'] as $pos => $id) {
                foreach ($cable_params as $label => $values) {
                    $params = [];
                    if (in_array($label, ['common2'])) {
                        continue;
                    }
                    foreach ($values as $key => $vals) {
                        $params[$key] = $vals[$pos];
                    }
                    $shape_cable_params[$id][$label] = $params;
                }
            }
        }
        foreach ($group->items() as $item) {
            $item->series_id = $group->series_id;
            $item->fill($multi_params['item']);
            $item->fill($shape_cable_params[$item->id]['common']);
            $item->is_lend      = in_array($item->id, $cable_params['common2']['is_lend'] ?? []);
            $item->is_RoHS      = $multi_params['item']['cs_rohs']=='RoHS';
            $item->is_RoHS2     = $multi_params['item']['cs_rohs']=='RoHS2';
            $item->is_CN_RoHSe1     = $multi_params['item']['cs_crohs']=='e_1';
            $item->is_CN_RoHS102    = $multi_params['item']['cs_crohs']=='10_2';
            $item->save();

            unset($shape_cable_params[$item->id]['common']);
            foreach ($shape_cable_params[$item->id] as $lang => $values) {
                if ($lang!='ja') {
                    $values = $values + $shape_cable_params[$item->id]['ja'];
                }
                CableItem::updateOrInsert([
                    'item_id'   => $item->id,
                    'language'  => $lang,
                ], array_merge([
                    'item_id'   => $item->id,
                    'language'  => $lang,
                ], $values));
            }
        }

        return $group;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $group = CableItemGroup::find($id);

        $group->delete();
        return redirect()
            ->route('admin.cable.index')
            ->with('message', sprintf(config('system.messages.delete_succeeded'), $id));
    }

    public function update_multiple(Request $request)
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
            ->route('admin.cable.index')
            ->withInput($request->only('keyword'))
            ->with('message', sprintf(config('system.messages.update_succeeded'), implode(',', $request->group_ids)));
    }

    public function destroy_multiple(Request $request)
    {
        foreach ($request->removes as $id) {
            $group = CableItemGroup::find($id);
            $group->delete();
        }
        return redirect()
            ->route('admin.cable.index')
            ->with('message', sprintf(config('system.messages.delete_succeeded'), implode(',', $request->removes)));
    }

    public function add_item(Request $request, $id)
    {
        $group = CableItemGroup::find($id);

        $item = new Item();
        $item->save();

        $group->addItem($item->id);
        $group->save();

        return redirect()
            ->route('admin.cable.edit', $group)
            ->with('message', sprintf(config('system.messages.create_succeeded'), $item->id));
    }
    
    public function destroy_items(Request $request, $id) {
        $group = CableItemGroup::find($id);

        $group->removeItems($request->removes);
        $group->save();

        foreach ($request->removes as $id) {
            $item = Item::find($id);
            $item->delete();
        }

        return redirect()
            ->route('admin.cable.edit', $group)
            ->with('message', sprintf(config('system.messages.delete_succeeded'), implode(',', $request->removes)));
    }


    /**
     * --------------------------------------------------------------------------------------------
     *  CSV
     * --------------------------------------------------------------------------------------------
     */
    public function export_csv(Request $request)
    {
        //$list = $this->query($request)->get();
        $list = CableItemGroup::get();
        return new StreamedResponse(function() use ($list) {
            $fh = fopen('php://output', 'w');

            fputcsv($fh, mb_convert_encoding([
                'ID',
                'NEWステータス',
                '公開ステータス',
                '生産終了ステータス',
                'シリーズ型式',
                '電源側コネクタ',
                '照明側コネクタ',
                '使用温度',
                '使用湿度',
                '適合規格1',
                '適合規格2',
                '備考欄',
            ], 'cp932', 'utf8'));
            fputcsv($fh, mb_convert_encoding([
                '言語',
                '備考記述1',
                '備考記述2',
                '備考記述3',
                '備考記述4',
                '備考記述5',
                '注意書き',
            ], 'cp932', 'utf8'));
            fputcsv($fh, mb_convert_encoding([
                '',
                'ID',
                '貸出可能',
                '個別型式',
                '品番',
                '接続条件',
                'ケーブル長さ[ja]',
                'ケーブル長さ[en]',
            ], 'cp932', 'utf8'));
            fputcsv($fh, [config('system.csv.cable.identifier')]);

            foreach ($list as $group) {
                $item = $group->first_item();
                fputcsv($fh, mb_convert_encoding([
                    $group->id,
                    $item->is_new       ? '1' : '0',
                    $item->is_publish   ? '1' : '0',
                    $item->is_end       ? '1' : '0',
                    $item->series->model,
                    $group->power_connector,
                    $group->lighting_connector,
                    $item->operating_temperature,
                    $item->operating_humidity,
                    $item->is_RoHS ? '1' : ($item->is_RoHS2 ? '2' : '0'),
                    $item->is_CN_RoHSe1 ? '1' : ($item->is_CN_RoHS102 ? '2' : '0'),
                    $item->memo,
                ], 'cp932', 'utf8'));

                foreach (config('system.language.list') as $lang) {
                    $detail = $group->details()->where('language', $lang)->first();
                    fputcsv($fh, mb_convert_encoding([
                        $lang,
                        $detail->description1,
                        $detail->description2,
                        $detail->description3,
                        $detail->description4,
                        $detail->description5,
                        $detail->note,
                    ], 'cp932', 'utf8'));
                }

                foreach ($group->items() as $item) {
                    $ja_detail = $item->cable_items()->where('language', 'ja')->first();
                    $en_detail = $item->cable_items()->where('language', 'en')->first();
                    fputcsv($fh, mb_convert_encoding([
                        '',
                        $item->id,
                        $item->is_lend ? '1' : '0',
                        $item->model,
                        $item->product_number,
                        $ja_detail->conditions ?? '',
                        $ja_detail->length ?? '',
                        $en_detail->length ?? '',
                    ], 'cp932', 'utf8'));
                }
            }
            fclose($fh);
        }, 200, [
            'Content-Type'          => 'text/csv',
            'Content-Disposition'   => sprintf('attachment; filename="%s"', config('system.csv.cable.filename')),
        ]);
    }

    public function import_csv(Request $request) {
        $request->validate([
            'csv' => 'required',
        ]);

        $inserts = [];
        $updates = [];
        $error = '';
        $no = 0;
        $file = $request->file('csv');
        if ($file) {
            try {
                $fp = fopen($file->getRealPath(), 'r');
                fgetcsv($fp); $no++;
                fgetcsv($fp); $no++;
                fgetcsv($fp); $no++;
                $line = fgetcsv($fp); $no++;
                if ($line[0]!=config('system.csv.cable.identifier')) {
                    throw new \Exception('対象のファイルではありません');
                }

                $group = null;
                $group_info = null;
                while(($line=fgetcsv($fp))!==false) {
                    $no++;
                    $line = mb_convert_encoding($line, 'utf8', 'cp932');

                    if (($line[0]=='' && $line[1]!='') || is_numeric($line[0])) {
                        $create = false;
                        if ($line[0]=='') {
                            $create = true;
                            $group = new CableItemGroup();
                        } else {
                            $group = CableItemGroup::find($line[0]);
                            if (!$group) {
                                throw new \Exception('指定されたIDが存在しません');
                            }
                        }

                        $group_info = $line;
                        $group->power_connector     = $line[5];
                        $group->lighting_connector  = $line[6];
                        $group->save();
                    } else if (in_array($line[0], config('system.language.list'))) {
                        if (!$group) {
                            throw new \Exception('グループが不明です');
                        }
                        $detail = $group->details()->where('language', $line[0])->first();

                        $detail->description1   = $line[1];
                        $detail->description2   = $line[2];
                        $detail->description3   = $line[3];
                        $detail->description4   = $line[4];
                        $detail->description5   = $line[5];
                        $detail->note           = $line[6];
                        $detail->save();
                    } else if ($line[0]=='' && ($line[1]=='' || is_numeric($line[1]))) {
                        if (!$group) {
                            throw new \Exception('グループが不明です');
                        }
                        if (!$group_info) {
                            throw new \Exception('グループ情報が不明です');
                        }

                        $item = null;
                        if ($line[1]=='') {
                            $item = new Item();
                        } else {
                            $item = Item::find($line[1]);
                            if (!$item) {
                                throw new \Exception('指定されたIDが存在しません');
                            }
                        }

                        $item->is_new       = $group_info[1];
                        $item->is_publish   = $group_info[2];
                        $item->is_end       = $group_info[3];

                        $series = Series::where('model', $group_info[4])->first();
                        if (!$series) {
                            throw new \Exception('シリーズ型式が存在しません');
                        }
                        $item->series_id = $series->id;

                        $item->is_lend          = $line[2];
                        $item->model            = $line[3];
                        $item->product_number   = $line[4];
                        $item->save();

                        foreach (condig('system.language.list') as $lang) {
                            $detail = $item->cable_items()->where('language', $lang)->first();
                            if (!$detail) {
                                $detail = new CableItem();
                                $detail->item_id = $item->id;
                                $detail->lang    = $lang;
                            }
                            $detail->conditions = $line[5];
                            $detail->length     = match($lang) {
                                'ja' => $line[6],
                                'en' => $line[7],
                            };
                            $detail->save();
                        }
                    } else {
                        throw new \Exception('不明な行です');
                    }
                }
            } catch (\Exception $e) {
                $error = $no . '行目：' . $e->getMessage();
            }
        }

        return view('admin/csv_result', [
            'inserts'   => $inserts,
            'updates'   => $updates,
            'error'     => $error,
        ]);
    }


}
