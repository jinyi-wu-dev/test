@extends('front/'.app()->getLocale().'/base')


@section('title')
<title>Leimac | {{ $item->model }}</title>
@endsection


@section('main')
    <!-- Site Main-->
    <main class="site-main" id="site-main">
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
      <!-- section-fv-->
      <section class="section section-fv-product-detail
        @if($item->isNew()) is-new @endif
        @if($item->isDiscontinued()) is-discontinued @endif
      ">
        <div class="content row">
          <div class="index-grid">
            <div class="index-thumbnail"><img src="{{ $series->fileUrl('image') }}" alt=""></div>
            <div class="index-data">
              <div class="index-title">
                <span class="index-title-type">
                  {{ $series_lc->name ?  $series_lc->name : $series_ja->name }}
                  {{ $series->genre->label() }}
                </span>
                <span class="index-title-series">{{ $series->model }} <span>series</span>
                </span>
              </div>
              <h2 class="detail-title">{{ $item->model }}</h2>
              <div class="index-textarea">
                <p>
                  {{ $item_lc->description1 ? $item_lc->description1 : $item_ja->description1 }}<br/>
                  {{ $item_lc->description2 ? $item_lc->description2 : $item_ja->description2 }}<br/>
                  {{ $item_lc->description3 ? $item_lc->description3 : $item_ja->description3 }}<br/>
                  {{ $item_lc->description4 ? $item_lc->description4 : $item_ja->description4 }}<br/>
                  {{ $item_lc->description5 ? $item_lc->description5 : $item_ja->description5 }}<br/>
                </p>
              </div>
              <button class="lending-request-button @if(!$item->is_lend) is-disabled @endif"
                @if(!$item->is_lend) disabled @endif
                item_id="{{ $item->id }}"
                item_name1="{{ $series->model }}"
                item_name2="{{ $item->model }}"
                item_url="{{ $series->fileUrl('image') }}"
              >デモ機貸出依頼</button>
            </div>
          </div>
        </div>
      </section>
      <!-- End - section-fv-->
      <!-- article-page-->
      <div class="page-column-wrap">
        <div class="content row">
          <div class="page-column">
            <article class="article page-article article-product-detail">
              <div class="article-block">
                <div class="note">
                  <p class="text-center">
                  <strong>{{ $item->note }}</strong>
                  </p>
                </div>
                <div class="column column-2">
                  <div class="column-item">
                    <h2 class="c-title square">製品仕様</h2>
                    <table class="product-detail-table">
                      <tbody>
                        @if ($series->category==App\Enums\Category::LIGHTING)
                          @include('front/'.app()->getLocale().'/item_spec_lighting')
                        @elseif ($series->category==App\Enums\Category::CONTROLLER)
                          @include('front/'.app()->getLocale().'/item_spec_controller')
                        @elseif ($series->category==App\Enums\Category::OPTION)
                          @include('front/'.app()->getLocale().'/item_spec_option')
                        @endif
                      </tbody>
                    </table>
                    <p class="small">
                      <small>{{ $item->memo }}</small>
                    </p>
                  </div>
                  <div class="column-item">
                    <h2 class="c-title square">3Dビュー</h2>
                    @if($item->hasFile('3d_model_stl'))
                    <div id="canvasBox" data-stl-path="{{ $item->fileUrl('3d_model_stl') }}"></div>
                    @endif
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
                    "{{ $item_lc->hasFile('external_view_pdf') ? $item_lc->fileUrl('external_view_pdf') : ($item_ja->hasFile('external_view_pdf') ? $item_ja->fileUrl('external_view_pdf') : '') }}"
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
                            href="{{ $item_lc->hasFile('external_view_pdf') ? $item_lc->fileUrl('external_view_pdf') : ($item_ja->hasFile('external_view_pdf') ? $item_ja->fileUrl('external_view_pdf') : '') }}"
                            target="_blank" rel="noopener"><img src="{{ asset('/assets/img/common/dl-pdf.png') }}" alt="PDF">
                          </a>
                          <a class="dl-icon"
                            href="{{ $item_lc->hasFile('external_view_dxf') ? $item_lc->fileUrl('external_view_dxf') : ($item_ja->hasFile('external_view_dxf') ? $item_ja->fileUrl('external_view_dxf') : '') }}"
                            target="_blank" rel="noopener"><img src="{{ asset('/assets/img/common/dl-dxf.png') }}" alt="DXF">
                          </a>
                        </dd>
                      </dl>
                      <dl>
                        <dt>3Dモデル DL</dt>
                        <dd class="download">
                          <a class="download-icon"
                            href="{{ $item->hasFile('3d_model_step') ? $item->fileUrl('3d_model_step') : '' }}"
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
              <div class="article-block">
                <h2 class="c-title square border">関連製品</h2>

                @if (count($item->related_controllers))
                  <h3 class="c-title">＜コントローラ＞ <small>出力・容量をお確かめの上ご使用ください</small>
                  </h3>
                  <div class="content-slide">
                    <div class="swiper-container swiper-option">
                      <div class="swiper-wrapper">
                        @foreach ($item->related_controllers as $ct_series)
                          <div class="swiper-slide card">
                            <a href="{{ route('series', $ct_series) }}">
                              <div class="card-img"><img src="{{ $ct_series->fileUrl('image') }}" alt="アイテム"></div>
                              <div class="card-text">
                                <p class="card-text__series">{{ $ct_series->model }} series</p>
                                <p class="card-text__item-name">{{ $ct_series->locale_detail->name }}</p>
                              </div>
                            </a>
                          </div>
                        @endforeach
                      </div>
                      <div class="swiper-scrollbar"></div>
                      <div class="swiper-button-next"></div>
                      <div class="swiper-button-prev"></div>
                    </div>
                  </div>
                  <div class="space-line"></div>
                @endif

                @if (count($item->related_cables))
                  <h3 class="c-title">＜ケーブル＞</h3>
                  <div class="content-slide">
                    <div class="swiper-container swiper-option">
                      <div class="swiper-wrapper">
                        @foreach ($item->related_cables as $cb_series)
                          <div class="swiper-slide card">
                            <a href="{{ route('series', $cb_series) }}">
                              <div class="card-img"><img src="{{ $cb_series->fileUrl('image') }}" alt="アイテム"></div>
                              <div class="card-text">
                                <p class="card-text__series">{{ $cb_series->model }} series</p>
                                <p class="card-text__item-name">{{ $cb_series->locale_detail->name }}</p>
                              </div>
                            </a>
                          </div>
                        @endforeach
                      </div>
                      <div class="swiper-scrollbar"></div>
                      <div class="swiper-button-next"></div>
                      <div class="swiper-button-prev"></div>
                    </div>
                  </div>
                  <div class="space-line"></div>
                @endif 

                @if (count($item->related_options))
                  <h3 class="c-title">＜その他のオプショナルパーツ＞</h3>
                  <div class="content-slide">
                    <div class="swiper-container swiper-option">
                      <div class="swiper-wrapper">
                        @foreach ($item->related_options as $op_series)
                          <div class="swiper-slide card">
                            <a href="{{ route('series', $op_series) }}">
                              <div class="card-img"><img src="{{ $op_series->fileUrl('image') }}" alt="アイテム"></div>
                              <div class="card-text">
                                <p class="card-text__series">{{ $op_series->model }} series</p>
                                <p class="card-text__item-name">{{ $op_series->locale_detail->name }}</p>
                              </div>
                            </a>
                          </div>
                        @endforeach
                        </div>
                      </div>
                      <div class="swiper-scrollbar"></div>
                      <div class="swiper-button-next"></div>
                      <div class="swiper-button-prev"></div>
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
@endsection


@section('footer_script')
  <script type="importmap">
    {
			"imports": {
				"three": "https://cdn.jsdelivr.net/npm/three@0.166.1/build/three.module.js",
				"three/addons/": "https://cdn.jsdelivr.net/npm/three@0.166.1/examples/jsm/"
			}
		}

	</script>
  <script type="module" src="{{ asset('assets/js/main.js') }}"></script>
@endsection
