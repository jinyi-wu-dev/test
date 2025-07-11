@extends('admin/icon/detail')


@section('title', 'アイコン更新')
@section('header', 'アイコン')


@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.icon.index') }}">アイコン一覧</a></li>
  <li class="breadcrumb-item active">アイコン更新</li>
@endsection


@section('form')
  <form method="post" action="{{ route('admin.icon.update', $icon->id) }}" enctype="multipart/form-data">
  @method('put')
  @csrf
@endsection


@section('footer')
  <footer class="main-footer fixed-bottom">
    <button type="submit" class="btn btn-primary">　変　更　</button>  
    <button type="button" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#conformModal">　削　除　</button>
  </footer>
  </form>
@endsection
