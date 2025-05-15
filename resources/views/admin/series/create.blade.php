@extends('admin/series/detail')

@section('title', 'シリーズ新規作成')
@section('header', 'シリーズ')

@section('breadcrumb')
  <li class="breadcrumb-item active">UserCreate</li>
@endsection

@section('form')
  <form method="post" action="{{ route('admin.series.store') }}" enctype="multipart/form-data">
@endsection

@section('form_button')
  <button type="submit" class="btn btn-primary">　追　加　</button>  
@endsection
