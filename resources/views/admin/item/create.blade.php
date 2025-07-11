@extends('admin/item/detail')


@if ($category==App\Enums\Category::LIGHTING)
  @section('title', '個別型式登録・照明')
  @section('header', '個別型式登録・照明')
@elseif ($category==App\Enums\Category::CONTROLLER)
  @section('title', '個別型式登録・コントローラー')
  @section('header', '個別型式登録・コントローラー')
@endif


@section('breadcrumb')
  <li class="breadcrumb-item active">登録</li>
@endsection


@section('form')
  <form method="post" action="{{ route('admin.item.store') }}" enctype="multipart/form-data">
  @csrf
@endsection


@section('footer')
  <footer class="main-footer fixed-bottom">
    <button type="submit" class="btn btn-primary">　追　加　</button>  
  </footer>
  </form>
@endsection
