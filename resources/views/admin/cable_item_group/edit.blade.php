@extends('admin/cable_item_group/detail')


@section('title', '個別型式情報・ケーブル')
@section('header', '個別型式情報・ケーブル')


@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.cable.index') }}">ケーブル一覧</a></li>
  <li class="breadcrumb-item active">ケーブル詳細</li>
@endsection


@section('form')
  <form method="post" action="{{ route('admin.cable.update', $group->id) }}" enctype="multipart/form-data">
  @method('put')
  @csrf
@endsection


@section('footer')
  <footer class="main-footer fixed-bottom">
    <button type="submit" class="btn btn-primary">　変　更　</button>  
    <button type="button" class="btn btn-sm btn-info ml-5" onclick="window.open('{{ route('series', $group->series) }}', '_blank')">　ページ表示　</button>  
    <button type="button" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#conformDeleteGroupModal">　削　除　</button>
  </footer>
  </form>
@endsection
