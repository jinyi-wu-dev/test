@extends('front/ja/base')


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
      <section class="section section-fv-product-detail is-new">
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
              <h2 class="detail-title">{{ $item->model }}</h2>
              <div class="index-textarea">
                <p>
                  {{ $item->locale_lighting_item->description1 }}<br/>
                  {{ $item->locale_lighting_item->description2 }}<br/>
                  {{ $item->locale_lighting_item->description3 }}<br/>
                  {{ $item->locale_lighting_item->description4 }}<br/>
                  {{ $item->locale_lighting_item->description5 }}<br/>
                </p>
              </div>
              <button class="lending-request-button @if(!$item->is_lend) is-disabled @endif"
                @if(!$item->is_lend) disabled @endif
                item_id="{{ $item->id }}"
                item_name1="{{ $item->model }}"
                item_name2="{{ $item->model }}"
                item_url="{{ $item->series->fileUrl('image') }}"
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
                    <strong>発光色：赤色(B) 2025年3月31日生産終了予定 ▶ 後継機：赤色(DB)</strong>
                  </p>
                </div>
                <div class="column column-2">
                  <div class="column-item">
                    <h2 class="c-title square">製品仕様</h2>
                    <table class="product-detail-table">
                      <tbody>
                        <tr>
                          <th>タイプ</th>
                          <td>{{ $item->locale_lighting_item->type }}</td>
                        </tr>
                        <tr>
                          <th>型　式</th>
                          <td>{{ $item->model }}</td>
                        </tr>
                        <tr>
                          <th>品　番</th>
                          <td>{{ $item->product_number }}</td>
                        </tr>
                        <tr>
                          <th>発光色</th>
                          <td>{{ $item->locale_lighting_item->color1 }}</td>
                        </tr>
                        <tr>
                          <th>消費電力</th>
                          <td>{{ $item->locale_lighting_item->power_consumption }}</td>
                        </tr>
                        <tr>
                          <th>CH数</th>
                          <td>{{ $item->locale_lighting_item->num_of_ch }}</td>
                        </tr>
                        <tr>
                          <th>入 力</th>
                          <td>{{ $item->locale_lighting_item->input }}</td>
                        </tr>
                        <tr>
                          <th>使用温度</th>
                          <td>{{ $item->operating_temperature }}</td>
                        </tr>
                        <tr>
                          <th>使用湿度</th>
                          <td>{{ $item->operating_humidity }}</td>
                        </tr>
                        <tr>
                          <th>器具重量</th>
                          <td>{{ $item->weight }}</td>
                        </tr>
                        <tr>
                          <th>適合規格</th>
                          <td>
                            @if ($item->is_RoHS)
                              RoHS<br/>
                            @elseif ($item->is_RoHS2)
                              RoHS2<br/>
                            @endif
                            @if ($item->is_CN_RoHSe1)
                              中国RoHS e-1<br/>
                            @elseif ($item->is_CN_RoHS102)
                              中国RoHS 10-2<br/>
                            @endif
                            @if ($item->is_CE_IEC)
                              CE(IEC62471)<br/>
                            @elseif ($item->is_CE_IEC)
                              CE(EN55011, EN61000-6-2)<br/>
                            @endif
                            @if ($item->is_UKCA)
                              UKCA<br/>
                            @endif
                            @if ($item->is_PSE)
                              PSE<br/>
                            @endif
                          </td>
                        </tr>
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
                <script>
                  const url = '{{ $item->locale_lighting_item->fileUrl('external_view_pdf') }}';
                  const pageNumber = 1;



                  let pdfDoc = null;
                  let currentScale = 1.5;
                  const canvas = document.getElementById('pdf-canvas');
                  const context = canvas.getContext('2d');
                  const container = document.querySelector('.canvas-container');

                  let fixedContainerHeight = null;
                  let renderTask = null;

                  let isDragging = false;
                  let dragStartX, dragStartY;
                  let translateX = 0,
                    translateY = 0;

                  function updateTransform() {
                    canvas.style.transform = `translate(calc(-50% + ${translateX}px), calc(-50% + ${translateY}px)) scale(1)`;
                  }

                  const renderPage = (scale) => {
                    pdfDoc.getPage(pageNumber).then(page => {
                      const viewport = page.getViewport({
                        scale
                      });

                      canvas.height = viewport.height;
                      canvas.width = viewport.width;

                      if (fixedContainerHeight === null) {
                        fixedContainerHeight = viewport.height;
                        container.style.height = fixedContainerHeight + 'px';
                      }

                      const renderContext = {
                        canvasContext: context,
                        viewport: viewport
                      };

                      // 前の描画が進行中ならキャンセル
                      if (renderTask) {
                        renderTask.cancel();
                      }

                      renderTask = page.render(renderContext);

                      renderTask.promise.then(() => {
                        renderTask = null; // 完了後にnullクリア
                      }).catch((error) => {
                        if (error?.name === 'RenderingCancelledException') {
                          // キャンセルされた場合は無視
                          return;
                        }
                        console.error('Render error:', error);
                      });
                    });
                  };


                  pdfjsLib.getDocument(url).promise.then(pdf => {
                    pdfDoc = pdf;
                    pdf.getPage(pageNumber).then(page => {
                      const containerWidth = container.clientWidth;
                      const viewport = page.getViewport({
                        scale: 1
                      });
                      currentScale = containerWidth / viewport.width;
                      renderPage(currentScale);
                    });
                  });

                  function zoomIn() {
                    currentScale = Math.min(currentScale + 0.2, 5);
                    renderPage(currentScale);
                  }

                  function zoomOut() {
                    currentScale = Math.max(currentScale - 0.2, 0.2);
                    renderPage(currentScale);
                  }

                  function toggleFullscreen() {
                    const elem = document.querySelector('.canvas-container');

                    if (!document.fullscreenElement) {
                      if (elem.requestFullscreen) {
                        elem.requestFullscreen();
                      } else if (elem.webkitRequestFullscreen) {
                        elem.webkitRequestFullscreen();
                      } else if (elem.msRequestFullscreen) {
                        elem.msRequestFullscreen();
                      }
                    } else {
                      if (document.exitFullscreen) {
                        document.exitFullscreen();
                      } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen();
                      } else if (document.msExitFullscreen) {
                        document.msExitFullscreen();
                      }
                    }
                  }

                  canvas.addEventListener('mousedown', e => {
                    isDragging = true;
                    dragStartX = e.clientX - translateX;
                    dragStartY = e.clientY - translateY;
                    canvas.style.cursor = 'grabbing';
                  });

                  window.addEventListener('mouseup', () => {
                    isDragging = false;
                    canvas.style.cursor = 'grab';
                  });

                  window.addEventListener('mousemove', e => {
                    if (!isDragging) return;
                    translateX = e.clientX - dragStartX;
                    translateY = e.clientY - dragStartY;
                    updateTransform();
                  });

                  canvas.addEventListener('touchstart', e => {
                    if (e.touches.length === 1) {
                      isDragging = true;
                      dragStartX = e.touches[0].clientX - translateX;
                      dragStartY = e.touches[0].clientY - translateY;
                    }
                  });

                  window.addEventListener('touchend', () => {
                    isDragging = false;
                  });

                  window.addEventListener('touchmove', e => {
                    if (!isDragging || e.touches.length !== 1) return;
                    translateX = e.touches[0].clientX - dragStartX;
                    translateY = e.touches[0].clientY - dragStartY;
                    updateTransform();
                    e.preventDefault();
                  }, {
                    passive: false
                  });


                  let initialPinchDistance = null;
                  let initialScale = currentScale;

                  canvas.addEventListener('touchstart', e => {
                    if (e.touches.length === 2) {
                      const dx = e.touches[0].clientX - e.touches[1].clientX;
                      const dy = e.touches[0].clientY - e.touches[1].clientY;
                      initialPinchDistance = Math.hypot(dx, dy);
                      initialScale = currentScale;
                    }
                  }, {
                    passive: false
                  });

                  canvas.addEventListener('touchmove', e => {
                    if (e.touches.length === 2 && initialPinchDistance) {
                      e.preventDefault();

                      const dx = e.touches[0].clientX - e.touches[1].clientX;
                      const dy = e.touches[0].clientY - e.touches[1].clientY;
                      const currentDistance = Math.hypot(dx, dy);
                      const scaleRatio = currentDistance / initialPinchDistance;
                      currentScale = Math.min(Math.max(initialScale * scaleRatio, 0.2), 5); // 限界チェック

                      renderPage(currentScale);
                    }
                  }, {
                    passive: false
                  });

                  canvas.addEventListener('touchend', e => {
                    if (e.touches.length < 2) {
                      initialPinchDistance = null;
                    }
                  });




                  container.addEventListener('wheel', (event) => {
                    event.preventDefault();
                    const delta = event.deltaY;
                    if (delta < 0) {
                      currentScale = Math.min(currentScale + 0.1, 5);
                    } else {
                      currentScale = Math.max(currentScale - 0.1, 0.2);
                    }
                    renderPage(currentScale);
                  });
                </script>




                <div class="column column-2">
                  <div class="column-item">
                    <h2 class="c-title square">製品データDL</h2>
                    <div class="dl-data">
                      <dl>
                        <dt>外観図 DL</dt>
                        <dd class="download">
                          <a class="download-icon" href="{{ $item->locale_lighting_item->fileUrl('external_view_pdf') }}" target="_blank" rel="noopener"><img src="{{ asset('/assets/img/common/dl-pdf.png') }}" alt="PDF"></a>
                          <a class="dl-icon" href="{{ $item->locale_lighting_item->fileUrl('external_view_dxf') }}" target="_blank" rel="noopener"><img src="{{ asset('/assets/img/common/dl-dxf.png') }}" alt="DXF"></a>
                        </dd>
                      </dl>
                      <dl>
                        <dt>3Dモデル DL</dt>
                        <dd class="download">
                          <a class="download-icon" href="{{ $item->locale_lighting_item->fileUrl('3d_model_step') }}" target="_blank" rel="noopener"><img src="{{ asset('/assets/img/common/dl-step.png') }}" alt="step"></a>
                        </dd>
                      </dl>
                    </div>
                  </div>
                </div>
                <div class="download-note">
                  <div class="download-note__disc">
                    <p class="small">デモ機貸出依頼・会員限定データのダウンロードは、<a class="ud" href="../../login">会員登録・ログインページ</a>よりログインしていただく必要がございます。</p>
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
                    <a href="../../mail">
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
