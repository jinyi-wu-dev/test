@extends('admin/item/detail')


@if ($item->series->category==App\Enums\Category::LIGHTING)
  @section('title', '個別型式情報・照明')
  @section('header', '個別型式情報・照明')
@elseif ($item->series->category==App\Enums\Category::CONTROLLER)
  @section('title', '個別型式情報・コントローラ')
  @section('header', '個別型式情報・コントローラ')
@elseif ($item->series->category==App\Enums\Category::OPTION)
  @section('title', '個別型式情報・オプション')
  @section('header', '個別型式情報・オプション')
@endif


@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.top') }}">一覧</a></li>
  <li class="breadcrumb-item active">詳細</li>
@endsection


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
