@extends('admin/base')


@section('content')
  @include('admin.parts.modal', [
    'id'      => 'conformDeleteItemsModal',
    'title'   => '削除',
    'message' => '削除します。よろしいですか？',
    'on_ok'   => 'doDeleteItems();',
  ])
  @include('admin.parts.modal', [
    'id'      => 'conformDeleteGroupModal',
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
                  'name'        => 'id',
                  'label'       => 'ID',
                  'value'       => $group->id ?? '',
                  'disabled'    => true,
                ])
                @include('admin.parts.custom_checkbox', [
                  'switch'      => true,
                  'name'        => 'item:is_new',
                  'label'       => 'NEW',
                  'checked'     => $first_item->is_new ?? '',
                  'empty_value' => true,
                ])
                @include('admin.parts.custom_checkbox', [
                  'switch'      => true,
                  'name'        => 'item:is_publish',
                  'label'       => '公開',
                  'checked'     => $first_item->is_publish ?? '',
                  'empty_value' => true,
                ])
                @include('admin.parts.custom_checkbox', [
                  'switch'      => true,
                  'name'        => 'item:is_end',
                  'label'       => '生産終了',
                  'checked'     => $first_item->is_end ?? '',
                  'empty_value' => true,
                ])
                @include('admin.parts.form_select', [
                  'name'      => 'item:series_id',
                  'label'     => 'シリーズ型式',
                  'value'     => $first_item->series_id ?? '',
                  'empty'     => true,
                  'options'   => $series,
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'group:lighting_connector',
                  'label'     => '照明側コネクタ',
                  'value'     => $group->lighting_connector ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'group:power_connector',
                  'label'     => '電源側コネクタ',
                  'value'     => $group->power_connector ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'item:operating_temperature',
                  'label'     => '使用温度',
                  'value'     => $first_item->operating_temperature ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'item:operating_humidity',
                  'label'     => '使用湿度',
                  'value'     => $first_item->operating_humidity ?? '',
                ])
                <div class="row">
                  <div class="col-2">
                    @include('admin.parts.form_radio', [
                      'name'      => 'item:cs_rohs',
                      'label'     => '適合規格1',
                      'value'     => isset($first_item) ?  ($first_item->is_RoHS ? 'RoHS' : ($first_item->is_RoHS2 ? 'RoHS2' : '')) : '',
                      'list'      => [
                        'RoHS'    => 'RoHS',
                        'RoHS2'   => 'RoHS2',
                        ''        => 'なし',
                      ],
                    ])
                  </div>
                  <div class="col-3">
                    @include('admin.parts.form_radio', [
                      'name'      => 'item:cs_crohs',
                      'label'     => '適合規格2',
                      'value'     => isset($first_item) ? ($first_item->is_CN_RoHSe1 ? 'e_1' : ($first_item->is_CN_RoHS102 ? '10_2' : '')) : '',
                      'list'      => [
                        'e_1'     => '中国RoHS e-1',
                        '10_2'    => '中国RoHS 10-2',
                        ''        => 'なし',
                      ],
                    ])
                  </div>
                </div>
                @include('admin.parts.form_textarea', [
                  'name'      => 'item:memo',
                  'label'     => '備考欄',
                  'value'     => $first_item->memo ?? '',
                ])
                {{--
                @include('admin.parts.form_file', [
                  'name'        => 'catalogue',
                  'label'       => 'カタログ',
                  'file_label'  => isset($item)&&$item->hasFile('catalogue') ? '○' : '-',
                ])
                @include('admin.parts.form_file', [
                  'name'        => 'pamphlet',
                  'label'       => 'パンフレット',
                  'file_label'  => isset($item)&&$item->hasFile('pamphlet') ? '○' : '-',
                ])
                @include('admin.parts.form_file', [
                  'name'        => 'manual',
                  'label'       => '取扱説明書',
                  'file_label'  => isset($item)&&$item->hasFile('manual') ? '○' : '-',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'model',
                  'label'     => '品番',
                  'valiable'  => 'item',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'weight',
                  'label'     => '器具重量',
                  'valiable'  => 'item',
                ])
                --}}
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
                  'name'      => 'detail:ja:description1',
                  'label'     => '欄外記述1',
                  'value'     => $details['ja']->description1 ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'detail:ja:description2',
                  'label'     => '欄外記述2',
                  'value'     => $details['ja']->description2 ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'detail:ja:description3',
                  'label'     => '欄外記述3',
                  'value'     => $details['ja']->description3 ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'detail:ja:description4',
                  'label'     => '欄外記述4',
                  'value'     => $details['ja']->description4 ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'detail:ja:description5',
                  'label'     => '欄外記述5',
                  'value'     => $details['ja']->description5 ?? '',
                ])
                @include('admin.parts.form_textarea', [
                  'name'      => 'detail:ja:note',
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
                  'name'      => 'detail:en:description1',
                  'label'     => '欄外記述1',
                  'value'     => $details['en']->description1 ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'detail:en:description2',
                  'label'     => '欄外記述2',
                  'value'     => $details['en']->description2 ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'detail:en:description3',
                  'label'     => '欄外記述3',
                  'value'     => $details['en']->description3 ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'detail:en:description4',
                  'label'     => '欄外記述4',
                  'value'     => $details['en']->description4 ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'detail:en:description5',
                  'label'     => '欄外記述5',
                  'value'     => $details['en']->description5 ?? '',
                ])
                @include('admin.parts.form_textarea', [
                  'name'      => 'detail:en:note',
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
                <h3 class="card-title">ケーブル</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <div class="row">
                @if (!isset($group))
                  ここでは編集できません。新規登録後にお願いします。
                @else
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>貸出可能</th>
                      <th>型式</th>
                      <th>品番</th>
                      <th>接続条件</th>
                      <th>ケーブル長さ</th>
                      <th>削除</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($group->items() as $item)
                    @php
                      $cables = $item->cable_items->keyBy('language');
                    @endphp
                      @foreach (config('system.language.list') as $lang)
                        <tr>
                          @if ($lang=='ja')
                            <td rowspan="2">
                              {{ $item->id }}
                              <input type="hidden" name="cable:cable_ids[]" value="{{ $item->id }}">
                            </td>
                            <td>
                              @include('admin.parts.custom_checkbox', [
                                'switch'    => true,
                                'name'      => 'cable:common2:is_lend[]',
                                'id'        => 'is_lend_' . $item->id,
                                'form_value'     => $item->id,
                                'checked'   => $item->is_lend,
                              ])
                            </td>
                            <td rowspan="2">
                              @include('admin.parts.form_text', [
                                'name'      => 'cable:common:model[]',
                                'value'     => $item->model,
                              ])
                            </td>
                            <td rowspan="2">
                              @include('admin.parts.form_text', [
                                'name'      => 'cable:common:product_number[]',
                                'value'     => $item->product_number,
                              ])
                            </td>
                            <td rowspan="2">
                              @include('admin.parts.form_text', [
                                'name'      => 'cable:ja:conditions[]',
                                'value'     => $cables['ja']->conditions ?? '',
                              ])
                            </td>
                            <td>
                              @include('admin.parts.form_text', [
                                'name'      => 'cable:ja:length[]',
                                'value'     => $cables['ja']->length ?? '',
                              ])
                            </td>
                            <td rowspan="2">
                              @include('admin.parts.custom_checkbox', [
                                'name'        => 'removes[]',
                                'id'          => 'removes-'.$item->id,
                                'form_value'  => $item->id,
                                'type'        => 'danger',
                              ])
                            </td>
                          @else
                            <td>
                              {{ $lang }}
                            </td>
                            <td>
                              @include('admin.parts.form_text', [
                                'name'      => 'cable:'.$lang.':length[]',
                                'value'     => $cables[$lang]->length ?? '',
                              ])
                            </td>
                          @endif
                        </tr>
                      @endforeach
                    @endforeach
                    <tr>
                      <td colspan="7">
                        <button class="btn btn-sm btn-info" onClick="doAddItem()">　追　加　</button>
                        <button type="button" class="btn btn-danger btn-sm float-right do_remove" data-toggle="modal" data-target="#conformDeleteItemsModal" disabled>　削　除　</button>
                      </td>
                      </tr>
                  </tbody>
                </table>
                @endif
              </div>
              </div>
            </div>
          </div>
        </div>

    </div>
  </section>
@endsection


@section('footer_script')
  <script src="{{ asset('/admin/js/index.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
  <script>
    bsCustomFileInput.init();
    initCheckDelete('input[name="removes\\[\\]"]', '.do_remove');
    function doDelete() {
      $('input[name=_method]').val('delete');
      $('form').submit();
    }
    @if (isset($group))
    function doAddItem() {
      $('input[name=_method]').val('post');
      $('form').attr('method', 'post').attr('action', '{{ route('admin.cable.add_item', $group->id) }}').submit();
    }
    function doDeleteItems() {
      $('input[name=_method]').val('post');
      $('form').attr('method', 'post').attr('action', '{{ route('admin.cable.destroy_items', $group->id) }}').submit();
    }
    @endif
  </script>
@endsection
