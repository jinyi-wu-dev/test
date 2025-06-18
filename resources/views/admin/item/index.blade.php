@extends('admin/base')


@if ($category==App\Enums\Category::LIGHTING)
  @section('title', '個別型式一覧・照明')
  @section('header', '個別型式一覧・照明')
@elseif ($category==App\Enums\Category::CONTROLLER)
  @section('title', '個別型式一覧・コントローラー')
  @section('header', '個別型式一覧・コントローラー')
@elseif ($category==App\Enums\Category::OPTION)
  @section('title', '個別型式一覧・オプション')
  @section('header', '個別型式一覧・オプション')
@endif


@section('breadcrumb')
  <li class="breadcrumb-item active">一覧</li>
@endsection


@section('content')
  @include('admin.parts.modal', [
    'id'      => 'conformModal',
    'title'   => '削除',
    'message' => '削除します。よろしいですか？',
    'on_ok'   => 'doDelete();',
  ])
  <section class="content">
  <form method="get" action="{{ route('admin.item.index') }}"> 
    @csrf
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline collapsed-card">
            <div class="card-header">
              <h3 class="card-title">表示項目設定</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              @if ($category==App\Enums\Category::LIGHTING)
                @include('admin.item.index_show_lighting')
              @elseif ($category==App\Enums\Category::CONTROLLER)
                @include('admin.item.index_show_controller')
              @elseif ($category==App\Enums\Category::OPTION)
                @include('admin.item.index_show_option')
              @endif
            </div>
          </div>
        </div>
        <div class="col-md-12 mx-auto">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">一覧</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="callout callout-secondary">
                @include('admin.parts.block_text', [
                  'label' => '名前',
                  'name'  => 'keyword',
                  'value' => request('keyword'),
                ])
                <button type="submit" class="btn btn-secondary">　検　索　</button>  
              </div>
              <div class="row">
                <table class="table table-bordered table-striped">
                  <thead>
                    @if ($category==App\Enums\Category::LIGHTING)
                      @include('admin.item.index_thead_lighting')
                    @elseif ($category==App\Enums\Category::CONTROLLER)
                      @include('admin.item.index_thead_controller')
                    @elseif ($category==App\Enums\Category::OPTION)
                      @include('admin.item.index_thead__option')
                    @endif
                  </thead>
                  <tbody>
                    @if ($category==App\Enums\Category::LIGHTING)
                      @foreach ($items as $i)
                        @include('admin.item.index_tbody_lighting', ['item'=>$i])
                      @endforeach
                    @elseif ($category==App\Enums\Category::CONTROLLER)
                      @foreach ($items as $i)
                        @include('admin.item.index_tbody_controller', ['item'=>$i])
                      @endforeach
                    @elseif ($category==App\Enums\Category::OPTION)
                      @foreach ($items as $i)
                        @include('admin.item.index_tbody_option', ['item'=>$i])
                      @endforeach
                    @endif
                  </tbody>
                </table>
                {{ $items->links('admin.parts.pagination') }}
              </div>
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-primary" onClick="doUpdate()">　変　更　</button>  
              <button type="button" class="btn btn-danger btn-sm float-right do_remove" data-toggle="modal" data-target="#conformModal" disabled>　削　除　</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  </section>
@endsection


@section('footer_script')
  <script src="{{ asset('/script/index.js') }}"></script>
  <script>
    $(function() {
      initCheckDisplayControll('lighting', 'CDC-', 'CDT-');
      initCheckDelete('input[name="removes\\[\\]"]', '.do_remove');
      initAllCheck('input[name=is_new_all]', 'input[name=is_new_ids\\[\\]]');
      initAllCheck('input[name=is_end_all]', 'input[name=is_end_ids\\[\\]]');
      initAllCheck('input[name=is_publish_all]', 'input[name=is_publish_ids\\[\\]]');
      initAllCheck('input[name=is_lend_all]', 'input[name=is_lend_ids\\[\\]]');
      initAllCheck('input[name=is_delete_all]', 'input[name=removes\\[\\]]');
    })
    function doUpdate() {
      $('form').attr('method', 'post').attr('action', '{{ route('admin.item.update_multiple') }}').submit();
    }
    function doDelete() {
      $('form').attr('method', 'post').attr('action', '{{ route('admin.item.destroy_multiple') }}').submit();
    }
  </script>
@endsection

