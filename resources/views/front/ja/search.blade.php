@extends('front/ja/base')

@section('title') Leimac | 検索 @endsection

@section('main')
    <!-- Site Main-->
    <main class="site-main" id="site-main">
      <!-- section-fv-->
      <section class="section section-fv section-fv--search">
        <div class="img"><img src="../assets/img/page/fv-search.png" alt=""></div>
        <div class="section-content">
          <div class="content">
            <div class="section__title">
              <h1 class="ja">製品検索結果</h1>
              <span class="en">SEARCH RESULTS</span>
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
          <button class="aside-show-btn"></button>
          <div class="page-column">
            <article class="article page-article article-search">
              <div class="article-block">
                <div class="search-result">
                  <span>検索結果</span>
                  <span class="search-result-numner">23</span>series／ <span class="search-result-numner">1,254</span>型式
                </div>
                <div class="product-list">
                  @foreach ($list as $series)
                  <div class="product-item @if($series->is_new) new @endif">
                    <a class="product-img" href="{{ route('series', $series) }}"><img src="{{ $series->fileUrl('image') }}" alt=""></a>
                    <div class="product-name">
                      <a href="{{ route('series', $series) }}">
                        <span>{{ $series->locale_detail->name }}
                          <br>{{ $series->genre->label() }}
                        </span>
                        <span class="series">IDBC-LSRC series</span>
                      </a>
                      <button class="view-index-btn hide-small" type="button">
                        <span class="view-index-btn-wrap">型式の一覧を表示する<span class="icon"> </span>
                        </span>
                      </button>
                      <div class="color show-small">
                        <dl>
                          <dt>発光色:</dt>
                          <dd>
                            <span class="white">W</span>
                            <span class="red">R</span>
                            <span class="blue">B</span>
                            <span class="ir">IR</span>
                          </dd>
                        </dl>
                      </div>
                    </div>
                    <div class="product-detail">
                      <div class="text">
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
                      <div class="color hide-small">
                        <dl>
                          <dt>発光色:</dt>
                          <dd>
                            <span class="white">W</span>
                            <span class="red">R</span>
                            <span class="blue">B</span>
                          </dd>
                        </dl>
                      </div>
                    </div>
                    <div class="product-btns">
                      @if($series->hasFile('catalogue'))
                        <div class="product-btn--catalog product-btn--download">
                          <a href="{{ $series->fileUrl('catalogue') }}" target="_blank" rel="noopener">カタログ</a>
                        </div>
                      @endif
                      @if($series->hasFile('manual'))
                        <div class="product-btn--download">
                          <a href="{{ $series->fileUrl('manual') }}" target="_blank" rel="noopener">取扱説明書</a>
                        </div>
                      @endif
                      @if($series->hasFile('pamphlet'))
                        <div class="product-btn--download">
                          <a href="{{ $series->fileUrl('pamphlet') }}" target="_blank" rel="noopener">パンフレット</a>
                        </div>
                      @endif
                    </div>
                    <button class="view-index-btn show-small" type="button">
                      <span class="view-index-btn-wrap">型式の一覧を表示する<span class="icon"> </span>
                      </span>
                    </button>
                    <div class="product-data-index">
                      <div class="series-table-wrap table-wrap has-scroll">
                        <table class="series-table">
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
                                                                              "><a href="{{ route('item', $item) }}">{{ $item->model }}</a></td> @endif
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
                  @endforeach
                </div>
              </div>
            </article>
            <aside class="aside page-aside aside-search">
              <form action="./" method="get" id="searchForm">
                <h2 class="c-title border">製品を絞り込む</h2>
                <div class="aside-section">
                  <div class="aside-reset-btn">
                    <button type="button" id="all-reset">条件をリセット</button>
                  </div>
                </div>
                <div class="aside-section">
                  <div class="aside-search-window">
                    <input type="text" name="s">
                    <button type="submit">
                      <svg id="search_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.69 24.68">
                        <path class="cls-1" d="M24.05,20.97l-5.91-5.91c.96-1.52,1.52-3.31,1.52-5.23C19.66,4.41,15.25,0,9.83,0S0,4.41,0,9.83s4.41,9.83,9.83,9.83c1.92,0,3.72-.56,5.23-1.52l5.91,5.91c.42.42.98.64,1.54.64s1.11-.21,1.54-.64c.85-.85.85-2.23,0-3.07ZM4.35,9.83c0-3.02,2.46-5.48,5.48-5.48s5.48,2.46,5.48,5.48c0,1.48-.59,2.82-1.54,3.8-.02.02-.05.04-.07.06-.02.02-.04.05-.06.07-.99.95-2.33,1.54-3.8,1.54-3.02,0-5.48-2.46-5.48-5.48Z" />
                      </svg>
                    </button>
                  </div>
                </div>
                <div class="aside-section">
                  <label class="checkbox-label">
                    <input type="checkbox" name="">
                    <span></span>生産終了品を結果に含める
                  </label>
                </div>
                <div class="aside-section">
                  <div class="aside-body">
                    <div class="aside-body-inner">
                      <label class="checkbox-label new">
                        <input type="checkbox" name="">
                        <span></span>新製品
                      </label>
                    </div>
                  </div>
                </div>
                <div class="aside-section">
                  <h2 class="aside-head">
                    <button class="aside-head-btn" type="button">照明器具</button>
                  </h2>
                  <div class="aside-body">
                    <div class="aside-body-inner">
                      <div class="aside-body-list">
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="">
                            <span></span>ライン照明
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="">
                            <span></span>リング照明
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="">
                            <span></span>バー照明
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="">
                            <span></span>透過・面照明
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="">
                            <span></span>ドーム照明
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="">
                            <span></span>同軸・スポット照明
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="">
                            <span></span>その他照明
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="">
                            <span></span>物流向け照明
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="">
                            <span></span>提携企業製品
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="aside-body-detail">
                      <h3 class="aside-body-detail-title">照明の詳細条件</h3>
                      <span class="detail-title">発光色</span>
                      <div class="detail-block">
                        <div class="aside-body-list">
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>白
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>青
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>緑
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>黄
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>赤
                            </label>
                          </div>
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>フルカラーRGB
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>7色マルチカラー
                            </label>
                          </div>
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>IR（～1000nm）
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>IR（1000nm～）
                            </label>
                          </div>
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>UV
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>UV（深紫外）
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="aside-body-detail">
                      <span class="detail-title">入力</span>
                      <div class="detail-block">
                        <div class="aside-body-list">
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>DC12V
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>DC24V
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>DC48V
                            </label>
                          </div>
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>350mA
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>700mA
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>1000mA
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="aside-body-detail">
                      <span class="detail-title">消費電力</span>
                      <div class="detail-block">
                        <div class="input-text-wrap">
                          <div class="input-text">
                            <input type="text" name="">
                            <span>W以上～</span>
                          </div>
                          <div class="input-text">
                            <input type="text" name="">
                            <span>W以下</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="aside-body-detail">
                      <span class="detail-title">器具重量</span>
                      <div class="detail-block">
                        <div class="input-text-wrap">
                          <div class="input-text">
                            <input type="text" name="">
                            <span>ｇ以上～</span>
                          </div>
                          <div class="input-text">
                            <input type="text" name="">
                            <span>ｇ以下</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="aside-section">
                  <h2 class="aside-head">
                    <button class="aside-head-btn" type="button">コントローラ</button>
                  </h2>
                  <div class="aside-body">
                    <div class="aside-body-inner">
                      <div class="aside-body-list">
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="">
                            <span></span>AC入力コントローラ
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="">
                            <span></span>DC入力コントローラ
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="">
                            <span></span>PoE入力コントローラ
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="">
                            <span></span>専用/特殊コントローラ
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="aside-body-detail">
                      <h3 class="aside-body-detail-title">コントローラの詳細条件</h3>
                      <span class="detail-title">調光制御方式</span>
                      <div class="detail-block">
                        <div class="aside-body-list">
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>PWM方式
                            </label>
                          </div>
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>電流可変方式
                            </label>
                          </div>
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>電圧可変方式
                            </label>
                          </div>
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>オーバードライブ
                            </label>
                          </div>
                        </div>
                      </div>
                      <span class="detail-title">出力</span>
                      <div class="detail-block">
                        <div class="aside-body-list">
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>DC12V
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>DC24V
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>DC48V
                            </label>
                          </div>
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>350mA
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>700mA
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>1000mA
                            </label>
                          </div>
                        </div>
                      </div>
                      <span class="detail-title">外部出力制御</span>
                      <div class="detail-block">
                        <div class="aside-body-list">
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>外部ON/OFF制御
                            </label>
                          </div>
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="">
                              <span></span>外部調光制御
                            </label>
                            <div class="aside-body-list">
                              <div class="aside-body-item">
                                <label class="checkbox-label">
                                  <input type="checkbox" name="">
                                  <span></span>LAN通信
                                </label>
                                <label class="checkbox-label">
                                  <input type="checkbox" name="">
                                  <span></span>RS-232C通信
                                </label>
                                <label class="checkbox-label">
                                  <input type="checkbox" name="">
                                  <span></span>8bitパラレル通信
                                </label>
                                <label class="checkbox-label">
                                  <input type="checkbox" name="">
                                  <span></span>10bitパラレル通信
                                </label>
                                <label class="checkbox-label">
                                  <input type="checkbox" name="">
                                  <span></span>アナログ0～5V
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <span class="detail-title">出力CH数</span>
                      <div class="detail-block">
                        <div class="input-text-wrap">
                          <div class="input-text">
                            <input type="text" name="">
                            <span>CH以上</span>
                          </div>
                        </div>
                      </div>
                      <span class="detail-title">合計容量</span>
                      <div class="detail-block">
                        <div class="input-text-wrap">
                          <div class="input-text">
                            <input type="text" name="">
                            <span>W以上～</span>
                          </div>
                          <div class="input-text">
                            <input type="text" name="">
                            <span>W以下</span>
                          </div>
                        </div>
                      </div>
                      <span class="detail-title">器具重量</span>
                      <div class="detail-block">
                        <div class="input-text-wrap">
                          <div class="input-text">
                            <input type="text" name="">
                            <span>ｇ以上～</span>
                          </div>
                          <div class="input-text">
                            <input type="text" name="">
                            <span>ｇ以下</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="aside-section">
                  <h2 class="aside-head">
                    <button class="aside-head-btn" type="button">オプショナルパーツ</button>
                  </h2>
                  <div class="aside-body">
                    <div class="aside-body-inner">
                      <div class="aside-body-list">
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="">
                            <span></span>照明用ケーブル
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="">
                            <span></span>外部制御用ケーブル
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="">
                            <span></span>照明オプション
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="">
                            <span></span>その他オプション
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="aside-search-submit btn--slide">
                  <button class="aside-search-submit-btn" type="submit">この条件で製品を検索</button>
                </div>
              </form>
            </aside>
          </div>
        </div>
      </div>
      <!-- End - article-page-->
    </main>
    <!-- End Site Main-->
@endsection
