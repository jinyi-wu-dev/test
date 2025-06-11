@extends('admin/base')


@section('content')
  <section class="content">
    <div class="container-fluid">
      @yield('form')
        @csrf

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
                @include('admin.parts.block_text', [
                  'name'      => 'id',
                  'label'     => 'ID',
                  'valiable'  => 'item',
                  'disabled'  => true,
                ])
                @include('admin.parts.block_checkbox', [
                  'switch'      => true,
                  'name'        => 'is_new',
                  'label'       => 'NEW',
                  'valiable'    => 'item',
                  'empty_value' => true,
                ])
                @include('admin.parts.block_checkbox', [
                  'switch'      => true,
                  'name'        => 'is_publish',
                  'label'       => '公開',
                  'valiable'    => 'item',
                  'empty_value' => true,
                ])
                @include('admin.parts.block_checkbox', [
                  'switch'      => true,
                  'name'        => 'is_end',
                  'label'       => '生産終了',
                  'valiable'    => 'item',
                  'empty_value' => true,
                ])
                @include('admin.parts.block_checkbox', [
                  'switch'      => true,
                  'name'        => 'is_lend',
                  'label'       => '貸出可能',
                  'valiable'    => 'item',
                  'empty_value' => true,
                ])
                @include('admin.parts.block_select', [
                  'name'      => 'series_id',
                  'label'     => 'シリーズ型式',
                  'value'     => $item->series_id,
                  'empty'     => true,
                  'options'   => $series,
                ])
                @include('admin.parts.block_file', [
                  'name'        => 'catalogue',
                  'label'       => 'カタログ',
                  'file_label'  => isset($item)&&$item->hasFile('catalogue') ? '○' : '-',
                ])
                @include('admin.parts.block_file', [
                  'name'        => 'pamphlet',
                  'label'       => 'パンフレット',
                  'file_label'  => isset($item)&&$item->hasFile('pamphlet') ? '○' : '-',
                ])
                @include('admin.parts.block_file', [
                  'name'        => 'manual',
                  'label'       => '取扱説明書',
                  'file_label'  => isset($item)&&$item->hasFile('manual') ? '○' : '-',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'model',
                  'label'     => '品番',
                  'valiable'  => 'item',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'operating_temperature',
                  'label'     => '使用温度',
                  'valiable'  => 'item',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'operating_humidity',
                  'label'     => '使用温度',
                  'valiable'  => 'item',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'weight',
                  'label'     => '器具重量',
                  'valiable'  => 'item',
                ])
                <div class="row">
                  <div class="col-2">
                    @include('admin.parts.block_radio', [
                      'name'      => 'cs_rohs',
                      'label'     => '適合規格1',
                      'value'     => $item->is_RoHS ? 'RoHS' :
                                        ($item->is_RoHS2 ? 'RoHS2' : ''),
                      'list'      => [
                        'RoHS'    => 'RoHS',
                        'RoHS2'   => 'RoHS2',
                        ''        => 'なし',
                      ],
                    ])
                  </div>
                  <div class="col-3">
                    @include('admin.parts.block_radio', [
                      'name'      => 'cs_crohs',
                      'label'     => '適合規格2',
                      'value'     => $item->is_CN_RoHSe1 ? 'e_1' :
                                        ($item->is_CN_RoHS102 ? '10_2' : ''),
                      'list'      => [
                        'e_1'     => '中国RoHS e-1',
                        '10_2'    => '中国RoHS 10-2',
                        ''        => 'なし',
                      ],
                    ])
                  </div>
                  <div class="col-3">
                    @include('admin.parts.block_radio', [
                      'name'      => 'cs_ce',
                      'label'     => '適合規格3',
                      'value'     => $item->is_CE_IEC ? 'iec' :
                                        ($item->is_CE_EN ? 'en' : ''),
                      'list'      => [
                        'iec'     => 'CE(IEC62471)',
                        'en'      => 'CE(EN55011, EN61000-6-2)',
                        ''        => 'なし',
                      ],
                    ])
                  </div>
                  <div class="col-2">
                    @include('admin.parts.block_radio', [
                      'name'      => 'cs_ukca',
                      'label'     => '適合規格4',
                      'value'     => $item->is_UKCA ? 'ukca' : '',
                      'list'      => [
                        'ukca'    => 'UKCA',
                        ''        => 'なし',
                      ],
                    ])
                  </div>
                  <div class="col-2">
                    @include('admin.parts.block_radio', [
                      'name'      => 'cs_pse',
                      'label'     => '適合規格5',
                      'value'     => $item->is_PSE ? 'pse' : '',
                      'list'      => [
                        'pse'     => 'PSE',
                        ''        => 'なし',
                      ],
                    ])
                  </div>
                </div>
                @include('admin.parts.block_textarea', [
                  'name'      => 'memo',
                  'label'     => '備考欄',
                  'valiable'  => 'item',
                ])
              </div>
              <div class="card-footer">
                @yield('form_button')
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
                @include('admin.parts.block_text', [
                  'name'      => 'jp:type',
                  'label'     => 'タイプ',
                  'value'     => $details['jp']->type ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'jp:color1',
                  'label'     => '発光色',
                  'value'     => $details['jp']->color1 ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'jp:color2',
                  'label'     => '発光色記号',
                  'value'     => $details['jp']->color2 ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'jp:color3',
                  'label'     => '色温度/ピーク波長',
                  'value'     => $details['jp']->color3 ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'jp:power_consumption',
                  'label'     => '消費電力',
                  'value'     => $details['jp']->power_consumption ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'jp:num_of_ch',
                  'label'     => 'CH数',
                  'value'     => $details['jp']->num_of_ch ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'jp:input',
                  'label'     => '入力',
                  'value'     => $details['jp']->input ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'jp:etc',
                  'label'     => 'その他',
                  'value'     => $details['jp']->etc ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'jp:description1',
                  'label'     => '欄外記述1',
                  'value'     => $details['jp']->description1 ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'jp:description2',
                  'label'     => '欄外記述2',
                  'value'     => $details['jp']->description2 ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'jp:description3',
                  'label'     => '欄外記述3',
                  'value'     => $details['jp']->description3 ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'jp:description4',
                  'label'     => '欄外記述4',
                  'value'     => $details['jp']->description4 ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'jp:description5',
                  'label'     => '欄外記述5',
                  'value'     => $details['jp']->description5 ?? '',
                ])
              </div>
              <div class="card-footer">
                @yield('form_button')
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
                @include('admin.parts.block_text', [
                  'name'      => 'en:type',
                  'label'     => 'タイプ',
                  'value'     => $details['en']->type ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'en:color1',
                  'label'     => '発光色',
                  'value'     => $details['en']->color1 ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'en:color2',
                  'label'     => '発光色記号',
                  'value'     => $details['en']->color2 ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'en:color3',
                  'label'     => '色温度/ピーク波長',
                  'value'     => $details['en']->color3 ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'en:power_consumption',
                  'label'     => '消費電力',
                  'value'     => $details['en']->power_consumption ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'en:num_of_ch',
                  'label'     => 'CH数',
                  'value'     => $details['en']->num_of_ch ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'en:input',
                  'label'     => '入力',
                  'value'     => $details['en']->input ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'en:etc',
                  'label'     => 'その他',
                  'value'     => $details['en']->etc ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'en:description1',
                  'label'     => '欄外記述1',
                  'value'     => $details['en']->description1 ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'en:description2',
                  'label'     => '欄外記述2',
                  'value'     => $details['en']->description2 ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'en:description3',
                  'label'     => '欄外記述3',
                  'value'     => $details['en']->description3 ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'en:description4',
                  'label'     => '欄外記述4',
                  'value'     => $details['en']->description4 ?? '',
                ])
                @include('admin.parts.block_text', [
                  'name'      => 'en:description5',
                  'label'     => '欄外記述5',
                  'value'     => $details['en']->description5 ?? '',
                ])
              </div>
              <div class="card-footer">
                @yield('form_button')
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">関連製品（コントローラ）</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                @foreach ($item->related_controllers as $series)
                  @include('admin.parts.block_select', [
                    'name'      => 'controllers[]',
                    'value'     => $series->id,
                    'empty'     => true,
                    'options'   => $controllers,
                  ])
                @endforeach
                @for ($series=count($item->related_controllers); $series<20; $series++)
                  @include('admin.parts.block_select', [
                    'name'      => 'controllers[]',
                    'value'     => '',
                    'empty'     => true,
                    'options'   => $controllers,
                  ])
                @endfor
              </div>
              <div class="card-footer">
                @yield('form_button')
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">:
                <h3 class="card-title">関連製品（ケーブル）</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                @foreach ($item->related_cables as $series)
                  @include('admin.parts.block_select', [
                    'name'      => 'cables[]',
                    'value'     => $series->id,
                    'empty'     => true,
                    'options'   => $cables,
                  ])
                @endforeach
                @for ($series=count($item->related_cables); $series<20; $series++)
                  @include('admin.parts.block_select', [
                    'name'      => 'cables[]',
                    'value'     => '',
                    'empty'     => true,
                    'options'   => $cables,
                  ])
                @endfor
              </div>
              <div class="card-footer">
                @yield('form_button')
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">関連製品（オプション）</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                @include('admin.parts.block_text', [
                  'name'      => 'search_options',
                  'label'     => '',
                  'value'     => '',
                ])
                @foreach ($item->related_options as $series)
                  @include('admin.parts.block_select', [
                    'name'      => 'options[]',
                    'value'     => $series->id,
                    'empty'     => true,
                    'options'   => $options,
                  ])
                @endforeach
                @for ($series=count($item->related_options); $series<20; $series++)
                  @include('admin.parts.block_select', [
                    'name'      => 'options[]',
                    'value'     => '',
                    'empty'     => true,
                    'options'   => $options,
                  ])
                @endfor
              </div>
              <div class="card-footer">
                @yield('form_button')
              </div>
            </div>
          </div>
        </div>

      </form>
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
            $(this).css('display', 'block');
          } else {
            $(this).css('display', 'none');
          }
        });
      });
    });
  </script>
@endsection
