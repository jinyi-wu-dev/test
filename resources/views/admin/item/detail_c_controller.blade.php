          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">共通項目</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                @include('admin.parts.form_select', [
                  'name'      => '_c:dimmable_control',
                  'label'     => '調光制御',
                  'value'     => $detail->dimmable_control->value ?? '',
                  'options'   => App\Enums\DimmableControl::keyLabel(),
                ])
                <div class="form-group">
                  <label>外部調光制御</label>
                  <div>
                    @include('admin.parts.custom_checkbox', [
                      'switch'      => true,
                      'name'        => '_c:is_ethernet',
                      'label'       => 'LAN通信',
                      'value'       => $detail->is_ethernet ?? '',
                      'empty_value' => true,
                    ])
                    @include('admin.parts.custom_checkbox', [
                      'switch'      => true,
                      'name'        => '_c:is_8bit_parallel',
                      'label'       => '8bitパラレル通信',
                      'value'       => $detail->is_8bit_parallel ?? '',
                      'empty_value' => true,
                    ])
                    @include('admin.parts.custom_checkbox', [
                      'switch'      => true,
                      'name'        => '_c:is_10bit_parallel',
                      'label'       => '10bitパラレル通信',
                      'value'       => $detail->is_10bit_parallel ?? '',
                      'empty_value' => true,
                    ])
                    @include('admin.parts.custom_checkbox', [
                      'switch'      => true,
                      'name'        => '_c:is_rs232c',
                      'label'       => 'RS-232C通信',
                      'value'       => $detail->is_rs232c ?? '',
                      'empty_value' => true,
                    ])
                    @include('admin.parts.custom_checkbox', [
                      'switch'      => true,
                      'name'        => '_c:is_analog',
                      'label'       => 'アナログ0-5v',
                      'value'       => $detail->is_analog ?? '',
                      'empty_value' => true,
                    ])
                  </div>
                </div>
              </div>
              <div class="card-footer">
                @yield('form_button')
              </div>
            </div>
          </div>
