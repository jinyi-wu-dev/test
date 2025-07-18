eextends('front/ja/base')

@section('title') Leimac | {{ $series->model }} @endsection

@section('main')
    <!-- Site Main-->
    <main class="site-main" id="site-main">
      <!-- section-fv-->
      <section class="section section-fv-series-index">
        <div class="content row">
          <div class="index-grid">
            <div class="index-thumbnail"><img src="{{ $series->fileUrl('image') }}" alt=""></div>
            <div class="index-data">
              <div class="index-title">
                <span class="index-title-type">
                  {{ $series->locale_detail->name }}
                  {{ $series->genre->label() }}
                </span>
                <span class="index-title-series">{{ $series->model }} <span>series</span>
                </span>
              </div>
              <div class="index-textarea">
                <ul>
                  @if ($series->locale_detail->body1)
                    <li>{{ $series->locale_detail->body1 }}</li>
                  @endif
                  @if ($series->locale_detail->body2)
                    <li>{{ $series->locale_detail->body2 }}</li>
                  @endif
                  @if ($series->locale_detail->body3)
                    <li>{{ $series->locale_detail->body3 }}</li>
                  @endif
                </ul>
              </div>
              <div class="index-icons">
                @foreach ($series->icons as $icon)
                  <div class="index-icon"><img src="{{ $icon->fileUrl('image') }}" alt=""></div>
                @endforeach
              </div>
              <div class="index-btns">
                <div class="index-btn--download index-btn--catalog">
                  <a href="{{ $series->fileUrl('catalogue') }}" target="_blank" rel="noopener">カタログ DL</a>
                </div>
                <div class="index-btn--download">
                  <a href="{{ $series->fileUrl('pamphlet') }}" target="_blank" rel="noopener">パンフレット DL</a>
                </div>
                <div class="index-btn--download">
                  <a href="{{ $series->fileUrl('manual') }}" target="_blank" rel="noopener">取扱説明書 DL</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End - section-fv-->
      <div class="breadcrumbs">
        <div class="content row w1360">
          <div class="pkz">
            <span>
              <span>
                <a href="https://leimac.co.jp/">ホーム</a>
              </span> &gt; <span class="breadcrumb_last" aria-current="page">現在のページ</span>
            </span>
          </div>
        </div>
      </div>
      <!-- article-page-->
      <div class="page-column-wrap">
        <div class="content row">
          <div class="page-column">
            <article class="article page-article article-series-index">
              <div class="series-index-note">
                <p>
                {!! nl2br(e($series->locale_detail->note)) !!}
                </p>
              </div>
              <div class="tab-area tab-common">
                @php
                  $has_feature = count($series->features)>0;
                @endphp
                @if($has_feature)
                <input type="radio" name="tabneme01" id="tab01" checked>
                <label for="tab01">特 徴 / 特 性</label>
                @endif
                <input type="radio" name="tabneme01" id="tab02" @if(!$has_feature) checked @endif>
                <label for="tab02">シリーズ型式一覧 / 各種資料DL / デモ機貸出</label>
                @if($has_feature)
                <div class="tab-block series-block" data-tab-group="tabneme01">
                  <div class="tab-block__inner">
                    <div class="article-block">
                      <div class="feature-grid">
                        @foreach ($series->features as $feature)
                          @if ($feature->layout==App\Enums\Layout::HORIZONTAL)
                            <div class="feature-item">
                              <h2 class="c-title border square">{{ $feature->locale_detail->title }}</h2>
                              <div class="feature-lead">
                                <p>{{ $feature->locale_detail->body }}</p>
                              </div>
                              <div class="feature-image"><img class="modal-img" src="{{ $feature->locale_detail->fileUrl('image') }}" alt=""></div>
                            </div>
                          @elseif ($feature->layout==App\Enums\Layout::VERTICAL)
                            <div class="feature-item">
                              <h2 class="c-title border square">{{ $feature->locale_detail->title }}</h2>
                              <div class="inner">
                                <div class="feature-lead">
                                  <p>{{ $feature->locale_detail->body }}</p>
                                </div>
                                <div class="feature-image"><img class="modal-img" src="{{ $feature->locale_detail->fileUrl('image') }}" alt=""></div>
                              </div>
                            </div>
                          @endif
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                <div class="tab-block series-block" data-tab-group="tabneme01">
                  <div class="tab-block__inner">
                    <div class="article-block">
                      <div class="series-table-wrap table-wrap">
                        <table class="series-table-fix">
                          <thead>
                            <tr>
                              @if ($series->show_type)                      <th>タイプ</th> @endif
                              @if ($series->show_model)                     <th class="format">型　式</th> @endif
                              @if ($series->show_product_number)            <th>品番</th> @endif
                              @if ($series->show_weight)                    <th>器具重量</th> @endif
                              @if ($series->show_other)                     <th>その他</th> @endif
                              @if ($series->show_compatible_standards)      <th>適合規格</th> @endif

                              @if ($series->category==App\Enums\Category::LIGHTING)
                                @if ($series->show_luminous_color)          <th>発光色</th> @endif
                                @if ($series->show_lt_num_of_ch)            <th>CH数</th> @endif
                                @if ($series->show_power_consumption)       <th>消費電力</th> @endif
                                @if ($series->show_seg)                     <th>SAG値</th> @endif
                                @if ($series->show_input_voltage)           <th>入力電圧</th> @endif
                              @endif

                              @if ($series->category==App\Enums\Category::CONTROLLER)
                                @if ($series->show_diming_controll)         <th>調光制御</th> @endif
                                @if ($series->show_total_capacity)          <th>合計容量</th> @endif
                                @if ($series->show_ct_num_of_ch)            <th>CH数</th> @endif
                                @if ($series->show_input)                   <th>入力</th> @endif
                               @if ($series->show_output)                  <th>出力</th> @endif
                                @if ($series->show_external_onoff)          <th>外部ON/OFF</th> @endif
                                @if ($series->show_external_diming_control) <th>外部調光制御</th> @endif
                              @endif

                              @if ($series->category==App\Enums\Category::OPTION)
                                @if ($series->show_throughput)              <th>透過率</th> @endif
                              @endif

                              <th>外形図 DL</th>
                              <th>3Dモデル DL</th>
                              <th>デモ機貸出</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($series->items as $item)
                              <tr>
                                @if ($series->show_type)                      <td>{{ $item->type }}</td> @endif
                                @if ($series->show_model)                     <td class="format
                                                                                @if($item->is_new) is-new @endif
                                                                                @if($item->is_end) is-discontinued @endif
                                                                              "><a href="{{ route('item', $item) }}">{{ $item->model }}</a> </td> @endif
                                @if ($series->show_product_number)            <td>{{ $item->product_number }}</td> @endif
                                @if ($series->show_weight)                    <td>{{ $item->weight }}</td> @endif
                                @if ($series->show_other)                     <td></td> @endif
                                @if ($series->show_compatible_standards)      <td></td> @endif

                                @if ($series->category==App\Enums\Category::LIGHTING)
                                  @if ($series->show_luminous_color)          <td>{{ $item->locale_lighting_item->color1 }}</td> @endif
                                  @if ($series->show_lt_num_of_ch)            <td>{{ $item->locale_lighting_item->num_of_ch }}</td> @endif
                                  @if ($series->show_power_consumption)       <td>{{ $item->locale_lighting_item->power_connector }}</td> @endif
                                  @if ($series->show_seg)                     <td></td> @endif
                                  @if ($series->show_input_voltage)           <td>{{ $item->locale_lighting_item->input }}</td> @endif
                                @endif

                                @if ($series->category==App\Enums\Category::CONTROLLER)
                                  @if ($series->show_diming_controll)         <td>{{ $item->locale_controller_item->dimmable_control->label() }}</td> @endif
                                  @if ($series->show_total_capacity)          <td>{{ $item->locale_controller_item->total_capacity }}</td> @endif
                                  @if ($series->show_ct_num_of_ch)            <td>{{ $item->locale_controller_item->num_of_ch }}</td> @endif
                                  @if ($series->show_input)                   <td>{{ $item->locale_controller_item->input }}</td> @endif
                                  @if ($series->show_output)                  <td>{{ $item->locale_controller_item->output }}</td> @endif
                                  @if ($series->show_external_onoff)          <td></td> @endif
                                  @if ($series->show_external_diming_control) <td></td> @endif
                                @endif

                                @if ($series->category==App\Enums\Category::OPTION)
                                  @if ($series->show_throughput)              <td>{{ $item->locale_option_item->throughput }}</td> @endif
                                @endif

                                <td>
                                  <div class="download">
                                    <a class="download-icon" href="{{ $item->fileUrl('external_view_pdf') }}" target="_blank" rel="noopener"><img src="{{ asset('/assets/img/common/dl-pdf.png') }}" alt="PDF"></a>
                                    <a class="dl-icon" href="{{ $item->fileUrl('external_view_dxf') }}" target="_blank" rel="noopener"><img src="{{ asset('/assets/img/common/dl-dxf.png') }}" alt="DXF"></a>
                                  </div>
                                </td>
                                <td>
                                  <div class="download">
                                    <a class="download-icon" href="{{ $item->fileUrl('3d_model_step') }}" target="_blank" rel="noopener"><img src="{{ asset('/assets/img/common/dl-step.png') }}" alt="step"></a>
                                  </div>
                                </td>
                                <td>
                                  <button class="lending-request-button @if(!$item->is_lend) is-disabled @endif"
                                    @if(!$item->is_lend) disabled @endif
                                    item_id="{{ $item->id }}"
                                    item_name1="{{ $item->model }}"
                                    item_name2="{{ $item->model }}"
                                    item_url="{{ $series->fileUrl('image') }}"
                                  >貸出依頼</button>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </article>
          </div>
        </div>
        <!-- section-cta-->
        <section class="section section-cta">
          <div class="section-content">
            <div class="content row w1360">
              <div class="cta">
                <p class="cta-title">お気軽にご相談くださいませ</p>
                <div class="cta-contact">
                  <div class="btn--cta">
                    <a href="../mail">
                      <svg id="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30.5 25">
                        <<path class="cta-icon" d="M25.12,0H5.39C2.41,0,0,2.41,0,5.39v10.14c0,2.97,2.41,5.39,5.39,5.39h9.62l5.82,4.09v-4.09h4.29c2.97,0,5.39-2.41,5.39-5.39V5.39c0-2.97-2.41-5.39-5.39-5.39ZM7.73,12.57c-1.17,0-2.12-.95-2.12-2.12s.95-2.12,2.12-2.12,2.12.95,2.12,2.12-.95,2.12-2.12,2.12ZM15.25,12.57c-1.17,0-2.12-.95-2.12-2.12s.95-2.12,2.12-2.12,2.12.95,2.12,2.12-.95,2.12-2.12,2.12ZM22.78,12.57c-1.17,0-2.12-.95-2.12-2.12s.95-2.12,2.12-2.12,2.12.95,2.12,2.12-.95,2.12-2.12,2.12Z" />
                      </svg>
                      <span>お問合せ</span>
                    </a>
                  </div>
                  <div class="tel">
                    <span class="num">077-585-6771</span>
                    <span>（平日8：45－17：30）</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End - section-cta-->
      </div>
      <!-- End - article-page-->
    </main>
    <!-- End Site Main-->

    <script>
      document.addEventListener("DOMContentLoaded", function() {
      });
    </script>
@endsection
