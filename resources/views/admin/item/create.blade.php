@extends('admin/series/detail')

@section('title', '個別型式新規作成・照明')
@section('header', '個別型式新規作成・照明')

@section('breadcrumb')
  <li class="breadcrumb-item active">UserCreate</li>
@endsection

@section('form')
  <form method="post" action="{{ route('admin.item.store') }}" enctype="multipart/form-data">
@endsection

@section('form_button')
  <button type="submit" class="btn btn-primary">　追　加　</button>  
@endsection
