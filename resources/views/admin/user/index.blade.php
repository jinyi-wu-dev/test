@extends('admin/base')

@section('title', 'ユーザ一覧')
@section('header', 'ユーザ')

@section('breadcrumb')
  <li class="breadcrumb-item active">ユーザ一覧</li>
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
              <form method="get" action="{{ route('admin.user.index') }}"> 
                <div class="callout callout-secondary">
                  @include('admin.parts.block_text', [
                    'label' => '名前',
                    'name'  => 'name',
                    'value' => request('name'),
                  ])
                  <button type="submit" class="btn btn-secondary">　検　索　</button>  
                </div>
              </form>
              <div class="row">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>名称</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                    <tr>
                      <td>
                        <a href="{{ route('admin.user.edit', $user->id) }}">{{ $user->id }}</a>
                      </td>
                      <td>
                        {{ $user->name }}
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $users->links('admin.parts.pagination') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
