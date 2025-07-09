@extends('admin/base')

@section('content')
  <script>
    function onOK() {
      $('input[name="_method"]').val('delete');
      $('form').submit();
    }
  </script>
  @include('admin.parts.modal', [
    'id'      => 'conformModal',
    'title'   => '削除',
    'message' => '削除します。よろしいですか？',
    'on_ok'   => 'onOK();',
  ])
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 mx-auto">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">貸出実績</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>品目タイプ</th>
                      <th>ジャンル</th>
                      <th>品名</th>
                      <th>シリーズ型式</th>
                      <th>型式</th>
                      <th>画像</th>
                      <th>台数</th>
                      <th>備考欄</th>
                      <th>ご依頼日</th>
                      <th>都道府県</th>
                      <th>会社名</th>
                      <th>名前</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($lend_items as $lend_item)
                      @foreach ($lend_item->items as $key => $item)
                        <tr>
                          @if($key==0)
                            <td rowspan="{{ count($lend_item->items) }}">{{ $lend_item->id }}</td>
                          @endif
                          <td>{{ $item->series->category->label() }}</td>
                          <td>{{ $item->series->genre->label() }}</td>
                          <td>{{ $item->series->japanese_detail->name ?? '' }}</td>
                          <td>{{ $item->series->model }}</td>
                          <td>{{ $item->model }}</td>
                          <td><img src="{{ $item->series->fileUrl('image') }}" width="200px"></td>
                          <td>{{ $item->pivot->num_of_item }}</td>
                          @if($key==0)
                            <td rowspan="{{ count($lend_item->items) }}">{{ $lend_item->remarks }}</td>
                            <td rowspan="{{ count($lend_item->items) }}">{{ $lend_item->requested_at }}</td>
                            <td rowspan="{{ count($lend_item->items) }}">{{ $lend_item->user->prefecture }}</td>
                            <td rowspan="{{ count($lend_item->items) }}">{{ $lend_item->user->company }}</td>
                            <td rowspan="{{ count($lend_item->items) }}">{{ $lend_item->user->name1 }}</td>
                          @endif
                        </tr>
                      @endforeach
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
