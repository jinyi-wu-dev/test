@extends('front/'.app()->getLocale().'/base')


@section('title')
  <title>Leimac | {{ $series->model }}</title>
@endsection


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

                @if ($series->category!=App\Enums\Category::CABLE)
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
                @else
                <div class="tab-block series-block" data-tab-group="tabneme01">
                  <div class="tab-block__inner">
                    <div class="article-block">
                      <div class="column column-2">
                        <div class="column-item">
                          <h2 class="c-title square">シリーズ型式一覧 / デモ機貸出</h2>
                          <div class="series-table-wrap table-wrap series-table--last1">
                            <table class="series-table-fix">
                              <thead>
                                <tr>
                                  <th class="format">型　式</th>
                                  <th>品　番</th>
                                  <th>接続条件</th>
                                  <th>ケーブル長さ</th>
                                  <th>デモ機貸出</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($group->items() as $item)
                                  @php
                                    $item_lc = $item->locale_cable_item;
                                    $item_ja = $item->japanese_cable_item;
                                  @endphp
                                  <tr>
                                    <td class="format">
                                      <span>{{ $item->model }}</span>
                                    </td>
                                    <td>{{ $item->product_number }}</td>
                                    <td>{{ $item_ja->conditions }}</td>
                                    <td>{{ $item_lc->length ? $item_lc->length : $item_ja->length }}</td>
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
                          <h2 class="c-title square">製品仕様</h2>
                          <table class="product-detail-table">
                            <tbody>
                              <tr>
                                <th>使用温度</th>
                                <td>{{ $first_item_ja->operating_temperature }}</td>
                              </tr>
                              <tr>
                                <th>使用湿度</th>
                                <td>{{ $first_item_ja->operating_humidity }}</td>
                              </tr>
                              <tr>
                                <th>適合規格</th>
                                <td>
                                  @php
                                    $tmp = [];
                                    if ($first_item_ja->is_RoHS)       $tmp[] = 'RoHS';
                                    if ($first_item_ja->is_RoHS2)      $tmp[] = 'RoHS2';
                                    if ($first_item_ja->is_CN_RoHSe1)  $tmp[] = '中国RoHS e-1';
                                    if ($first_item_ja->is_CN_RoHS102) $tmp[] = '中国RoHS 10-2';
                                    if ($first_item_ja->is_CE_IEC)     $tmp[] = 'CE(IEC62471)';
                                    if ($first_item_ja->is_CE_IEC)     $tmp[] = 'CE(EN55011, EN61000-6-2)';
                                    if ($first_item_ja->is_UKCA)       $tmp[] = 'UKCA';
                                    if ($first_item_ja->is_PSE)        $tmp[] = 'PSE';
                                  @endphp
                                  {!! implode('<br/>', $tmp) !!}
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="column-item">
                          <h2 class="c-title square">3Dビュー</h2>
                          <div id="canvasBox" data-stl-path="../assets/stl//stlitem.STL"></div>
                        </div>
                      </div>
                    </div>
                    <div class="article-block">
                      <h2 class="c-title square">外観図</h2>
                      <div class="canvas-container" style="overflow: hidden; position: relative; width: 100%; height: 600px; border: 1px solid #ccc;">
                        <div class="canvas-controller">
                          <button class="canvas-controller-in" onclick="zoomIn()"></button>
                          <button class="canvas-controller-out" onclick="zoomOut()"></button>
                          <button class="canvas-controller-full" onclick="toggleFullscreen()"></button>
                        </div>
                        <canvas id="pdf-canvas" class="pdf-canvas" style="cursor: grab; position: absolute; left: 0; top: 0;"></canvas>
                      </div>

                      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
                      <script src="{{ asset('/assets/js/pdf.js') }}"></script>
                      <script>
                        initPdfCanvas(
                          "{{ $group_lc->hasFile('external_view_pdf') ? $group_lc->fileUrl('external_view_pdf') : ($group_ja->hasFile('external_view_pdf') ? $group_ja->fileUrl('external_view_pdf') : '') }}"
                        );
                      </script>
                      <div class="column column-2">
                        <div class="column-item">
                          <h2 class="c-title square">製品データDL</h2>
                          <div class="dl-data">
                            <dl>
                              <dt>外観図 DL</dt>
                              <dd class="download">
                                <a class="download-icon"
                                  href="{{ $group_lc->hasFile('external_view_pdf') ? $group_lc->fileUrl('external_view_pdf') : ($group_ja->hasFile('external_view_pdf') ? $group_ja->fileUrl('external_view_pdf') : '') }}"
                                  target="_blank" rel="noopener"><img src="{{ asset('/assets/img/common/dl-pdf.png') }}" alt="PDF">
                                </a>
                                <a class="dl-icon"
                                  href="{{ $group_lc->hasFile('external_view_dxf') ? $group_lc->fileUrl('external_view_dxf') : ($group_ja->hasFile('external_view_dxf') ? $group_ja->fileUrl('external_view_dxf') : '') }}"
                                  target="_blank" rel="noopener"><img src="{{ asset('/assets/img/common/dl-dxf.png') }}" alt="DXF">
                                </a>
                              </dd>
                            </dl>
                            <dl>
                              <dt>3Dモデル DL</dt>
                              <dd class="download">
                                <a class="download-icon"
                                  href="{{ $group->hasFile('3d_model_step') ? $group->fileUrl('3d_model_step') : '' }}"
                                  target="_blank" rel="noopener"><img src="{{ asset('/assets/img/common/dl-step.png') }}" alt="step">
                                </a>
                              </dd>
                            </dl>
                          </div>
                        </div>
                      </div>
                      <div class="download-note">
                        <div class="download-note__disc">
                          <p class="small">デモ機貸出依頼・会員限定データのダウンロードは、<a class="ud" href="{{ route('signin') }}">会員登録・ログインページ</a>よりログインしていただく必要がございます。</p>
                          <p class="small">本ソフトウェアをダウンロードする前に本使用許諾契約をお読みください 。</p>
                          <p class="small">本ソフトウェアをダウンロードすることにより、お客様は本使用許諾契約に同意したことになります。</p>
                          <p class="small">本使用許諾契約に同意いただけない場合は本ソフトウェアのダウンロードはお控えください。</p>
                        </div>
                        <div class="download-note__terms">
                          <details class="details">
                            <summary class="summary">
                              <span class="summary-title">ソフトウェア使用許諾契約書</span>
                              <div class="summary-inner">
                                <p class="title">ソフトウェア使用許諾契約書</p>
                                <p>本使用許諾契約の定めにご同意いただくことによりダウンロード可能となるソフトウェアおよび全てのデータ（以下総称して「ソフトウェア」という）は、弊社がお客様に無償で使用許諾するものです。
                                  <br>本使用許諾契約は弊社ソフトウェアおよび本使用許諾契約に基づいて作成された複製物に適用されます。
                                </p>
                                <ol>
                                  <li>本ホームページで提供するソフトウェア、それに関連する資料および本使用許諾契約に基づいて作成された複製物の著作権は弊社に帰属します。</li>
                                  <li>本ホームページで提供するソフトウェアを、社内利用の場合を除き、無断複製のうえ第三者へ販売、譲渡または貸与をおこなうことは、かたくお断りします。</li>
                                  <li>ダウンロードされたデータの図面要素から得られる値については、実際の商品と一致することを保証するものではありません。また弊社は、ソフトウェアおよび登録商品の内容、仕様をお客様への事前通告なしに変更できるものとします。また、本ソフトウェアを運用した結果につきましては、お客様の直接的、間接的あるいは波及効果による損害に対して一切の責任を負いません。</li>
                                  <li>本契約は、お客様がソフトウェアのダウンロードを行ったときに発効します。弊社はお客様が本契約に違反した場合、直ちに本契約を解除することができます。本契約が終了した場合には、お客様は本契約に基づき弊社より許諾されている使用権を喪失するとともに、ソフトウェアおよびそのすべての複製物を弊社に返却もしくは消去していただくこととします。</li>
                                </ol>
                              </div>
                            </summary>
                          </details>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>



                @endif

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
                    <a href="{{ route('contact') }}">
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
