@extends('admin/base')

@section('title', 'アイコン一覧')
@section('header', 'アイコン')

@section('breadcrumb')
  <li class="breadcrumb-item active">アイコン一覧</li>
@endsection

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 col-sm-12 mx-auto">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">一覧</h3>
            </div>
            <div class="card-body">
              {{--
              <form method="get" action="{{ route('admin.icon.index') }}"> 
                <div class="callout callout-secondary">
                  @include('admin.parts.block_text', [
                    'label' => '検索',
                    'name'  => 'search_text',
                    'value' => request('name'),
                  ])
                  <button type="submit" class="btn btn-secondary">　検　索　</button>  
                </div>
              </form>
              --}}
              <div class="row">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>画像</th>
                      <th>タイトル</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($icons as $icon)
                    <tr>
                      <td>
                        <a href="{{ route('admin.icon.edit', $icon->id) }}">{{ $icon->id }}</a>
                      </td>
                      <td>
                        @if ($icon->hasImage())
                          <img src="{{ $icon->imageUrl() }}">
                        @endif
                      </td>
                      <td>
                        {{ $icon->title }}
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $icons->links('admin.parts.pagination') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
