          <div class="col-{{ $col }}">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">関連製品（オプション）</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                @include('admin.parts.block_text', [
                  'name'      => 'search_options',
                  'label'     => '',
                  'value'     => '',
                ])
                @foreach ($relateds as $series)
                  @include('admin.parts.block_select', [
                    'name'      => 'options[]',
                    'value'     => $series->id,
                    'empty'     => true,
                    'options'   => $options,
                  ])
                @endforeach
                @for ($series=count($relateds); $series<20; $series++)
                  @include('admin.parts.block_select', [
                    'name'      => 'options[]',
                    'value'     => '',
                    'empty'     => true,
                    'options'   => $options,
                  ])
                @endfor
              </div>
              <div class="card-footer">
                @yield('form_button')
              </div>
            </div>
          </div>
