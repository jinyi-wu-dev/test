@extends('admin/feature/detail')

@section('title', '特徴・特性更新')
@section('header', '特徴・特性')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.feature.index') }}">特徴・特性一覧</a></li>
  <li class="breadcrumb-item active">特徴・特性更新</li>
@endsection

@section('form')
  <form method="post" action="{{ route('admin.feature.update', $feature->id) }}" enctype="multipart/form-data">
  @method('put')
@endsection

@section('form_button')
  <button type="submit" class="btn btn-primary">　変　更　</button>  
  <button type="button" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#conformModal">　削　除　</button>
@endsection
