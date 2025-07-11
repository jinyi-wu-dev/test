          <div class="col-{{ $col }}">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">関連製品（ケーブル）</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                @foreach ($relateds as $series)
                  @include('admin.parts.form_select', [
                    'name'      => 'cables[]',
                    'value'     => $series->id,
                    'empty'     => true,
                    'options'   => $options,
                  ])
                @endforeach
                @for ($series=count($relateds); $series<20; $series++)
                  @include('admin.parts.form_select', [
                    'name'      => 'cables[]',
                    'value'     => '',
                    'empty'     => true,
                    'options'   => $options,
                  ])
                @endfor
              </div>
            </div>
          </div>
