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
use App\Enums\Color;
use App\Enums\DimmableControl;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
            'series'        => Series::where('category', $request->category)->pluck('model', 'id'),
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
            'series'        => Series::where('category', $item->series->category)->pluck('model', 'id'),
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
    public function destroy(Request $request, Item $item)
    {
        $id = $item->id;
        $item->delete();
        return redirect()
            ->route('admin.item.index', ['category'=>$request->category])
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

    protected function syncRelatedSeriesFromCsv($category, $related_series, $list, $errorLabel) {
        $ids = [];
        if ($list) {
            foreach (explode(',', $list) as $model) {
                $series = Series::where('model', $model)->first();
                if (!$series) {
                    throw new \Exception("{$errorLabel}：指定型式がありません「{$model}」");
                }
                $ids[] = $series->id;
            }
            $this->syncRelatedSeries($category, $ids, $related_series);
        }
    }

    protected function saveLighting($item, $request, $multi_params) {
        $details = $item->lighting_items->keyBy('language');
        foreach ($multi_params as $lang => $values) {
            unset($values['external_view_pdf']);
            unset($values['external_view_dxf']);
            if ($lang!='ja') {
                $values = $values + $multi_params['ja'];
            }
            LightingItem::updateOrInsert([
                'item_id'   => $item->id,
                'language'  => $lang,
            ], array_merge([
                'item_id'   => $item->id,
                'language'  => $lang,
            ], $values));

            if (isset($detail[$lang])) {
                $details[$lang]->uploadFile('external_view_pdf', $request->file($lang.':external_view_pdf'));
                $details[$lang]->uploadFile('external_view_dxf', $request->file($lang.':external_view_dxf'));
            }
        }
    }
    
    protected function saveController($item, $request, $multi_params) {
        $details = $item->controller_items->keyBy('language');
        foreach ($multi_params as $lang => $values) {
            unset($values['external_view_pdf']);
            unset($values['external_view_dxf']);
            if ($lang!='ja') {
                $values = $values + $multi_params['ja'];
            }
            ControllerItem::updateOrInsert([
                'item_id'   => $item->id,
                'language'  => $lang,
            ], array_merge([
                'item_id'   => $item->id,
                'language'  => $lang,
            ], $values));

            if (isset($detail[$lang])) {
                $details[$lang]->uploadFile('external_view_pdf', $request->file($lang.':external_view_pdf'));
                $details[$lang]->uploadFile('external_view_dxf', $request->file($lang.':external_view_dxf'));
            }
        }
    }
    
    protected function saveOption($item, $request, $multi_params) {
        $details = $item->option_items->keyBy('language');
        foreach ($multi_params as $lang => $values) {
            unset($values['external_view_pdf']);
            unset($values['external_view_dxf']);
            if ($lang!='ja') {
                $values = $values + $multi_params['ja'];
            }
            OptionItem::updateOrInsert([
                'item_id'   => $item->id,
                'language'  => $lang,
            ], array_merge([
                'item_id'   => $item->id,
                'language'  => $lang,
            ], $values));

            if (isset($detail[$lang])) {
                $details[$lang]->uploadFile('external_view_pdf', $request->file($lang.':external_view_pdf'));
                $details[$lang]->uploadFile('external_view_dxf', $request->file($lang.':external_view_dxf'));
            }
        }
    }


    /**
     * --------------------------------------------------------------------------------------------
     *  CSV lighting
     * --------------------------------------------------------------------------------------------
     */
    public function export_lighting_csv(Request $request) {
        $list = $this->lightingItemQuery($request)->get();
        return new StreamedResponse(function() use ($list) {
            $fh = fopen('php://output', 'w');

            fputcsv($fh, mb_convert_encoding([
                'ID',
                'NEWステータス',
                '公開ステータス',
                '生産終了ステータス',
                '貸出可能ステータス',
                'シリーズ型式',
                '個別型式',
                '品番',
                '使用温度',
                '使用湿度',
                '器具重量',
                '適合規格1',
                '適合規格2',
                '適合規格3',
                '適合規格4',
                '適合規格5',
                '備考欄',
                '関連製品_コントローラー',
                '関連製品_ケーブル',
                '関連製品_オプション',
            ], 'cp932', 'utf8'));
            fputcsv($fh, mb_convert_encoding([
                '言語',
                'タイプ',
                '発光色',
                '発光色記号',
                '色温度/ピーク波長',
                '消費電力',
                'CH数',
                '入力',
                'その他',
                '備考記述1',
                '備考記述2',
                '備考記述3',
                '備考記述4',
                '備考記述5',
                '注意書き',
            ], 'cp932', 'utf8'));
            fputcsv($fh, [config('system.csv.lighting.identifier')]);

            foreach ($list as $item) {
                $r_controllers = [];
                foreach ($item->related_controllers as $r) {
                    $r_controllers[]  = $r->model;
                }
                $r_controllers = implode(',', $r_controllers);

                $r_cables = [];
                foreach ($item->related_cables as $r) {
                    $r_cables[]  = $r->model;
                }
                $r_cables = implode(',', $r_cables);

                $r_options = [];
                foreach ($item->related_options as $r) {
                    $r_options[]  = $r->model;
                }
                $r_options = implode(',', $r_options);

                fputcsv($fh, mb_convert_encoding([
                    $item->id,
                    $item->is_new       ? '1' : '0',
                    $item->is_publish   ? '1' : '0',
                    $item->is_end       ? '1' : '0',
                    $item->is_lend      ? '1' : '0',
                    $item->series->model,
                    $item->model,
                    $item->product_number,
                    $item->operating_temperature,
                    $item->operating_humidity,
                    $item->weight,
                    $item->is_RoHS ? '1' : ($item->is_RoHS2 ? '2' : '0'),
                    $item->is_CN_RoHSe1 ? '1' : ($item->is_CN_RoHS102 ? '2' : '0'),
                    $item->is_CE_IEC ? '1' : ($item->is_CE_EN ? '2' : '0'),
                    $item->is_UKCA ? '1' : '0',
                    $item->is_PSE ? '1' : '0',
                    $item->memo,
                    $r_controllers,
                    $r_cables,
                    $r_options,
                ], 'cp932', 'utf8'));

                foreach (config('system.language.list') as $lang) {
                    $detail = $item->lighting_items()->where('language', $lang)->first();
                    if ($detail) {
                        fputcsv($fh, mb_convert_encoding([
                            $lang,
                            $detail->type,
                            match($detail->color) {
                                Color::NONE             => '',
                                Color::WHITE            => config('system.csv.enums.color.white'),
                                Color::BLUE             => config('system.csv.enums.color.blue'),
                                Color::GREEN            => config('system.csv.enums.color.green'),
                                Color::YELLOW           => config('system.csv.enums.color.yellow'),
                                Color::RED              => config('system.csv.enums.color.red'),
                                Color::IR_UNDER_1000    => config('system.csv.enums.color.ir_u1000'),
                                Color::IR_OVER_1000     => config('system.csv.enums.color.ir_o1000'),
                                Color::UV_UNDER_280     => config('system.csv.enums.color.uv_u280'),
                                Color::UV_OVER_280      => config('system.csv.enums.color.uv_o280'),
                                Color::FULL_COLOR       => config('system.csv.enums.color.full_color'),
                                Color::MULTI_COLOR      => config('system.csv.enums.color.multi_color'),
                            },
                            $detail->color1,
                            $detail->color2,
                            $detail->power_consumption,
                            $detail->num_of_ch,
                            $detail->input,
                            $detail->etc,
                            $detail->description1,
                            $detail->description2,
                            $detail->description3,
                            $detail->description4,
                            $detail->description5,
                            $detail->note,
                        ], 'cp932', 'utf8'));
                    }
                }
            }
            fclose($fh);
        }, 200, [
            'Content-Type'          => 'text/csv',
            'Content-Disposition'   => sprintf('attachment; filename="%s"', config('system.csv.lighting.filename')),
        ]);
    }

    public function import_lighting_csv(Request $request) {
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
                $line = fgetcsv($fp); $no++;
                if ($line[0]!=config('system.csv.lighting.identifier')) {
                    throw new \Exception('対象のファイルではありません');
                }

                $item = null;
                while(($line=fgetcsv($fp))!==false) {
                    $no++;
                    $line = mb_convert_encoding($line, 'utf8', 'cp932');
                    if ($line[0]=='' || is_numeric($line[0])) {
                        $create = false;
                        $item = null;
                        if ($line[0]=='') {
                            $create = true;
                            $item = new Item();
                        } else {
                            $item = Item::find($line[0]);
                            if (!$item) {
                                throw new \Exception('指定されたIDが存在しません');
                            }
                        }

                        $item->is_new       = $line[1];
                        $item->is_publish   = $line[2];
                        $item->is_end       = $line[3];
                        $item->is_lend      = $line[4];

                        $series = Series::where('model', $line[5])->first();
                        if (!$series) {
                            throw new \Exception('シリーズ型式が存在しません');
                        }
                        $item->series_id = $series->id;

                        $item->model                    = $line[6];
                        $item->product_number           = $line[7];
                        $item->operating_temperature    = $line[8];
                        $item->operating_humidity       = $line[9];
                        $item->weight                   = $line[10];

                        $item->is_RoHS          = $line[11]=='1';
                        $item->is_RoHS2         = $line[11]=='2';
                        $item->is_CN_RoHSe1     = $line[12]=='1';
                        $item->is_CN_RoHS102    = $line[12]=='2';
                        $item->is_CE_IEC        = $line[13]=='1';
                        $item->is_CE_EN         = $line[13]=='2';
                        $item->is_UKCA          = $line[14]=='1';
                        $item->is_PSE           = $line[15]=='1';

                        $item->memo = $line[16];

                        $this->syncRelatedSeriesFromCsv(CATEGORY::CONTROLLER, $item->related_controllers(), $line[17], '関連製品コントローラー');
                        $this->syncRelatedSeriesFromCsv(CATEGORY::CABLE, $item->related_cables(), $line[18], '関連製品ケーブル');
                        $this->syncRelatedSeriesFromCsv(CATEGORY::OPTION, $item->related_options(), $line[19], '関連製品オプション');

                        $item->save();
                    } else if (in_array($line[0], config('system.language.list'))) {
                        if (!$item) {
                            throw new \Exception('個別が不明です');
                        }
                        $detail = $item->lighting_items()->where('language', $line[0])->first();
                        if (!$detail) {
                            $detail = new LightingItem([
                                'item_id'   => $item->id,
                                'language'  => $line[0],
                            ]);
                        }
                        $detail->type               = $line[1];

                        $tmp->color = match($line[2]) {
                            config('system.csv.enums.color.white')          => Color::WHITE,
                            config('system.csv.enums.color.blue')           => Color::BLUE,
                            config('system.csv.enums.color.green')          => Color::GREEN,
                            config('system.csv.enums.color.yellow')         => Color::YELLOW,
                            config('system.csv.enums.color.red')            => Color::RED,
                            config('system.csv.enums.color.ir_u1000')       => Color::IR_UNDER_1000,
                            config('system.csv.enums.color.ir_o1000')       => Color::IR_OVER_1000,
                            config('system.csv.enums.color.uv_u280')        => Color::UV_UNDER_280,
                            config('system.csv.enums.color.uv_o280')        => Color::UV_OVER_280,
                            config('system.csv.enums.color.full_color')     => Color::FULL_COLOR,
                            config('system.csv.enums.color.multi_color')    => Color::MULTI_COLOR,
                            default                                         => false,
                        };
                        if ($tmp===false) {
                            throw new \Exception(sprintf('"発光色" が不正です 【%s】', $line[2]));
                        }
                        $detail->color = $tmp;

                        $detail->color1             = $line[3];
                        $detail->color2             = $line[4];
                        $detail->power_consumption  = $line[5];
                        $detail->num_of_ch          = $line[6];
                        $detail->input              = $line[7];
                        $detail->etc                = $line[8];
                        $detail->description1       = $line[9];
                        $detail->description2       = $line[10];
                        $detail->description3       = $line[11];
                        $detail->description4       = $line[12];
                        $detail->description5       = $line[13];
                        $detail->note               = $line[14];
                        $detail->save();
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

    /**
     * --------------------------------------------------------------------------------------------
     *  CSV controller
     * --------------------------------------------------------------------------------------------
     */
    public function export_controller_csv(Request $request) {
        $list = $this->controllerItemQuery($request)->get();
        return new StreamedResponse(function() use ($list) {
            $fh = fopen('php://output', 'w');

            fputcsv($fh, mb_convert_encoding([
                'ID',
                'NEWステータス',
                '公開ステータス',
                '生産終了ステータス',
                '貸出可能ステータス',
                'シリーズ型式',
                '個別型式',
                '品番',
                '使用温度',
                '使用湿度',
                '器具重量',
                '適合規格1',
                '適合規格2',
                '適合規格3',
                '適合規格4',
                '適合規格5',
                '備考欄',
                '調光制御',
                '外部ON/OFF制御',
                '外部調光制御/LAN通信',
                '外部調光制御/8bitパラレル',
                '外部調光制御/10bitパラレル',
                '外部調光制御/RS-232C',
                '外部調光制御/アナログ',
                '関連製品_ケーブル',
                '関連製品_オプション',
            ], 'cp932', 'utf8'));
            fputcsv($fh, mb_convert_encoding([
                '言語',
                'タイプ',
                '発光色',
                '発光色記号',
                '色温度/ピーク波長',
                '消費電力',
                'CH数',
                '入力',
                'その他',
                '備考記述1',
                '備考記述2',
                '備考記述3',
                '備考記述4',
                '備考記述5',
                '注意書き',
            ], 'cp932', 'utf8'));
            fputcsv($fh, [config('system.csv.controller.identifier')]);

            foreach ($list as $item) {
                $r_cables = [];
                foreach ($item->related_cables as $r) {
                    $r_cables[]  = $r->model;
                }
                $r_cables = implode(',', $r_cables);

                $r_options = [];
                foreach ($item->related_options as $r) {
                    $r_options[]  = $r->model;
                }
                $r_options = implode(',', $r_options);

                fputcsv($fh, mb_convert_encoding([
                    $item->id,
                    $item->is_new       ? '1' : '0',
                    $item->is_publish   ? '1' : '0',
                    $item->is_end       ? '1' : '0',
                    $item->is_lend      ? '1' : '0',
                    $item->series->model,
                    $item->model,
                    $item->product_number,
                    $item->operating_temperature,
                    $item->operating_humidity,
                    $item->weight,
                    $item->is_RoHS ? '1' : ($item->is_RoHS2 ? '2' : '0'),
                    $item->is_CN_RoHSe1 ? '1' : ($item->is_CN_RoHS102 ? '2' : '0'),
                    $item->is_CE_IEC ? '1' : ($item->is_CE_EN ? '2' : '0'),
                    $item->is_UKCA ? '1' : '0',
                    $item->is_PSE ? '1' : '0',
                    $item->memo,
                    match($item->japanese_controller_item->dimmable_control) {
                        DimmableControl::PWM                => config('system.csv.enums.dimmable_control.pwm'),
                        DimmableControl::VARIABLE_CURRENT   => config('system.csv.enums.dimmable_control.variable_current'),
                        DimmableControl::VARIABLE_VOLTAGE   => config('system.csv.enums.dimmable_control.variable_voltage'),
                        DimmableControl::OVERDRIVE          => config('system.csv.enums.dimmable_control.overdrive'),
                    },
                    $item->japanese_controller_item->is_external_switch   ? '1' : '0',
                    $item->japanese_controller_item->is_ethernet          ? '1' : '0',
                    $item->japanese_controller_item->is_8bit_parallel     ? '1' : '0',
                    $item->japanese_controller_item->is_10bit_parallel    ? '1' : '0',
                    $item->japanese_controller_item->is_rs232c            ? '1' : '0',
                    $item->japanese_controller_item->is_analog            ? '1' : '0',
                    $r_cables,
                    $r_options,
                ], 'cp932', 'utf8'));

                foreach (config('system.language.list') as $lang) {
                    $detail = $item->controller_items()->where('language', $lang)->first();
                    fputcsv($fh, mb_convert_encoding([
                        $lang,
                        $detail->type,
                        $detail->total_capacity,
                        $detail->num_of_ch,
                        $detail->input,
                        $detail->output,
                        $detail->description1,
                        $detail->description2,
                        $detail->description3,
                        $detail->description4,
                        $detail->description5,
                        $detail->note,
                    ], 'cp932', 'utf8'));
                }
            }
            fclose($fh);
        }, 200, [
            'Content-Type'          => 'text/csv',
            'Content-Disposition'   => sprintf('attachment; filename="%s"', config('system.csv.controller.filename')),
        ]);
    }

    public function import_controller_csv(Request $request) {
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
                $line = fgetcsv($fp); $no++;
                if ($line[0]!=config('system.csv.controller.identifier')) {
                    throw new \Exception('対象のファイルではありません');
                }

                $item = null;
                while(($line=fgetcsv($fp))!==false) {
                    $no++;
                    $line = mb_convert_encoding($line, 'utf8', 'cp932');
                    if ($line[0]=='' || is_numeric($line[0])) {
                        $create = false;
                        $item = null;
                        if ($line[0]=='') {
                            $create = true;
                            $item = new Item();
                        } else {
                            $item = Item::find($line[0]);
                            if (!$item) {
                                throw new \Exception('指定されたIDが存在しません');
                            }
                        }

                        $item->is_new       = $line[1];
                        $item->is_publish   = $line[2];
                        $item->is_end       = $line[3];
                        $item->is_lend      = $line[4];

                        $series = Series::where('model', $line[5])->first();
                        if (!$series) {
                            throw new \Exception('シリーズ型式が存在しません');
                        }
                        $item->series_id = $series->id;

                        $item->model                    = $line[6];
                        $item->product_number           = $line[7];
                        $item->operating_temperature    = $line[8];
                        $item->operating_humidity       = $line[9];
                        $item->weight                   = $line[10];

                        $item->is_RoHS          = $line[11]=='1';
                        $item->is_RoHS2         = $line[11]=='2';
                        $item->is_CN_RoHSe1     = $line[12]=='1';
                        $item->is_CN_RoHS102    = $line[12]=='2';
                        $item->is_CE_IEC        = $line[13]=='1';
                        $item->is_CE_EN         = $line[13]=='2';
                        $item->is_UKCA          = $line[14]=='1';
                        $item->is_PSE           = $line[15]=='1';

                        $item->memo = $line[16];

                        $tmp = match($line[17]) {
                            config('system.csv.enums.dimmable_control.pwm')                 => DimmableControl::PWM,
                            config('system.csv.enums.dimmable_control.variable_current')    => DimmableControl::VARIABLE_CURRENT,
                            config('system.csv.enums.dimmable_control.variable_voltage')    => DimmableControl::VARIABLE_VOLTAGE,
                            config('system.csv.enums.dimmable_control.overdrive')           => DimmableControl::OVERDRIVE,
                            default                                                         => false,
                        };
                        if ($tmp===false) {
                            throw new \Exception(sprintf('"調光制御" が不正です 【%s】', $line[17]));
                        }
                        $item->japanese_controller_item->dimmable_control       = $tmp;

                        $item->japanese_controller_item->is_external_switch     = $line[18];
                        $item->japanese_controller_item->is_ethernet            = $line[19];
                        $item->japanese_controller_item->is_8bit_parallel       = $line[20];
                        $item->japanese_controller_item->is_10bit_parallel      = $line[21];
                        $item->japanese_controller_item->is_rs232c              = $line[22];
                        $item->japanese_controller_item->is_analog              = $line[23];

                        $this->syncRelatedSeriesFromCsv(CATEGORY::CABLE, $item->related_cables(), $line[24], '関連製品ケーブル');
                        $this->syncRelatedSeriesFromCsv(CATEGORY::OPTION, $item->related_options(), $line[25], '関連製品オプション');

                        $item->save();
                    } else if (in_array($line[0], config('system.language.list'))) {
                        if (!$item) {
                            throw new \Exception('個別が不明です');
                        }
                        $detail = $item->controller_items()->where('language', $line[0])->first();
                        if (!$detail) {
                            $detail = new ControllerItem([
                                'item_id'   => $item->id,
                                'language'  => $line[0],
                            ]);
                        }
                        $detail->type               = $line[1];
                        $detail->total_capacity     = $line[2];
                        $detail->num_of_ch          = $line[3];
                        $detail->input              = $line[4];
                        $detail->output             = $line[5];
                        $detail->description1       = $line[6];
                        $detail->description2       = $line[7];
                        $detail->description3       = $line[8];
                        $detail->description4       = $line[9];
                        $detail->description5       = $line[10];
                        $detail->note               = $line[11];
                        $detail->save();
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

    /**
     * --------------------------------------------------------------------------------------------
     *  CSV option
     * --------------------------------------------------------------------------------------------
     */
    public function export_option_csv(Request $request) {
        $list = $this->controllerItemQuery($request)->get();
        return new StreamedResponse(function() use ($list) {
            $fh = fopen('php://output', 'w');

            fputcsv($fh, mb_convert_encoding([
                'ID',
                'NEWステータス',
                '公開ステータス',
                '生産終了ステータス',
                '貸出可能ステータス',
                'シリーズ型式',
                '個別型式',
                '品番',
                '使用温度',
                '使用湿度',
                '器具重量',
                '適合規格1',
                '適合規格2',
                '適合規格3',
                '適合規格4',
                '適合規格5',
                '備考欄',
                '関連製品_オプション',
            ], 'cp932', 'utf8'));
            fputcsv($fh, mb_convert_encoding([
                '言語',
                'タイプ',
                '透過率',
                '備考記述1',
                '備考記述2',
                '備考記述3',
                '備考記述4',
                '備考記述5',
                '注意書き',
            ], 'cp932', 'utf8'));
            fputcsv($fh, [config('system.csv.option.identifier')]);

            foreach ($list as $item) {
                $r_options = [];
                foreach ($item->related_options as $r) {
                    $r_options[]  = $r->model;
                }
                $r_options = implode(',', $r_options);

                fputcsv($fh, mb_convert_encoding([
                    $item->id,
                    $item->is_new       ? '1' : '0',
                    $item->is_publish   ? '1' : '0',
                    $item->is_end       ? '1' : '0',
                    $item->is_lend      ? '1' : '0',
                    $item->series->model,
                    $item->model,
                    $item->product_number,
                    $item->operating_temperature,
                    $item->operating_humidity,
                    $item->weight,
                    $item->is_RoHS ? '1' : ($item->is_RoHS2 ? '2' : '0'),
                    $item->is_CN_RoHSe1 ? '1' : ($item->is_CN_RoHS102 ? '2' : '0'),
                    $item->is_CE_IEC ? '1' : ($item->is_CE_EN ? '2' : '0'),
                    $item->is_UKCA ? '1' : '0',
                    $item->is_PSE ? '1' : '0',
                    $item->memo,
                    $r_options,
                ], 'cp932', 'utf8'));

                foreach (config('system.language.list') as $lang) {
                    $detail = $item->controller_items()->where('language', $lang)->first();
                    fputcsv($fh, mb_convert_encoding([
                        $lang,
                        $detail->type,
                        $detail->throughput,
                        $detail->description1,
                        $detail->description2,
                        $detail->description3,
                        $detail->description4,
                        $detail->description5,
                        $detail->note,
                    ], 'cp932', 'utf8'));
                }
            }
            fclose($fh);
        }, 200, [
            'Content-Type'          => 'text/csv',
            'Content-Disposition'   => sprintf('attachment; filename="%s"', config('system.csv.option.filename')),
        ]);
    }

    public function import_option_csv(Request $request) {
        $request->validate([
            'csv' => 'required',
        ]);

        $inserts = [];
        $updates = [];
        $error = '';
        $no = 1;
        $file = $request->file('csv');
        if ($file) {
            try {
                $fp = fopen($file->getRealPath(), 'r');
                fgetcsv($fp); $no++;
                fgetcsv($fp); $no++;
                $line = fgetcsv($fp); $no++;
                if ($line[0]!=config('system.csv.option.identifier')) {
                    throw new \Exception('対象のファイルではありません');
                }

                $item = null;
                while(($line=fgetcsv($fp))!==false) {
                    $no++;
                    $line = mb_convert_encoding($line, 'utf8', 'cp932');
                    if ($line[0]=='' || is_numeric($line[0])) {
                        $create = false;
                        $item = null;
                        if ($line[0]=='') {
                            $create = true;
                            $item = new Item();
                        } else {
                            $item = Item::find($line[0]);
                            if (!$item) {
                                throw new \Exception('指定されたIDが存在しません');
                            }
                        }

                        $item->is_new       = $line[1];
                        $item->is_publish   = $line[2];
                        $item->is_end       = $line[3];
                        $item->is_lend      = $line[4];

                        $series = Series::where('model', $line[5])->first();
                        if (!$series) {
                            throw new \Exception('シリーズ型式が存在しません');
                        }
                        $item->series_id = $series->id;

                        $item->model                    = $line[6];
                        $item->product_number           = $line[7];
                        $item->operating_temperature    = $line[8];
                        $item->operating_humidity       = $line[9];
                        $item->weight                   = $line[10];

                        $item->is_RoHS          = $line[11]=='1';
                        $item->is_RoHS2         = $line[11]=='2';
                        $item->is_CN_RoHSe1     = $line[12]=='1';
                        $item->is_CN_RoHS102    = $line[12]=='2';
                        $item->is_CE_IEC        = $line[13]=='1';
                        $item->is_CE_EN         = $line[13]=='2';
                        $item->is_UKCA          = $line[14]=='1';
                        $item->is_PSE           = $line[15]=='1';

                        $item->memo = $line[16];

                        $this->syncRelatedSeriesFromCsv(CATEGORY::OPTION, $item->related_options(), $line[19], '関連製品オプション');

                        $item->save();
                    } else if (in_array($line[0], config('system.language.list'))) {
                        if (!$item) {
                            throw new \Exception('個別が不明です');
                        }
                        $detail = $item->cable_items()->where('language', $line[0])->first();
                        if (!$detail) {
                            $detail = new CableItem([
                                'item_id'   => $item->id,
                                'language'  => $line[0],
                            ]);
                        }
                        $detail->type               = $line[1];
                        $detail->throughput         = $line[2];
                        $detail->description1       = $line[3];
                        $detail->description2       = $line[4];
                        $detail->description3       = $line[5];
                        $detail->description4       = $line[6];
                        $detail->description5       = $line[7];
                        $detail->note               = $line[8];
                        $detail->save();
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
