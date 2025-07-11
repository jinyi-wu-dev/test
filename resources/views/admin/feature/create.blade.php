@extends('admin/feature/detail')


@section('title', '特徴・特性登録')
@section('header', '特徴・特性')


@section('breadcrumb')
  <li class="breadcrumb-item active">特徴・特性登録</li>
@endsection


@section('form')
  <form method="post" action="{{ route('admin.feature.store') }}" enctype="multipart/form-data">
  @csrf
@endsection


@section('footer')
  <footer class="main-footer fixed-bottom">
    <button type="submit" class="btn btn-primary">　登　録　</button>  
  </footer>
  </form>
@endsection
