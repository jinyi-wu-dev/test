@extends('admin/base')


@section('title', '会員一覧')
@section('header', '会員')


@section('breadcrumb')
  <li class="breadcrumb-item active">会員一覧</li>
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
                @csrf
                <div class="callout callout-secondary">
                  @include('admin.parts.form_text', [
                    'label' => '名前',
                    'name'  => 'name',
                    'value' => request('name'),
                  ])
                  <button type="submit" class="btn btn-secondary">　検　索　</button>  
                  <button type="submit" class="btn btn-secondary btn-sm float-right" onClick="
                    $('form').attr('action', '{{ route('admin.user.csv') }}').attr('target', '_blank').attr('method', 'post');
                  ">　CSV出力　</button>  
                </div>
              </form>
              <div class="row">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>名前</th>
                      <th>会社名</th>
                      <th>メールアドレス</th>
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
                      <td>{{ $user->company }}</td>
                      <td>{{ $user->email }}</td>
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
