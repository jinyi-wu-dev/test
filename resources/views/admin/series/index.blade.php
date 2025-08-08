@extends('admin/base')


@section('title', 'シリーズ一覧')
@section('header', 'シリーズ')


@section('breadcrumb')
  <li class="breadcrumb-item active">シリーズ一覧</li>
@endsection


@section('form')
  <form method="get" action="{{ route('admin.series.index') }}"> 
  @csrf
@endsection


@section('footer')
  <footer class="main-footer fixed-bottom">
    <button type="button" class="btn btn-primary" onClick="doUpdate()">　変　更　</button>  
    <button type="button" class="btn btn-danger btn-sm float-right do_remove" data-toggle="modal" data-target="#conformModal" disabled>　削　除　</button>
  </footer>
  </form>
@endsection


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
              <div class="d-flex flex-row flex-wrap justify-content-center">
                <div class="pr-4">
                  @include('admin.parts.custom_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-category',
                    'label'     => '品目タイプ',
                  ])
                </div>
                <div class="pr-4">
                  @include('admin.parts.custom_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-genre',
                    'label'     => 'ジャンル',
                  ])
                </div>
                <div class="pr-4">
                  @include('admin.parts.custom_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-name',
                    'label'     => '名称',
                  ])
                </div>
                <div class="pr-4">
                  @include('admin.parts.custom_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-model',
                    'label'     => '型式',
                  ])
                </div>
                <div class="pr-4">
                  @include('admin.parts.custom_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-num_of_model',
                    'label'     => '型式数',
                  ])
                </div>
                <div class="pr-4">
                  @include('admin.parts.custom_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-image',
                    'label'     => '画像',
                  ])
                </div>
                <div class="pr-4">
                  @include('admin.parts.custom_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-is_new',
                    'label'     => 'NEW',
                  ])
                </div>
                <div class="pr-4">
                  @include('admin.parts.custom_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-is_end',
                    'label'     => '生産終了',
                  ])
                </div>
                <div class="pr-4">
                  @include('admin.parts.custom_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-is_publish',
                    'label'     => '公開',
                  ])
                </div>
                <div class="pr-4">
                  @include('admin.parts.custom_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-pamphlet',
                    'label'     => 'パンフレット',
                  ])
                </div>
                <div class="pr-4">
                  @include('admin.parts.custom_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-catalogue',
                    'label'     => 'カタログ',
                  ])
                </div>
                <div class="pr-4">
                  @include('admin.parts.custom_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-manual',
                    'label'     => '取説',
                  ])
                </div>
                <div class="pr-4">
                  @include('admin.parts.custom_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-note',
                    'label'     => '注意書き',
                  ])
                </div>
                <div class="pr-4">
                  @include('admin.parts.custom_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-memo',
                    'label'     => '備考欄',
                  ])
                </div>
                <div class="pr-4">
                  @include('admin.parts.custom_checkbox', [
                    'checked'   => true,
                    'name'      => 'CDC-delete',
                    'label'     => '削除',
                  ])
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card card-primary card-outline collapsed-card">
            <div class="card-header">
              <h3 class="card-title">CSVアップロード</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="callout callout-secondary">
                @include('admin.parts.form_file', [
                  'name'        => 'catalogue',
                  'label'       => 'CSV',
                ])
                <button type="submit" class="btn btn-info">　検　索　</button>  
                <button type="submit" class="btn btn-secondary btn-sm float-right" onClick="
                  $('form').attr('action', '{{ route('admin.series.export_csv') }}').attr('target', '_blank').attr('method', 'post');
                ">　CSV出力　</button>  
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
                @include('admin.parts.form_text', [
                  'label' => '名前',
                  'name'  => 'keyword',
                  'value' => request('keyword'),
                ])
                <button type="submit" class="btn btn-info">　検　索　</button>  
                <button type="submit" class="btn btn-secondary btn-sm float-right" onClick="
                  $('form').attr('action', '{{ route('admin.series.export_csv') }}').attr('target', '_blank').attr('method', 'post');
                ">　CSV出力　</button>  
              </div>
              <div class="row">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th class="CDT-category">品目タイプ</th>
                      <th class="CDT-genre">ジャンル</th>
                      <th class="CDT-name">名称</th>
                      <th class="CDT-model">型式</th>
                      <th class="CDT-num_of_model">型式数</th>
                      <th class="CDT-image">
                        画像
                      </th>
                      <th class="CDT-is_new">NEW</th>
                      <th class="CDT-is_end">生産終了</th>
                      <th class="CDT-is_publish">公開</th>
                      <th class="CDT-pamphlet">パンフレット</th>
                      <th class="CDT-catalogue">カタログ</th>
                      <th class="CDT-manual">取説</th>
                      <th class="CDT-note">注意書き</th>
                      <th class="CDT-memo">備考欄</th>
                      <th class="CDT-delete">削除</th>
                    </tr>
                    <tr>
                      <th></th>
                      <th class="CDT-category"></th>
                      <th class="CDT-genre"></th>
                      <th class="CDT-name"></th>
                      <th class="CDT-model"></th>
                      <th class="CDT-num_of_model"></th>
                      <th class="CDT-image">
                        <input type="range" class="custom-range" value="20">
                      </th>
                      <th class="CDT-is_new">
                        @include('admin.parts.custom_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_new_all',
                        ])
                      </th>
                      <th class="CDT-is_end">
                        @include('admin.parts.custom_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_end_all',
                        ])
                      </th>
                      <th class="CDT-is_publish">
                        @include('admin.parts.custom_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_publish_all',
                        ])
                      </th>
                      <th class="CDT-pamphlet"></th>
                      <th class="CDT-catalogue"></th>
                      <th class="CDT-manual"></th>
                      <th class="CDT-note"></th>
                      <th class="CDT-memo"></th>
                      <th class="CDT-delete">
                        @include('admin.parts.custom_checkbox', [
                          'name'        => 'is_delete_all',
                          'type'        => 'danger',
                        ])
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($series as $s)
                    <tr>
                      <td>
                        <a href="{{ route('admin.series.edit', $s->id) }}">{{ $s->id }}</a>
                        <input type="hidden" name="ids[]" value="{{ $s->id }}">
                      </td>
                      <td class="CDT-category">
                        {{ $s->category->label() }}
                      </td>
                      <td class="CDT-genre">
                        {{ $s->genre ? $s->genre->label() : '' }}
                      </td>
                      <td class="CDT-name">
                        {{ $s->japanese_detail->name ?? '' }}
                      </td>
                      <td class="CDT-model">
                        {{ $s->japanese_detail->model ?? '' }}
                      </td>
                      <td class="CDT-num_of_model">
                      </td>
                      <td class="CDT-image">
                        @if ($s->hasFile('image'))
                        <img src="{{ $s->fileUrl('image') }}?v={{ uniqid() }}" width="200px" class="list-image">
                        @endif
                      </td>
                      <td class="CDT-is_new">
                        @include('admin.parts.custom_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_new_ids[]',
                          'id'          => 'is_new-'.$s->id,
                          'value'       => $s->is_new ? $s->id : '',
                          'form_value'  => $s->id,
                        ])
                      </td>
                      <td class="CDT-is_end">
                        @include('admin.parts.custom_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_end_ids[]',
                          'id'          => 'is_end-'.$s->id,
                          'value'       => $s->is_end ? $s->id : '',
                          'form_value'  => $s->id,
                        ])
                      </td>
                      <td class="CDT-is_publish">
                        @include('admin.parts.custom_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_publish_ids[]',
                          'id'          => 'is_publish-'.$s->id,
                          'value'       => $s->is_publish ? $s->id : '',
                          'form_value'  => $s->id,
                        ])
                      </td>
                      <td class="CDT-pamphlet">
                        @if ($s->hasFile('pamphlet'))
                          ○
                        @else
                          ―
                        @endif
                      </td>
                      <td class="CDT-catalogue">
                        @if ($s->hasFile('catelogue'))
                          ○
                        @else
                          ―
                        @endif
                      </td>
                      <td class="CDT-manual">
                        @if ($s->hasFile('manual'))
                          ○
                        @else
                          ―
                        @endif
                      </td>
                      <td class="CDT-note">
                        {{ $s->japanese_detail->note ?? '' }}
                      </td>
                      <td class="CDT-memo">
                        {{ $s->memo }}
                      </td>
                      <td class="CDT-delete">
                        @include('admin.parts.custom_checkbox', [
                          'name'        => 'removes[]',
                          'id'          => 'removes-'.$s->id,
                          'form_value'  => $s->id,
                          'type'        => 'danger',
                        ])
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $series->links('admin.parts.pagination') }}
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
  <script>
    $(function() {
      initCheckDisplayControll('admin.series_hides', 'CDC-', 'CDT-');
      initCheckDelete('input[name="removes\\[\\]"]', '.do_remove');
      initAllCheck('input[name=is_new_all]', 'input[name=is_new_ids\\[\\]]');
      initAllCheck('input[name=is_end_all]', 'input[name=is_end_ids\\[\\]]');
      initAllCheck('input[name=is_publish_all]', 'input[name=is_publish_ids\\[\\]]');
      initAllCheck('input[name=is_delete_all]', 'input[name=removes\\[\\]]');
      initImageRange('.custom-range', '.list-image');
    });
    function doUpdate() {
      $('form').attr('method', 'post').attr('action', '{{ route('admin.series.update_multiple') }}').submit();
    }
    function doDelete() {
      $('form').attr('method', 'post').attr('action', '{{ route('admin.series.destroy_multiple') }}').submit();
    }
  </script>
@endsection

