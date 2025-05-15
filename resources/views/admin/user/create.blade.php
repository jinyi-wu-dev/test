@extends('admin/user/detail')

@section('title', 'ユーザ新規作成')
@section('header', 'ユーザ')

@section('breadcrumb')
  <li class="breadcrumb-item active">UserCreate</li>
@endsection

@section('form')
  <form method="post" action="{{ route('admin.user.store') }}">
@endsection

@section('form_button')
  <button type="submit" class="btn btn-primary">　追　加　</button>  
@endsection
