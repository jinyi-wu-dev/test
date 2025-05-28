@extends('admin/item/detail')

@section('title', '個別型式情報（照明）更新')
@section('header', '個別型式情報（照明）')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.top') }}">UserList</a></li>
  <li class="breadcrumb-item active">UserEdit</li>
@endsection

@section('form')
  <form method="post" action="{{ route('admin.item.update', $item->id) }}" enctype="multipart/form-data">
  @method('put')
@endsection

@section('form_button')
  <button type="submit" class="btn btn-primary">　変　更　</button>  
  <button type="button" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#conformModal">　削　除　</button>
@endsection
