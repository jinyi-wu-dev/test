@extends('admin/base')


@section('content')
  @include('admin.parts.modal', [
    'id'      => 'conformModal',
    'title'   => '削除',
    'message' => '削除します。よろしいですか？',
    'on_ok'   => 'doDelete();',
  ])
  <section class="content">
    <div class="container-fluid">

        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">共通項目</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                @include('admin.parts.form_text', [
                  'name'      => 'id',
                  'label'     => 'ID',
                  'valiable'  => 'series',
                  'disabled'  => true,
                ])
                @include('admin.parts.custom_checkbox', [
                  'switch'      => true,
                  'name'        => 'is_new',
                  'label'       => 'NEW',
                  'valiable'    => 'series',
                  'empty_value' => true,
                ])
                @include('admin.parts.custom_checkbox', [
                  'switch'      => true,
                  'name'        => 'is_end',
                  'label'       => '生産終了',
                  'valiable'    => 'series',
                  'empty_value' => true,
                ])
                @include('admin.parts.custom_checkbox', [
                  'switch'      => true,
                  'name'        => 'is_publish',
                  'label'       => '公開',
                  'valiable'    => 'series',
                  'empty_value' => true,
                ])
                @include('admin.parts.form_select', [
                  'name'      => 'category',
                  'label'     => '品目タイプ',
                  'value'     => $series->category->value ?? '',
                  'empty'     => true,
                  'options'   => App\Enums\Category::keyLabel(),
                ])
                @include('admin.parts.form_select', [
                  'name'      => 'genre',
                  'label'     => 'ジャンル',
                  'value'     => $series->genre->value ?? '',
                  'empty'     => true,
                  'options'   => App\Enums\Genre::keyLabel(),
                ])
                @include('admin.parts.form_file', [
                  'name'        => 'image',
                  'label'       => '商品画像',
                  'image_path'  => isset($series)&&$series->hasFile('image') ? $series->fileUrl('image') : '',
                  'no_cache'    => true,
                ])
                @include('admin.parts.form_file', [
                  'name'        => 'catalogue',
                  'label'       => 'カタログ',
                  'file_label'  => isset($series)&&$series->hasFile('catalogue') ? '○' : '-',
                ])
                @include('admin.parts.form_file', [
                  'name'        => 'pamphlet',
                  'label'       => 'パンフレット',
                  'file_label'  => isset($series)&&$series->hasFile('pamphlet') ? '○' : '-',
                ])
                @include('admin.parts.form_file', [
                  'name'        => 'manual',
                  'label'       => '取扱説明書',
                  'file_label'  => isset($series)&&$series->hasFile('manual') ? '○' : '-',
                ])
                <div class="form-group">
                  <label>型式一覧表に表示する項目 [共通項目]</label>
                  <div class="d-flex flex-row flex-wrap justify-content-start">
                    <div class="p-2">
                      @include('admin.parts.custom_checkbox', [
                        'switch'    => true,
                        'name'      => 'show_type',
                        'label'     => 'タイプ',
                        'valiable'  => 'series',
                        'empty_value' => true,
                      ])
                    </div>
                    <div class="p-2">
                      @include('admin.parts.custom_checkbox', [
                        'switch'    => true,
                        'name'      => 'show_model',
                        'label'     => '型式',
                        'valiable'  => 'series',
                        'empty_value' => true,
                      ])
                    </div>
                    <div class="p-2">
                      @include('admin.parts.custom_checkbox', [
                        'switch'    => true,
                        'name'      => 'show_product_number',
                        'label'     => '品番',
                        'valiable'  => 'series',
                        'empty_value' => true,
                      ])
                    </div>
                    <div class="p-2">
                      @include('admin.parts.custom_checkbox', [
                        'switch'    => true,
                        'name'      => 'show_weight',
                        'label'     => '器具重量',
                        'valiable'  => 'series',
                        'empty_value' => true,
                      ])
                    </div>
                    <div class="p-2">
                      @include('admin.parts.custom_checkbox', [
                        'switch'    => true,
                        'name'      => 'show_other',
                        'label'     => 'その他',
                        'valiable'  => 'series',
                        'empty_value' => true,
                      ])
                    </div>
                    <div class="p-2">
                      @include('admin.parts.custom_checkbox', [
                        'switch'    => true,
                        'name'      => 'show_compatible_standards',
                        'label'     => '適合規格',
                        'valiable'  => 'series',
                        'empty_value' => true,
                      ])
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>型式一覧表に表示する項目 [照明項目]</label>
                  <div class="d-flex flex-row flex-wrap justify-content-start">
                    <div class="p-2">
                      @include('admin.parts.custom_checkbox', [
                        'switch'    => true,
                        'name'      => 'show_luminous_color',
                        'label'     => '発光色（ピーク波長、色温度）',
                        'valiable'  => 'series',
                        'empty_value' => true,
                      ])
                    </div>
                    <div class="p-2">
                      @include('admin.parts.custom_checkbox', [
                        'switch'    => true,
                        'name'      => 'show_lt_num_of_ch',
                        'label'     => 'CH数',
                        'valiable'  => 'series',
                        'empty_value' => true,
                      ])
                    </div>
                    <div class="p-2">
                      @include('admin.parts.custom_checkbox', [
                        'switch'    => true,
                        'name'      => 'show_power_consumption',
                        'label'     => '消費電力',
                        'valiable'  => 'series',
                        'empty_value' => true,
                      ])
                    </div>
                    <div class="p-2">
                      @include('admin.parts.custom_checkbox', [
                        'switch'    => true,
                        'name'      => 'show_seg',
                        'label'     => 'SAG値',
                        'valiable'  => 'series',
                        'empty_value' => true,
                      ])
                    </div>
                    <div class="p-2">
                      @include('admin.parts.custom_checkbox', [
                        'switch'    => true,
                        'name'      => 'show_input_voltage',
                        'label'     => '入力電圧',
                        'valiable'  => 'series',
                        'empty_value' => true,
                      ])
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>型式一覧表に表示する項目 [コントローラ項目]</label>
                  <div class="d-flex flex-row flex-wrap justify-content-start">
                    <div class="p-2">
                      @include('admin.parts.custom_checkbox', [
                        'switch'    => true,
                        'name'      => 'show_diming_controll',
                        'label'     => '調光制御',
                        'valiable'  => 'series',
                        'empty_value' => true,
                      ])
                    </div>
                    <div class="p-2">
                      @include('admin.parts.custom_checkbox', [
                        'switch'    => true,
                        'name'      => 'show_total_capacity',
                        'label'     => '合計容量',
                        'valiable'  => 'series',
                        'empty_value' => true,
                      ])
                    </div>
                    <div class="p-2">
                      @include('admin.parts.custom_checkbox', [
                        'switch'    => true,
                        'name'      => 'show_ct_num_of_ch',
                        'label'     => 'CH数',
                        'valiable'  => 'series',
                        'empty_value' => true,
                      ])
                    </div>
                    <div class="p-2">
                      @include('admin.parts.custom_checkbox', [
                        'switch'    => true,
                        'name'      => 'show_input',
                        'label'     => '入力',
                        'valiable'  => 'series',
                        'empty_value' => true,
                      ])
                    </div>
                    <div class="p-2">
                      @include('admin.parts.custom_checkbox', [
                        'switch'    => true,
                        'name'      => 'show_output',
                        'label'     => '出力',
                        'valiable'  => 'series',
                        'empty_value' => true,
                      ])
                    </div>
                    <div class="p-2">
                      @include('admin.parts.custom_checkbox', [
                        'switch'    => true,
                        'name'      => 'show_external_onoff',
                        'label'     => '外部ON/OFF',
                        'valiable'  => 'series',
                        'empty_value' => true,
                      ])
                    </div>
                    <div class="p-2">
                      @include('admin.parts.custom_checkbox', [
                        'switch'    => true,
                        'name'      => 'show_external_diming_control',
                        'label'     => '外部調光制御',
                        'valiable'  => 'series',
                        'empty_value' => true,
                      ])
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>型式一覧表に表示する項目 [その他項目]</label>
                  <div class="d-flex flex-row flex-wrap justify-content-start">
                    <div class="p-2">
                      @include('admin.parts.custom_checkbox', [
                        'switch'    => true,
                        'name'      => 'show_throughput',
                        'label'     => '透過率',
                        'valiable'  => 'series',
                        'empty_value' => true,
                      ])
                    </div>
                  </div>
                </div>
                @include('admin.parts.form_textarea', [
                  'name'      => 'memo',
                  'label'     => '備考欄',
                  'valiable'  => 'series',
                ])
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">日本語項目</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                @include('admin.parts.form_text', [
                  'name'      => 'ja:name',
                  'label'     => 'シリーズ名',
                  'value'     => $details['ja']->name ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'ja:model',
                  'label'     => 'シリーズ型式',
                  'value'     => $details['ja']->model ?? '',
                ])
                @include('admin.parts.form_textarea', [
                  'name'      => 'ja:body1',
                  'label'     => '本文１',
                  'value'     => $details['ja']->body1 ?? '',
                ])
                @include('admin.parts.form_textarea', [
                  'name'      => 'ja:body2',
                  'label'     => '本文２',
                  'value'     => $details['ja']->body2 ?? '',
                ])
                @include('admin.parts.form_textarea', [
                  'name'      => 'ja:body3',
                  'label'     => '本文３',
                  'value'     => $details['ja']->body3 ?? '',
                ])
                @include('admin.parts.form_textarea', [
                  'name'      => 'ja:note',
                  'label'     => '注意書き',
                  'value'     => $details['ja']->note ?? '',
                ])
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">英語</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                </div>
              </div>
              <div class="card-body">
                @include('admin.parts.form_text', [
                  'name'      => 'en:name',
                  'label'     => 'シリーズ名',
                  'value'     => $details['en']->name ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'en:model',
                  'label'     => 'シリーズ型式',
                  'disabled'  => true,
                ])
                @include('admin.parts.form_textarea', [
                  'name'      => 'en:body1',
                  'label'     => '本文１',
                  'value'     => $details['en']->body1 ?? '',
                ])
                @include('admin.parts.form_textarea', [
                  'name'      => 'en:body2',
                  'label'     => '本文２',
                  'value'     => $details['en']->body2 ?? '',
                ])
                @include('admin.parts.form_textarea', [
                  'name'      => 'en:body3',
                  'label'     => '本文３',
                  'value'     => $details['en']->body3 ?? '',
                ])
                @include('admin.parts.form_textarea', [
                  'name'      => 'en:note',
                  'label'     => '注意書き',
                  'value'     => $details['en']->note ?? '',
                ])
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">アイコン</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex flex-row flex-wrap justify-content-start">
                  @foreach($icon_options as $icon_id => $icon_label)
                    <div class="pl-4" style="width:25%">
                      @include('admin.parts.custom_checkbox', [
                        'name'        => 'icons[]',
                        'id'          => 'icons-'.$icon_id,
                        'label'       => $icon_label,
                        'form_value'  => $icon_id,
                        'checked'     => old('icons') ? in_array($icon_id, old('icons'))
                                          : (isset($icon_checked) ? in_array($icon_id, $icon_checked) : false),
                      ])
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">特性・特徴</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex flex-row flex-wrap justify-content-start">
                  @foreach($feature_options as $id => $label)
                    <div class="pl-4" style="width: 33%">
                      @include('admin.parts.custom_checkbox', [
                        'name'        => 'features[]',
                        'id'          => 'features-'.$id,
                        'label'       => $label,
                        'form_value'  => $id,
                        'checked'     => isset($feature_checked) ? in_array($id, $feature_checked) : false,
                      ])
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>
  </section>
@endsection


@section('footer_script')
  <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
  <script>
    $(function() {
      bsCustomFileInput.init();
    });
  </script>
@endsection
