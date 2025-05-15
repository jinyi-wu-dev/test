@extends('admin/feature/detail')

@section('title', '特徴・特性登録')
@section('header', '特徴・特性')

@section('breadcrumb')
  <li class="breadcrumb-item active">特徴・特性登録</li>
@endsection

@section('form')
  <form method="post" action="{{ route('admin.feature.store') }}" enctype="multipart/form-data">
@endsection

@section('form_button')
  <button type="submit" class="btn btn-primary">　登　録　</button>  
@endsection
