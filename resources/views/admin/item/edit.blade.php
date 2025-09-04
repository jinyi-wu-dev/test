@extends('admin/item/detail')


@if ($item->series->category==App\Enums\Category::LIGHTING)
  @section('title', '個別型式情報・照明')
  @section('header', '個別型式情報・照明')
  @section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.item.index', ['category'=>'lighting']) }}">照明一覧</a></li>
    <li class="breadcrumb-item active">照明詳細</li>
  @endsection
@elseif ($item->series->category==App\Enums\Category::CONTROLLER)
  @section('title', '個別型式情報・コントローラー')
  @section('header', '個別型式情報・コントローラー')
  @section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.item.index', ['category'=>'controller']) }}">コントローラー一覧</a></li>
    <li class="breadcrumb-item active">コントローラー詳細</li>
  @endsection
@elseif ($item->series->category==App\Enums\Category::OPTION)
  @section('title', '個別型式情報・オプション')
  @section('header', '個別型式情報・オプション')
  @section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.item.index', ['category'=>'option']) }}">オプション一覧</a></li>
    <li class="breadcrumb-item active">オプション詳細</li>
  @endsection
@endif


@section('form')
  <form method="post" action="{{ route('admin.item.update', $item->id) }}" enctype="multipart/form-data">
  @method('put')
  @csrf
@endsection


@section('footer')
  <footer class="main-footer fixed-bottom">
    <button type="submit" class="btn btn-primary">　変　更　</button>  
    <button type="button" class="btn btn-sm btn-info ml-5" onclick="window.open('{{ route('item', $item) }}', '_blank')">　ページ表示　</button>  
    <button type="button" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#conformModal">　削　除　</button>
  </footer>
  </form>
@endsection
