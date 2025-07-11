@extends('admin/user/detail')


@section('title', '会員更新')
@section('header', '会員')


@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">会員一覧</a></li>
  <li class="breadcrumb-item active">会員詳細</li>
@endsection


@section('form')
  <form method="post" action="{{ route('admin.user.update', $user->id) }}">
  @method('put')
  @csrf
@endsection


@section('form_button')
  <footer class="main-footer fixed-bottom">
    <button type="submit" class="btn btn-primary">　変　更　</button>  
    <button type="button" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#conformModal">　削　除　</button>
  </footer>
  </form>
@endsection
