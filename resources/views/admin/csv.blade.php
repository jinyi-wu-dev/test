@extends('admin/base')


@section('title', 'CSVアップロード')
@section('header', 'CSVアップロード')


@section('breadcrumb')
  <li class="breadcrumb-item active">CSV</li>
@endsection


@section('form')
  <form method="post" action="{{ route('admin.csv') }}" enctype="multipart/form-data" target="_blank">
  @csrf
@endsection


@section('footer')
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
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">CSV</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="callout callout-secondary">
                @include('admin.parts.form_select', [
                  'name'      => 'type',
                  'label'     => '対象',
                  'empty'     => true,
                  'options'   => [
                    'series' => 'シリーズ',
                  ],
                ])
                @include('admin.parts.form_file', [
                  'name'        => 'csv',
                  'label'       => 'CSVファイル',
                ])
                <button type="submit" class="btn btn-primary">　アップロード　</button>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection


@section('footer_script')
  <script>
    $('select[name=type]').change(function() {
      switch($(this).val()) {
        case 'series':
          $('form').attr('action', '{{ route('admin.series.import_csv') }}');
          break;
      }
    });
  </script>
@endsection

