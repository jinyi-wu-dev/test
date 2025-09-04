@extends('admin/cable_item_group/detail')


@section('title', '個別型式情報・ケーブル')
@section('header', '個別型式情報・ケーブル')


@section('breadcrumb')
  <li class="breadcrumb-item active">ケーブル登録</li>
@endsection


@section('form')
  <form method="post" action="{{ route('admin.cable.store') }}" enctype="multipart/form-data">
  @csrf
@endsection


@section('footer')
  <footer class="main-footer fixed-bottom">
    <button type="submit" class="btn btn-primary">　追　加　</button>  
  </footer>
  </form>
@endsection
