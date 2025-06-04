@extends('admin/cable_item_group/detail')

@section('title', '個別型式情報・ケーブル')
@section('header', '個別型式情報・ケーブル')

@section('breadcrumb')
  <li class="breadcrumb-item active">UserCreate</li>
@endsection

@section('form')
  <form method="post" action="{{ route('admin.group.store') }}" enctype="multipart/form-data">
@endsection

@section('form_button')
  <button type="submit" class="btn btn-primary">　追　加　</button>  
@endsection
