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
      @yield('form')
        @csrf

        <div class="row">
          <div class="col-md-12 mx-auto">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">詳細</h3>
              </div>
              <div class="card-body">

                @include('admin.parts.block_text', [
                  'name'      => 'id',
                  'label'     => 'ID',
                  'valiable'  => 'feature',
                  'disabled'  => true,
                ])
                @include('admin.parts.block_select', [
                  'name'      => 'layout',
                  'label'     => 'レイアウト',
                  'value'     => $feature->layout->value ?? '',
                  'empty'     => true,
                  'options'   => $layouts,
                ])
                
              </div>
              <div class="card-footer">
                @yield('form_button')
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">日本語</h3>
              </div>
              <div class="card-body">

                @include('admin.parts.block_text', [
                  'name'      => 'jp:title',
                  'label'     => 'タイトル',
                  'value'     => $details['jp']->title ?? '',
                ])
                @include('admin.parts.block_textarea', [
                  'name'      => 'jp:body',
                  'label'     => '本文',
                  'value'     => $details['jp']->body ?? '',
                ])
                @include('admin.parts.block_file', [
                  'name'        => 'jp:image',
                  'label'       => '画像',
                  'image_path'  => isset($details['jp'])&&$details['jp']->hasImage() ? $details['jp']->imageUrl() : '',
                ])
                
              </div>
              <div class="card-footer">
                @yield('form_button')
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">英語</h3>
              </div>
              <div class="card-body">

                @include('admin.parts.block_text', [
                  'name'      => 'en:title',
                  'label'     => 'タイトル',
                  'value'     => $details['en']->title ?? '',
                ])
                @include('admin.parts.block_textarea', [
                  'name'      => 'en:body',
                  'label'     => '本文',
                  'value'     => $details['en']->body ?? '',
                ])
                @include('admin.parts.block_file', [
                  'name'        => 'en:image',
                  'label'       => '画像',
                  'image_path'  => isset($details['en'])&&$details['en']->hasImage() ? $details['en']->imageUrl() : '',
                ])
                
              </div>
              <div class="card-footer">
                @yield('form_button')
              </div>
            </div>
          </div>
        </div>

      </form>
    </div>
  </section>
@endsection
