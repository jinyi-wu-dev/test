          <div class="col-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                @include('admin.parts.form_text', [
                  'name'      => $lang.':type',
                  'label'     => 'タイプ',
                  'value'     => $detail->type ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':total_capacity',
                  'label'     => '合計容量',
                  'value'     => $detail->total_capacity ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':num_of_ch',
                  'label'     => 'CH数',
                  'value'     => $detail->num_of_ch ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':input',
                  'label'     => '入力',
                  'value'     => $detail->input ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':output',
                  'label'     => '出力',
                  'value'     => $detail->output ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':description1',
                  'label'     => '欄外記述1',
                  'value'     => $detail->description1 ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':description2',
                  'label'     => '欄外記述2',
                  'value'     => $detail->description2 ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':description3',
                  'label'     => '欄外記述3',
                  'value'     => $detail->description3 ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':description4',
                  'label'     => '欄外記述4',
                  'value'     => $detail->description4 ?? '',
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':description5',
                  'label'     => '欄外記述5',
                  'value'     => $detail->description5 ?? '',
                ])
              </div>
            </div>
          </div>
