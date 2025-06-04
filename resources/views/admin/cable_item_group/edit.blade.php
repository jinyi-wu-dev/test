@extends('admin/cable_item_group/detail')

@section('title', '個別型式情報・ケーブル')
@section('header', '個別型式情報・ケーブル')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.top') }}">UserList</a></li>
  <li class="breadcrumb-item active">UserEdit</li>
@endsection

@section('form')
  <form method="post" action="{{ route('admin.group.update', $group->id) }}" enctype="multipart/form-data">
  @method('put')
@endsection

@section('form_button')
  <button type="submit" class="btn btn-primary">　変　更　</button>  
  <button type="button" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#conformDeleteGroupModal">　削　除　</button>
@endsection
