@extends('admin/base')

@section('title', '特徴・特性一覧')
@section('header', '特徴・特性')

@section('breadcrumb')
  <li class="breadcrumb-item active">特徴・特性一覧</li>
@endsection

@section('content')
  @include('admin.parts.modal', [
    'id'      => 'conformModal',
    'title'   => '削除',
    'message' => '削除します。よろしいですか？',
    'on_ok'   => 'doDelete();',
  ])
  <section class="content">
  <form method="get" action="{{ route('admin.feature.index') }}"> 
    @csrf
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 col-sm-12 mx-auto">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">一覧</h3>
            </div>
            <div class="card-body">
              {{--
                <div class="callout callout-secondary">
                  @include('admin.parts.block_text', [
                    'label' => '検索',
                    'name'  => 'search_text',
                    'value' => request('name'),
                  ])
                  <button type="submit" class="btn btn-secondary">　検　索　</button>  
                </div>
              --}}
              <div class="row">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>タイトル</th>
                      <th>レイアウト</th>
                      <th>本文</th>
                      <th></th>
                      <th>削除</th>
                    </tr>
                    <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th>
                        @include('admin.parts.block_checkbox', [
                          'name'  => 'is_delete_all',
                          'type'  => 'danger',
                        ])
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($features as $feature)
                    <tr>
                      <td>
                        <a href="{{ route('admin.feature.edit', $feature->id) }}">{{ $feature->id }}</a>
                      </td>
                      <td>
                        {{ $feature->title }}
                      </td>
                      <td>
                        {{ $feature->layout->label() }}
                      </td>
                      <td>
                        {{ $feature->japanese_detail->body }}
                      </td>
                      <td>
                        @if ($icon->hasFile('image'))
                          <img src="{{ $icon->fileUrl('image') }}?{{uniqid()}}">
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $features->links('admin.parts.pagination') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
