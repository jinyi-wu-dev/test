@extends('admin/base')


@section('title', 'CSVアップロード')
@section('header', 'CSVアップロード')


@section('breadcrumb')
  <li class="breadcrumb-item active">CSVアップロード結果</li>
@endsection


@section('form')
  <form method="post" action="{{ route('admin.csv') }}" enctype="multipart/form-data" target="_blank">
  @csrf
@endsection


@section('footer')
  </form>
@endsection


@section('content')
  <section class="content">
    <div class="container-fluid">
      
      <div class="row">

        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">結果</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="alert alert-info" role="alert">
                {{ count($inserts) }}件新規登録しました
              </div>
              <div class="alert alert-success" role="alert">
                {{ count($updates) }}件更新しました
              </div>
              @if ($error)
                <div class="alert alert-danger" role="alert">
                  {{ $error }}<br/>
                  処理が途中で失敗しました
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection


