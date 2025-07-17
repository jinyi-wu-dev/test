@extends('admin/base')


@section('title', '貸出実績一覧')
@section('header', '貸出実績')


@section('breadcrumb')
  <li class="breadcrumb-item active">貸出実績一覧</li>
@endsection


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
              <form method="get" action="{{ route('admin.lend.index') }}"> 
                @csrf

                <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
                <div class="callout callout-secondary">
                  @include('admin.parts.form_text', [
                    'label' => '期間始まり',
                    'name'  => 'start',
                    'value' => request('start'),
                  ])
                  @include('admin.parts.form_text', [
                    'label' => '期間終わり',
                    'name'  => 'end',
                    'value' => request('end'),
                  ])
                  <button type="submit" class="btn btn-secondary">　検　索　</button>  
                  <button type="submit" class="btn btn-secondary btn-sm float-right" onClick="
                    $('form').attr('action', '{{ route('admin.lend.csv') }}').attr('target', '_blank').attr('method', 'post');
                  ">　CSV出力　</button>  
                </div>
              </form>
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
                          <td>
                            @if($item->series->hasFile('image'))
                            <img src="{{ $item->series->fileUrl('image') }}" width="200px">
                            @endif
                          </td>
                          <td>{{ $item->pivot->num_of_item }}</td>
                          @if($key==0)
                            <td rowspan="{{ count($lend_item->items) }}">{{ $lend_item->remarks }}</td>
                            <td rowspan="{{ count($lend_item->items) }}">{{ $lend_item->requested_at }}</td>
                            <td rowspan="{{ count($lend_item->items) }}">{{ $lend_item->user->prefecture->label() }}</td>
                            <td rowspan="{{ count($lend_item->items) }}">{{ $lend_item->user->company }}</td>
                            <td rowspan="{{ count($lend_item->items) }}">{{ $lend_item->user->name }}</td>
                          @endif
                        </tr>
                      @endforeach
                    @endforeach
                  </tbody>
                </table>
                {{ $lend_items->links('admin.parts.pagination') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection


@section('footer_script')
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ja.min.js"></script>
  <script>
    $(function() {
      $('#start').datepicker({
        format: 'yyyy-mm-dd',
        language: 'ja',
      });
      $('#end').datepicker({
        format: 'yyyy-mm-dd',
        language: 'ja',
      });
    });
  </script>
@endsection
