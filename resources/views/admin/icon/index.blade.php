@extends('admin/base')


@section('title', 'アイコン一覧')
@section('header', 'アイコン')


@section('breadcrumb')
  <li class="breadcrumb-item active">アイコン一覧</li>
@endsection


@section('form')
  <form method="get" action="{{ route('admin.icon.index') }}"> 
  @csrf
@endsection


@section('footer')
  <footer class="main-footer fixed-bottom">
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
    @csrf
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 col-sm-12 mx-auto">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">一覧</h3>
            </div>
            <div class="card-body">
              {{--
                <div class="callout callout-secondary">
                  @include('admin.parts.block_text', [
                    'label' => '検索',
                    'name'  => 'search_text',
                    'value' => request('name'),
                  ])
                  <button type="submit" class="btn btn-secondary">　検　索　</button>  
                </div>
              --}}
              <div class="row">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>タイトル</th>
                      <th>画像</th>
                      <th>削除</th>
                    </tr>
                    <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th>
                        @include('admin.parts.custom_checkbox', [
                          'name'  => 'is_delete_all',
                          'type'  => 'danger',
                        ])
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($icons as $icon)
                    <tr>
                      <td>
                        <a href="{{ route('admin.icon.edit', $icon->id) }}">{{ $icon->id }}</a>
                      </td>
                      <td>
                        {{ $icon->title }}
                      </td>
                      <td>
                        @if ($icon->hasFile('image'))
                          <img src="{{ $icon->fileUrl('image') }}?{{uniqid()}}">
                        @endif
                      </td>
                      <td class="CDT-delete">
                        @include('admin.parts.custom_checkbox', [
                          'name'        => 'removes[]',
                          'id'          => 'removes-'.$icon->id,
                          'form_value'  => $icon->id,
                          'type'        => 'danger',
                        ])
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $icons->links('admin.parts.pagination') }}
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
  <script src="{{ asset('/admin/js/index.js') }}"></script>
  <script>
    $(function() {
      initCheckDelete('input[name="removes\\[\\]"]', '.do_remove');
      initAllCheck('input[name=is_delete_all]', 'input[name=removes\\[\\]]');
    })
    function doDelete() {
      $('form').attr('method', 'post').attr('action', '{{ route('admin.icon.destroy_multiple') }}').submit();
    }
  </script>
@endsection
