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

                @include('admin.parts.form_text', [
                  'name'      => 'name',
                  'label'     => '名前',
                  'valiable'  => 'user',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'kana',
                  'label'     => 'フリガナ',
                  'valiable'  => 'user',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'postal_code',
                  'label'     => '郵便番号',
                  'valiable'  => 'user',
                ])
                @include('admin.parts.form_select', [
                  'name'      => 'prefecture',
                  'label'     => '都道府県',
                  'valiable'  => 'user',
                  'empty'     => true,
                  'options'   => App\Enums\Prefecture::keyLabel(),
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'country',
                  'label'     => '国名',
                  'valiable'  => 'user',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'city',
                  'label'     => '市町村区',
                  'valiable'  => 'user',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'area',
                  'label'     => '番地',
                  'valiable'  => 'user',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'building',
                  'label'     => 'ビル名',
                  'valiable'  => 'user',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'phone_number',
                  'label'     => '電話番号',
                  'valiable'  => 'user',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'company',
                  'label'     => '会社名',
                  'valiable'  => 'user',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'department',
                  'label'     => '部署',
                  'valiable'  => 'user',
                ])
                <div class="form-group">
                  <label for="">役職</label>
                  <div class="d-flex flex-row flex-wrap justify-content-start">
                    @foreach (config('enums.ja.position') as $val => $label)
                      <div class="pl-4">
                        @include('admin.parts.form_checkbox', [
                          'name'        => 'positions[]',
                          'id'          => 'positions-'.$val,
                          'label'       => $label,
                          'form_value'  => $val,
                          'checked'     => in_array($val, $user->positions),
                        ])
                      </div>
                    @endforeach
                  </div>
                </div>
                <div class="form-group">
                  <label for="">業種</label>
                  <div class="d-flex flex-row flex-wrap justify-content-start">
                    @foreach (config('enums.ja.industry') as $val => $label)
                      <div class="pl-4">
                        @include('admin.parts.form_checkbox', [
                          'name'        => 'industries[]',
                          'id'          => 'industries-'.$val,
                          'label'       => $label,
                          'form_value'  => $val,
                          'checked'     => in_array($val, $user->industries),
                        ])
                      </div>
                    @endforeach
                  </div>
                </div>
                <div class="form-group">
                  <label for="">職種</label>
                  <div class="d-flex flex-row flex-wrap justify-content-start">
                    @foreach (config('enums.ja.occupation') as $val => $label)
                      <div class="pl-4">
                        @include('admin.parts.form_checkbox', [
                          'name'        => 'occupationes[]',
                          'id'          => 'occupationes-'.$val,
                          'label'       => $label,
                          'form_value'  => $val,
                          'checked'     => in_array($val, $user->occupationes),
                        ])
                      </div>
                    @endforeach
                  </div>
                </div>
                @include('admin.parts.form_text', [
                  'name'      => 'email',
                  'label'     => 'メールアドレス',
                  'valiable'  => 'user',
                ])
                @include('admin.parts.form_text', [
                  'name'      => 'password',
                  'label'     => 'パスワード',
                ])
                
              </div>
              <div class="card-footer">
                @yield('form_button')
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8 col-sm-12 mx-auto">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">貸出実績</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>品目タイプ</th>
                      <th>型式</th>
                      <th>台数</th>
                      <th>備考欄</th>
                      <th>ご依頼日</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($lend_items as $lend_item)
                      @foreach ($lend_item->items as $key => $item)
                        <tr>
                          <td>{{ $item->series->category->label() }}</td>
                          <td>{{ $item->model }}</td>
                          <td>{{ $item->pivot->num_of_item }}</td>
                          @if($key==0)
                            <td rowspan="{{ count($lend_item->items) }}">{{ $lend_item->remarks }}</td>
                            <td rowspan="{{ count($lend_item->items) }}">{{ $lend_item->requested_at }}</td>
                          @endif
                        </tr>
                      @endforeach
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
