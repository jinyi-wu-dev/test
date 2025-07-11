@extends('admin/base')


@section('content')
  <section class="content">
    <div class="container-fluid">
        <input type="hidden" name="category" value="{{ $category }}">

        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">個別共通項目</h3>
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
                  'valiable'  => 'item',
                  'disabled'  => true,
                ])
                @include('admin.parts.custom_checkbox', [
                  'switch'      => true,
                  'name'        => 'is_new',
                  'label'       => 'NEW',
                  'valiable'    => 'item',
                  'empty_value' => true,
                ])
                @include('admin.parts.custom_checkbox', [
                  'switch'      => true,
                  'name'        => 'is_publish',
                  'label'       => '公開',
                  'valiable'    => 'item',
                  'empty_value' => true,
                ])
                @include('admin.parts.custom_checkbox', [
                  'switch'      => true,
                  'name'        => 'is_end',
                  'label'       => '生産終了',
                  'valiable'    => 'item',
                  'empty_value' => true,
                ])
                @include('admin.parts.custom_checkbox', [
                  'switch'      => true,
                  'name'        => 'is_lend',
                  'label'       => '貸出可能',
                  'valiable'    => 'item',
                  'empty_value' => true,
                ])
                @include('admin.parts.form_select', [
                  'name'      => 'series_id',
                  'label'     => 'シリーズ型式',
                  'value'     => $item->series_id ?? '',
                  'empty'     => true,
                  'options'   => $series,
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'model',
                  'label'     => '個別型式',
                  'valiable'  => 'item',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'product_number',
                  'label'     => '品番',
                  'valiable'  => 'item',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'operating_temperature',
                  'label'     => '使用温度',
                  'valiable'  => 'item',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'operating_humidity',
                  'label'     => '使用温度',
                  'valiable'  => 'item',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'weight',
                  'label'     => '器具重量',
                  'valiable'  => 'item',
                ])
                <div class="row">
                  <div class="col-2">
                    @include('admin.parts.form_radio', [
                      'name'      => 'cs_rohs',
                      'label'     => '適合規格1',
                      'value'     => isset($item) ?  ($item->is_RoHS ? 'RoHS' : ($item->is_RoHS2 ? 'RoHS2' : '')) : '',
                      'list'      => [
                        'RoHS'    => 'RoHS',
                        'RoHS2'   => 'RoHS2',
                        ''        => 'なし',
                      ],
                    ])
                  </div>
                  <div class="col-3">
                    @include('admin.parts.form_radio', [
                      'name'      => 'cs_crohs',
                      'label'     => '適合規格2',
                      'value'     => isset($item) ? ($item->is_CN_RoHSe1 ? 'e_1' : ($item->is_CN_RoHS102 ? '10_2' : '')) : '',
                      'list'      => [
                        'e_1'     => '中国RoHS e-1',
                        '10_2'    => '中国RoHS 10-2',
                        ''        => 'なし',
                      ],
                    ])
                  </div>
                  <div class="col-3">
                    @include('admin.parts.form_radio', [
                      'name'      => 'cs_ce',
                      'label'     => '適合規格3',
                      'value'     => isset($item) ? ($item->is_CE_IEC ? 'iec' : ($item->is_CE_EN ? 'en' : '')) : '',
                      'list'      => [
                        'iec'     => 'CE(IEC62471)',
                        'en'      => 'CE(EN55011, EN61000-6-2)',
                        ''        => 'なし',
                      ],
                    ])
                  </div>
                  <div class="col-2">
                    @include('admin.parts.form_radio', [
                      'name'      => 'cs_ukca',
                      'label'     => '適合規格4',
                      'value'     => isset($item) ? ($item->is_UKCA ? 'ukca' : '') : '',
                      'list'      => [
                        'ukca'    => 'UKCA',
                        ''        => 'なし',
                      ],
                    ])
                  </div>
                  <div class="col-2">
                    @include('admin.parts.form_radio', [
                      'name'      => 'cs_pse',
                      'label'     => '適合規格5',
                      'value'     => isset($item) ? ($item->is_PSE ? 'pse' : '') : '',
                      'list'      => [
                        'pse'     => 'PSE',
                        ''        => 'なし',
                      ],
                    ])
                  </div>
                </div>
                @include('admin.parts.form_textarea', [
                  'name'      => 'memo',
                  'label'     => '備考欄',
                  'valiable'  => 'item',
                ])
              </div>
            </div>
          </div>
        </div>

        @if ($category==App\Enums\Category::CONTROLLER)
          <div class="row">
            @include('admin/item/detail_c_controller', [
              'title'   => '共通項目',
              'detail'  => $details['ja'] ?? null,
            ])
          </div>
        @endif

        @if ($category==App\Enums\Category::LIGHTING)
          <div class="row">
            @include('admin/item/detail_d_lighting', [
              'title'   => '日本語項目',
              'lang'    => 'ja',
              'detail'  => $details['ja'] ?? null,
            ])
            @include('admin/item/detail_d_lighting', [
              'title'   => '英語項目',
              'lang'    => 'en',
              'detail'  => $details['en'] ?? null,
            ])
          </div>
        @elseif ($category==App\Enums\Category::CONTROLLER)
          <div class="row">
            @include('admin/item/detail_d_controller', [
              'title'   => '日本語項目',
              'lang'    => 'ja',
              'detail'  => $details['ja'] ?? null,
            ])
            @include('admin/item/detail_d_controller', [
              'title'   => '英語項目',
              'lang'    => 'en',
              'detail'  => $details['en'] ?? null,
            ])
          </div>
        @elseif ($category==App\Enums\Category::OPTION)
          <div class="row">
            @include('admin/item/detail_d_option', [
              'title'   => '日本語項目',
              'lang'    => 'ja',
              'detail'  => $details['ja'] ?? null,
            ])
            @include('admin/item/detail_d_option', [
              'title'   => '英語項目',
              'lang'    => 'en',
              'detail'  => $details['en'] ?? null,
            ])
          </div>
        @endif

        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">共通ファイル</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                @include('admin.parts.form_file', [
                  'name'        => '3d_model_step',
                  'label'       => '3Dモデル（STEP）',
                  'file_label'  => isset($item)&&$item->hasFile('3d_model_step') ? '○' : '-',
                ])
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">日本語ファイル</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                @include('admin.parts.form_file', [
                  'name'        => 'ja:external_view_pdf',
                  'label'       => '外観図（PDF）',
                  'file_label'  => isset($details['ja'])&&$details['ja']->hasFile('external_view_pdf') ? '○' : '-',
                ])
                @include('admin.parts.form_file', [
                  'name'        => 'ja:external_view_dxf',
                  'label'       => '外観図（DXF）',
                  'file_label'  => isset($details['ja'])&&$details['ja']->hasFile('external_view_dxf') ? '○' : '-',
                ])
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">英語ファイル</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                @include('admin.parts.form_file', [
                  'name'        => 'en:external_view_pdf',
                  'label'       => '外観図（PDF）',
                  'file_label'  => isset($details['en'])&&$details['en']->hasFile('external_view_pdf') ? '○' : '-',
                ])
                @include('admin.parts.form_file', [
                  'name'        => 'en:external_view_dxf',
                  'label'       => '外観図（DXF）',
                  'file_label'  => isset($details['en'])&&$details['en']->hasFile('external_view_dxf') ? '○' : '-',
                ])
              </div>
            </div>
          </div>
        </div>

        @if ($category==App\Enums\Category::LIGHTING)
          <div class="row">
            @include('admin/item/detail_r_controller', [
              'title'     => '関連製品（コントローラ）',
              'col'       => '12',
              'relateds'  => $item->related_controllers ?? [],
              'options'   => $controllers,
            ])
          </div>
          <div class="row">
            @include('admin/item/detail_r_cable', [
              'title'     => '関連製品（ケーブル）',
              'col'       => '12',
              'relateds'  => $item->related_cables ?? [],
              'options'   => $cables,
            ])
          </div>
          <div class="row">
            @include('admin/item/detail_r_option', [
              'title'     => '関連製品（オプション）',
              'col'       => '12',
              'relateds'  => $item->related_options ?? [],
              'options'   => $options,
            ])
          </div>
        @elseif ($category==App\Enums\Category::CONTROLLER)
          <div class="row">
            @include('admin/item/detail_r_cable', [
              'title'     => '関連製品（ケーブル）',
              'col'       => '12',
              'relateds'  => $item->related_cables ?? [],
              'options'   => $cables,
            ])
          </div>
          <div class="row">
            @include('admin/item/detail_r_option', [
              'title'     => '関連製品（オプション）',
              'col'       => '12',
              'relateds'  => $item->related_options ?? [],
              'options'   => $options,
            ])
          </div>
        @elseif ($category==App\Enums\Category::OPTION)
          <div class="row">
            @include('admin/item/detail_r_option', [
              'title'     => '関連製品（オプション）',
              'col'       => '12',
              'relateds'  => $item->related_options ?? [],
              'options'   => $options,
            ])
          </div>
        @endif

    </div>
  </section>
@endsection


@section('footer_script')
  <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
  <script>
    $(function() {
      bsCustomFileInput.init();
      $('input[name=search_options]').change(function() {
        $keyword = $(this).val();
        $('[name="options\\[\\]"] option').each(function() {
          if ($(this).text().indexOf($keyword)>-1) {
            $(this).css('display', 'form');
          } else {
            $(this).css('display', 'none');
          }
        });
      });
    });
  </script>
@endsection
