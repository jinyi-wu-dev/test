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
                  'disabled'  => $lang!='ja' && in_array('type', config('system.common_columns.lighting')),
                ])
                @include('admin.parts.form_select', [
                  'name'      => $lang.':color',
                  'label'     => '発光色',
                  'value'     => $detail->color->value ?? '',
                  'empty'     => true,
                  'options'   => App\Enums\Color::keyLabel(),
                  'disabled'  => $lang!='ja' && in_array('color', config('system.common_columns.lighting')),
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':color1',
                  'label'     => '発光色記号',
                  'value'     => $detail->color1 ?? '',
                  'disabled'  => $lang!='ja' && in_array('color1', config('system.common_columns.lighting')),
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':color2',
                  'label'     => '色温度/ピーク波長',
                  'value'     => $detail->color2 ?? '',
                  'disabled'  => $lang!='ja' && in_array('color2', config('system.common_columns.lighting')),
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':power_consumption',
                  'label'     => '消費電力',
                  'value'     => $detail->power_consumption ?? '',
                  'disabled'  => $lang!='ja' && in_array('power_consumption', config('system.common_columns.lighting')),
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':num_of_ch',
                  'label'     => 'CH数',
                  'value'     => $detail->num_of_ch ?? '',
                  'disabled'  => $lang!='ja' && in_array('num_of_ch', config('system.common_columns.lighting')),
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':input',
                  'label'     => '入力',
                  'value'     => $detail->input ?? '',
                  'disabled'  => $lang!='ja' && in_array('input', config('system.common_columns.lighting')),
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':etc',
                  'label'     => 'その他',
                  'value'     => $detail->etc ?? '',
                  'disabled'  => $lang!='ja' && in_array('etc', config('system.common_columns.lighting')),
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':description1',
                  'label'     => '欄外記述1',
                  'value'     => $detail->description1 ?? '',
                  'disabled'  => $lang!='ja' && in_array('description1', config('system.common_columns.lighting')),
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':description2',
                  'label'     => '欄外記述2',
                  'value'     => $detail->description2 ?? '',
                  'disabled'  => $lang!='ja' && in_array('description2', config('system.common_columns.lighting')),
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':description3',
                  'label'     => '欄外記述3',
                  'value'     => $detail->description3 ?? '',
                  'disabled'  => $lang!='ja' && in_array('description3', config('system.common_columns.lighting')),
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':description4',
                  'label'     => '欄外記述4',
                  'value'     => $detail->description4 ?? '',
                  'disabled'  => $lang!='ja' && in_array('description4', config('system.common_columns.lighting')),
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':description5',
                  'label'     => '欄外記述5',
                  'value'     => $detail->description5 ?? '',
                  'disabled'  => $lang!='ja' && in_array('description5', config('system.common_columns.lighting')),
                ])
                @include('admin.parts.form_text', [
                  'name'      => $lang.':note',
                  'label'     => '注意書き',
                  'value'     => $detail->note ?? '',
                  'disabled'  => $lang!='ja' && in_array('note', config('system.common_columns.lighting')),
                ])
              </div>
            </div>
          </div>
