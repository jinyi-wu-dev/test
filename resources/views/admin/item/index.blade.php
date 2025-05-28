@extends('admin/base')


@section('title', 'シリーズ一覧')
@section('header', 'シリーズ')


@section('breadcrumb')
  <li class="breadcrumb-item active">UserList</li>
@endsection


@section('content')
  @include('admin.parts.modal', [
    'id'      => 'conformModal',
    'title'   => '削除',
    'message' => '削除します。よろしいですか？',
    'on_ok'   => 'doDelete();',
  ])
  <section class="content">
  <form method="get" action="{{ route('admin.item.index') }}"> 
    @csrf
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline collapsed-card">
            <div class="card-header">
              <h3 class="card-title">表示項目設定</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-center">
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-series_category',
                    'label'     => '品目タイプ',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-series_genre',
                    'label'     => 'ジャンル',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-series_name',
                    'label'     => 'シリーズ名称',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-series_model',
                    'label'     => 'シリーズ型式',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-model',
                    'label'     => '型式',
                  ])
                </div>
              </div>
              <div class="d-flex justify-content-center">
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-image',
                    'label'     => '画像',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-is_new',
                    'label'     => 'NEW',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-is_end',
                    'label'     => '生産終了',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-is_publish',
                    'label'     => '公開',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-is_lend',
                    'label'     => '貸出',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-product_number',
                    'label'     => '品番',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-operating_temperature',
                    'label'     => '使用温度',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-operating_humidity',
                    'label'     => '使用湿度',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-weight',
                    'label'     => '器具重量',
                  ])
                </div>
              </div>
              <div class="d-flex justify-content-center">
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-is_RoHS',
                    'label'     => 'RoHS',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-is_RoHS2',
                    'label'     => 'RoHS2',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-is_CN_RoHSe1',
                    'label'     => '中国RoHSe1',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-is_CN_RoHS102',
                    'label'     => '中国RoHS10-2',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-is_CE_IEC',
                    'label'     => 'CE(IEC)',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-is_CE_EN',
                    'label'     => 'CE(EN)',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-is_UKCA',
                    'label'     => 'UKCA',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-is_PSE',
                    'label'     => 'PSE',
                  ])
                </div>
              </div>
              <div class="d-flex justify-content-center">
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-description1',
                    'label'     => '欄外記述1',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-description2',
                    'label'     => '欄外記述2',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-description3',
                    'label'     => '欄外記述3',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-description4',
                    'label'     => '欄外記述4',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-description5',
                    'label'     => '欄外記述5',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-exterior_image',
                    'label'     => '外観図(画像)',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-exterior_pdf',
                    'label'     => '外観図(PDF)',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-exterior_dxf',
                    'label'     => '外観図(DXF)',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-model_stl',
                    'label'     => 'モデル(STL)',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-model_step',
                    'label'     => 'モデル(STEP)',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-note',
                    'label'     => '注意書き',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-memo',
                    'label'     => '備考欄',
                  ])
                </div>
                <div class="p-2">
                  @include('admin.parts.block_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-delete',
                    'label'     => '削除',
                  ])
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 mx-auto">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">一覧</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="callout callout-secondary">
                @include('admin.parts.block_text', [
                  'label' => '名前',
                  'name'  => 'keyword',
                  'value' => request('keyword'),
                ])
                <button type="submit" class="btn btn-secondary">　検　索　</button>  
              </div>
              <div class="row">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th class="CDT-series_category">品目タイプ</th>
                      <th class="CDT-series_genre">ジャンル</th>
                      <th class="CDT-series_name">シリーズ名称</th>
                      <th class="CDT-series_model">シリーズ型式</th>
                      <th class="CDT-model">型式</th>
                      <th class="CDT-image">画像</th>
                      <th class="CDT-is_new">NEW</th>
                      <th class="CDT-is_end">生産終了</th>
                      <th class="CDT-is_publish">公開</th>
                      <th class="CDT-is_lend">貸出</th>
                      <th class="CDT-product_number">品番</th>
                      <th class="CDT-operating_temperature">使用温度</th>
                      <th class="CDT-operating_humidity">使用湿度</th>
                      <th class="CDT-weight">器具重量</th>
                      <th class="CDT-is_RoHS">RoHS</th>
                      <th class="CDT-is_RoHS2">RoHS2</th>
                      <th class="CDT-is_CN_RoHSe1">中国RoHSe1</th>
                      <th class="CDT-is_CN_RoHS102">中国RoHS10-2</th>
                      <th class="CDT-is_CE_IEC">CE(IEC)</th>
                      <th class="CDT-is_CE_EN">CE(EN)</th>
                      <th class="CDT-is_UKCA">UKCA</th>
                      <th class="CDT-is_PSE">菱PSE</th>
                      <th class="CDT-description1">欄外記述1</th>
                      <th class="CDT-description2">欄外記述2</th>
                      <th class="CDT-description3">欄外記述3</th>
                      <th class="CDT-description4">欄外記述4</th>
                      <th class="CDT-description5">欄外記述5</th>
                      <th class="CDT-exterior_image">外観図(画像)</th>
                      <th class="CDT-exterior_pdf">外観図(PDF)</th>
                      <th class="CDT-exterior_dxf">外観図(DXF)</th>
                      <th class="CDT-model_stl">モデル(STL)</th>
                      <th class="CDT-model_step">モデル(STEP)</th>
                      <th class="CDT-note">注意書き</th>
                      <th class="CDT-memo">メモ欄</th>
                      <th class="CDT-delete">削除</th>
                    </tr>
                    <tr>
                      <th></th>
                      <th class="CDT-series_category"></th>
                      <th class="CDT-series_genre"></th>
                      <th class="CDT-series_name"></th>
                      <th class="CDT-series_model"></th>
                      <th class="CDT-model"></th>
                      <th class="CDT-image"></th>
                      <th class="CDT-is_new">
                        @include('admin.parts.block_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_new_all',
                        ])
                      </th>
                      <th class="CDT-is_end">
                        @include('admin.parts.block_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_end_all',
                        ])
                      </th>
                      <th class="CDT-is_publish">
                        @include('admin.parts.block_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_publish_all',
                        ])
                      </th>
                      <th class="CDT-is_lend">
                        @include('admin.parts.block_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_lend_all',
                        ])
                      </th>
                      <th class="CDT-product_number"></th>
                      <th class="CDT-operating_temperature"></th>
                      <th class="CDT-operating_humidity"></th>
                      <th class="CDT-weight"></th>
                      <th class="CDT-is_RoHS"></th>
                      <th class="CDT-is_RoHS2"></th>
                      <th class="CDT-is_CN_RoHSe1"></th>
                      <th class="CDT-is_CN_RoHS102"></th>
                      <th class="CDT-is_CE_IEC"></th>
                      <th class="CDT-is_CE_EN"></th>
                      <th class="CDT-is_UKCA"></th>
                      <th class="CDT-is_PSE"></th>
                      <th class="CDT-description1"></th>
                      <th class="CDT-description2"></th>
                      <th class="CDT-description3"></th>
                      <th class="CDT-description4"></th>
                      <th class="CDT-description5"></th>
                      <th class="CDT-exterior_image"></th>
                      <th class="CDT-exterior_pdf"></th>
                      <th class="CDT-exterior_dxf"></th>
                      <th class="CDT-model_stl"></th>
                      <th class="CDT-model_step"></th>
                      <th class="CDT-note"></th>
                      <th class="CDT-memo"></th>
                      <th class="CDT-delete">
                        @include('admin.parts.block_checkbox', [
                          'name'        => 'is_delete_all',
                          'type'        => 'danger',
                        ])
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($items as $i)
                    <tr>
                      <td>
                        <a href="{{ route('admin.item.edit', $i->id) }}">{{ $i->id }}</a>
                        <input type="hidden" name="ids[]" value="{{ $i->id }}">
                      </td>
                      <td class="CDT-series_category">
                        {{ $i->series->category->label() }}
                      </td>
                      <td class="CDT-series_genre">
                        {{ $i->series->genre->label() }}
                      </td>
                      <td class="CDT-series_name">
                        {{ $i->series->default_detail->name ?? '' }}
                      </td>
                      <td class="CDT-series_model">
                        {{ $i->series->default_detail->model ?? '' }}
                      </td>
                      <td class="CDT-model">
                        {{ $i->model }}
                      </td>
                      <td class="CDT-image">
                        @if ($i->series->hasFile('image'))
                        <img src="{{ $i->series->fileUrl('image') }}?v={{ uniqid() }}">
                        @endif
                      </td>
                      <td class="CDT-is_new">
                        @include('admin.parts.block_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_new_ids[]',
                          'id'          => 'is_new-'.$i->id,
                          'value'       => $i->is_new ? $i->id : '',
                          'form_value'  => $i->id,
                        ])
                      </td>
                      <td class="CDT-is_end">
                        @include('admin.parts.block_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_end_ids[]',
                          'id'          => 'is_end-'.$i->id,
                          'value'       => $i->is_end ? $i->id : '',
                          'form_value'  => $i->id,
                        ])
                      </td>
                      <td class="CDT-is_publish">
                        @include('admin.parts.block_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_publish_ids[]',
                          'id'          => 'is_publish-'.$i->id,
                          'value'       => $i->is_publish ? $i->id : '',
                          'form_value'  => $i->id,
                        ])
                      </td>
                      <td class="CDT-is_lend">
                        @include('admin.parts.block_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_lend_ids[]',
                          'id'          => 'is_lend-'.$i->id,
                          'value'       => $i->is_lend ? $i->id : '',
                          'form_value'  => $i->id,
                        ])
                      </td>
                      <td class="CDT-product_number">
                        {{ $i->product_number }}
                      </td>
                      <td class="CDT-operating_temperature">
                        {{ $i->operating_temperature }}
                      </td>
                      <td class="CDT-operating_humidity">
                        {{ $i->operating_humidity }}
                      </td>
                      <td class="CDT-weight">
                        {{ $i->weight }}
                      </td>
                      <td class="CDT-is_RoHS">
                        @if ($i->is_RoHS) {{ config('system.string.valid') }} @else {{ config('system.string.invalid') }} @endif
                      </td>
                      <td class="CDT-is_RoHS2">
                        @if ($i->is_RoHS2) {{ config('system.string.valid') }} @else {{ config('system.string.invalid') }} @endif
                      </td>
                      <td class="CDT-is_CN_RoHSe1">
                        @if ($i->is_CN_RoHSe1) {{ config('system.string.valid') }} @else {{ config('system.string.invalid') }} @endif
                      </td>
                      <td class="CDT-is_CN_RoHS102">
                        @if ($i->is_CN_RoHS102) {{ config('system.string.valid') }} @else {{ config('system.string.invalid') }} @endif
                      </td>
                      <td class="CDT-is_CE_IEC">
                        @if ($i->is_CE_IEC) {{ config('system.string.valid') }} @else {{ config('system.string.invalid') }} @endif
                      </td>
                      <td class="CDT-is_CE_EN">
                        @if ($i->is_CE_EN) {{ config('system.string.valid') }} @else {{ config('system.string.invalid') }} @endif
                      </td>
                      <td class="CDT-is_UKCA">
                        @if ($i->is_UKCA) {{ config('system.string.valid') }} @else {{ config('system.string.invalid') }} @endif
                      </td>
                      <td class="CDT-is_PSE">
                        @if ($i->is_PSE) {{ config('system.string.valid') }} @else {{ config('system.string.invalid') }} @endif
                      </td>
                      <td class="CDT-description1">
                        {{ $i->description1 }}
                      </td>
                      <td class="CDT-description2">
                        {{ $i->description2 }}
                      </td>
                      <td class="CDT-description3">
                        {{ $i->description3 }}
                      </td>
                      <td class="CDT-description4">
                        {{ $i->description4 }}
                      </td>
                      <td class="CDT-description5">
                        {{ $i->description5 }}
                      </td>
                      <td class="CDT-exterior_image">
                        @if ($i->hasFile('exterior_image')) {{ config('system.string.exixts') }} @else {{ config('system.string.not_exist') }} @endif
                      </td>
                      <td class="CDT-exterior_pdf">
                        @if ($i->hasFile('exterior_pdf')) {{ config('system.string.exixts') }} @else {{ config('system.string.not_exist') }} @endif
                      </td>
                      <td class="CDT-exterior_dxf">
                        @if ($i->hasFile('exterior_dxf')) {{ config('system.string.exixts') }} @else {{ config('system.string.not_exist') }} @endif
                      </td>
                      <td class="CDT-model_stl">
                        @if ($i->hasFile('model_stl')) {{ config('system.string.exixts') }} @else {{ config('system.string.not_exist') }} @endif
                      </td>
                      <td class="CDT-model_step">
                        @if ($i->hasFile('model_step')) {{ config('system.string.exixts') }} @else {{ config('system.string.not_exist') }} @endif
                      </td>
                      <td class="CDT-note">
                        {{ $i->note }}
                      </td>
                      <td class="CDT-memo">
                        {{ $i->memo }}
                      </td>
                      <td class="CDT-delete">
                        @include('admin.parts.block_checkbox', [
                          'name'        => 'removes[]',
                          'id'          => 'removes-'.$i->id,
                          'form_value'  => $i->id,
                          'type'        => 'danger',
                        ])
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $items->links('admin.parts.pagination') }}
              </div>
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-primary" onClick="doUpdate()">　変　更　</button>  
              <button type="button" class="btn btn-danger btn-sm float-right do_remove" data-toggle="modal" data-target="#conformModal" disabled>　削　除　</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  </section>
@endsection


@section('footer_script')
  <script src="{{ asset('/script/index.js') }}"></script>
  <script>
    $(function() {
      initCheckDisplayControll('CDC-', 'CDT-');
      initCheckDelete('input[name="removes\\[\\]"]', '.do_remove');
      initAllCheck('input[name=is_new_all]', 'input[name=is_new_ids\\[\\]]');
      initAllCheck('input[name=is_end_all]', 'input[name=is_end_ids\\[\\]]');
      initAllCheck('input[name=is_publish_all]', 'input[name=is_publish_ids\\[\\]]');
      initAllCheck('input[name=is_lend_all]', 'input[name=is_lend_ids\\[\\]]');
      initAllCheck('input[name=is_delete_all]', 'input[name=removes\\[\\]]');
    })
    function doUpdate() {
      $('form').attr('method', 'post').attr('action', '{{ route('admin.item.multi_update') }}').submit();
    }
    function doDelete() {
      $('form').attr('method', 'post').attr('action', '{{ route('admin.item.multi_destroy') }}').submit();
    }
  </script>
@endsection

