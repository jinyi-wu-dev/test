@extends('admin/icon/detail')


@section('title', 'アイコン登録')
@section('header', 'アイコン')


@section('breadcrumb')
  <li class="breadcrumb-item active">アイコン登録</li>
@endsection


@section('form')
  <form method="post" action="{{ route('admin.icon.store') }}" enctype="multipart/form-data">
  @csrf
@endsection


@section('footer')
  <footer class="main-footer fixed-bottom">
    <button type="submit" class="btn btn-primary">　登　録　</button>  
  </footer>
  </form>
@endsection
