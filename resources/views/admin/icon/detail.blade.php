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
              <div class="card-body">

                @include('admin.parts.form_file', [
                  'name'        => 'image',
                  'label'       => '画像',
                  'image_path'  => isset($icon)&&$icon->hasFile('image') ? $icon->fileUrl('image') : '',
                ])
                @include('admin.parts.form_text', [
                  'name'  => 'title',
                  'label' => 'タイトル',
                  'value' => $icon->title ?? '',
                ])
                
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection


@section('footer_script')
  <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
  <script>
    $(function() {
      bsCustomFileInput.init();
    });
  </script>
@endsection
