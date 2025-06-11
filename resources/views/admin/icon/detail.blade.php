@extends('admin/base')

@section('content')
  <script>
    function onOK() {
      $('input[name="_method"]').val('delete');
      $('form').submit();
    }
  </script>
  @include('admin.parts.modal', [
    'id'      => 'conformModal',
    'title'   => '削除',
    'message' => '削除します。よろしいですか？',
    'on_ok'   => 'onOK();',
  ])
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 col-sm-12 mx-auto">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">詳細</h3>
            </div>
            @yield('form')
              @csrf
              <div class="card-body">

                @include('admin.parts.block_file', [
                  'name'        => 'image',
                  'label'       => '画像',
                  'image_path'  => isset($icon)&&$icon->hasFile('image') ? $icon->fileUrl('image') : '',
                ])
                @include('admin.parts.block_text', [
                  'name'  => 'title',
                  'label' => 'タイトル',
                  'value' => $icon->title ?? '',
                ])
                
              </div>
              <div class="card-footer">
                @yield('form_button')
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
