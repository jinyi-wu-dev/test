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
                @include('admin.parts.form_text', [
                  'name'      => 'search_options',
                  'label'     => '',
                  'value'     => '',
                ])
                <div class="d-flex flex-row flex-wrap justify-content-start">
                  @foreach ($relateds as $series)
                    <div class="pr-4" style="width:25%">
                      @include('admin.parts.form_select', [
                        'name'      => 'options[]',
                        'value'     => $series->id,
                        'empty'     => true,
                        'options'   => $options,
                      ])
                    </div>
                  @endforeach
                  @for ($series=count($relateds); $series<20; $series++)
                    <div class="pr-4" style="width:25%">
                      @include('admin.parts.form_select', [
                        'name'      => 'options[]',
                        'value'     => '',
                        'empty'     => true,
                        'options'   => $options,
                      ])
                    </div>
                  @endfor
                </div>
              </div>
            </div>
          </div>
