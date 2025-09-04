@extends('front/'.app()->getLocale().'/base')

@section('title')
  <title>Leimac | 検索</title>
@endsection

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
                  <span class="search-result-numner">{{ number_format($num_of_series) }}</span>series／ <span class="search-result-numner">{{ number_format($num_of_items) }}</span>型式
                </div>
                <div class="product-list">
                  @foreach ($list as $series_id => $item_ids)
                  @php
                    $series = App\Models\Series::find($series_id);
                  @endphp
                  <div class="product-item @if($series->is_new) new @endif is-discontinued">
                    <a class="product-img" href="{{ route('series', $series) }}"><img src="{{ $series->fileUrl('image') }}" alt=""></a>
                    <div class="product-name">
                      <a href="{{ route('series', $series) }}">
                        <span>{{ $series->locale_detail->name }}
                          <br>{{ $series->genre->label() }}
                        </span>
                        <span class="series">{{ $series->model }} series</span>
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
                            @foreach ($item_ids as $item_id)
                              @php
                                $item = App\Models\Item::find($item_id);
                              @endphp
                              @if ($item->is_publish)
                                <tr>
                                  @if ($series->show_type)                      <td>{{ $item->type }}</td> @endif
                                  @if ($series->show_model)                     <td class="format
                                                                                  @if($series->is_new || $item->is_new) is-new @endif
                                                                                  @if($series->is_end || $item->is_end) is-discontinued @endif
                                                                                "><a href="{{ route('item', $item) }}" target="_blank">{{ $item->model }}</a> </td> @endif
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
                                    <button class="lending-request-button @if(!$item->isLending()) is-disabled @endif"
                                      @if(!$item->isLending()) disabled @endif
                                      item_id="{{ $item->id }}"
                                      item_name1="{{ $series->model }}"
                                      item_name2="{{ $item->model }}"
                                      item_url="{{ $series->fileUrl('image') }}"
                                    >貸出依頼</button>
                                  </td>
                                </tr>
                              @endif
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
              <form action="{{ route('search') }}" method="get" id="searchForm">
                <h2 class="c-title border">製品を絞り込む</h2>
                <div class="aside-section">
                  <div class="aside-reset-btn">
                    <button type="button" id="all-reset">条件をリセット</button>
                  </div>
                </div>
                <div class="aside-section">
                  <div class="aside-search-window">
                    <input type="text" name="keywords" value="{{ request('keywords') }}">
                    <button type="submit">
                      <svg id="search_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.69 24.68">
                        <path class="cls-1" d="M24.05,20.97l-5.91-5.91c.96-1.52,1.52-3.31,1.52-5.23C19.66,4.41,15.25,0,9.83,0S0,4.41,0,9.83s4.41,9.83,9.83,9.83c1.92,0,3.72-.56,5.23-1.52l5.91,5.91c.42.42.98.64,1.54.64s1.11-.21,1.54-.64c.85-.85.85-2.23,0-3.07ZM4.35,9.83c0-3.02,2.46-5.48,5.48-5.48s5.48,2.46,5.48,5.48c0,1.48-.59,2.82-1.54,3.8-.02.02-.05.04-.07.06-.02.02-.04.05-.06.07-.99.95-2.33,1.54-3.8,1.54-3.02,0-5.48-2.46-5.48-5.48Z" />
                      </svg>
                    </button>
                  </div>
                </div>
                <div class="aside-section">
                  <label class="checkbox-label">
                    <input type="checkbox" name="include_end" value="1" @if(request('include_end')) checked @endif>
                    <span class="checkbox-text"></span>生産終了品を結果に含める
                  </label>
                </div>
                <div class="aside-section">
                  <div class="aside-body">
                    <div class="aside-body-inner">
                      <label class="checkbox-label new">
                        <input type="checkbox" name="only_end" value="1" @if(request('only_end')) checked @endif>
                        <span class="checkbox-text"></span>生産終了品
                      </label>
                    </div>
                  </div>
                  <div class="aside-body">
                    <div class="aside-body-inner">
                      <label class="checkbox-label new">
                        <input type="checkbox" name="only_new" value="1" @if(request('only_new')) checked @endif>
                        <span class="checkbox-text"></span>新製品
                      </label>
                    </div>
                  </div>
                </div>
                <div class="aside-section">
                  <h2 class="aside-head">
                    <button class="aside-head-btn is-active" type="button">照明器具</button>
                  </h2>
                  <div class="aside-body" style="display:block">
                    <div class="aside-body-inner">
                      <div class="aside-body-list">
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="genres[]"
                              value="{{ App\Enums\Genre::LT_LINE->value }}"
                              @if(in_array(App\Enums\Genre::LT_LINE->value, request('genres')??[])) checked @endif
                            >
                            <span class="checkbox-text"></span>ライン照明
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="genres[]"
                              value="{{ App\Enums\Genre::LT_RING->value }}"
                              @if(in_array(App\Enums\Genre::LT_RING->value, request('genres')??[])) checked @endif
                            >
                            <span class="checkbox-text"></span>リング照明
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="genres[]"
                              value="{{ App\Enums\Genre::LT_TRANSMISSION->value }}"
                              @if(in_array(App\Enums\Genre::LT_TRANSMISSION->value, request('genres')??[])) checked @endif
                            >
                            <span class="checkbox-text"></span>バー照明
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="genres[]"
                              value="{{ App\Enums\Genre::LT_FLATSURFACE->value }}"
                              @if(in_array(App\Enums\Genre::LT_FLATSURFACE->value, request('genres')??[])) checked @endif
                            >
                            <span class="checkbox-text"></span>透過・面照明
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="genres[]"
                              value="{{ App\Enums\Genre::LT_DOME->value }}"
                              @if(in_array(App\Enums\Genre::LT_DOME->value, request('genres')??[])) checked @endif
                            >
                            <span class="checkbox-text"></span>ドーム照明
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="genres[]"
                              value="{{ App\Enums\Genre::LT_COAXIAL_SPOT->value }}"
                              @if(in_array(App\Enums\Genre::LT_COAXIAL_SPOT->value, request('genres')??[])) checked @endif
                            >
                            <span class="checkbox-text"></span>同軸・スポット照明
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="genres[]"
                              value="{{ App\Enums\Genre::LT_OTHER->value }}"
                              @if(in_array(App\Enums\Genre::LT_OTHER->value, request('genres')??[])) checked @endif
                            >
                            <span class="checkbox-text"></span>その他照明
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
                              <input type="checkbox" name="lighting_colors[]"
                                value="{{ App\Enums\Color::WHITE->value }}"
                                @if(in_array(App\Enums\Color::WHITE->value, request('lighting_colors')??[])) checked @endif
                              >
                              <span class="checkbox-text"></span>白
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="lighting_colors[]"
                                value="{{ App\Enums\Color::BLUE->value }}"
                                @if(in_array(App\Enums\Color::BLUE->value, request('lighting_colors')??[])) checked @endif
                              >
                              <span class="checkbox-text"></span>青
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="lighting_colors[]"
                                value="{{ App\Enums\Color::GREEN->value }}"
                                @if(in_array(App\Enums\Color::GREEN->value, request('lighting_colors')??[])) checked @endif
                              >
                              <span class="checkbox-text"></span>緑
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="lighting_colors[]"
                                value="{{ App\Enums\Color::YELLOW->value }}"
                                @if(in_array(App\Enums\Color::YELLOW->value, request('lighting_colors')??[])) checked @endif
                              >
                              <span class="checkbox-text"></span>黄
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="lighting_colors[]"
                                value="{{ App\Enums\Color::RED->value }}"
                                @if(in_array(App\Enums\Color::RED->value, request('lighting_colors')??[])) checked @endif
                              >
                              <span class="checkbox-text"></span>赤
                            </label>
                          </div>
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="lighting_colors[]"
                                value="{{ App\Enums\Color::FULL_COLOR }}"
                                @if(in_array(App\Enums\Color::FULL_COLOR->value, request('lighting_colors')??[])) checked @endif
                              >
                              <span class="checkbox-text"></span>フルカラーRGB
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="lighting_colors[]"
                                value="{{ App\Enums\Color::MULTI_COLOR->value }}"
                                @if(in_array(App\Enums\Color::MULTI_COLOR->value, request('lighting_colors')??[])) checked @endif
                              >
                              <span class="checkbox-text"></span>7色マルチカラー
                            </label>
                          </div>
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="lighting_colors[]"
                                value="{{ App\Enums\Color::IR_UNDER_1000->value }}"
                                @if(in_array(App\Enums\Color::IR_UNDER_1000->value, request('lighting_colors')??[])) checked @endif
                              >
                              <span class="checkbox-text"></span>IR（～1000nm）
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="lighting_colors[]"
                                value="{{ App\Enums\Color::IR_OVER_1000->value }}"
                                @if(in_array(App\Enums\Color::IR_OVER_1000->value, request('lighting_colors')??[])) checked @endif
                              >
                              <span class="checkbox-text"></span>IR（1000nm～）
                            </label>
                          </div>
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="lighting_colors[]"
                                value="{{ App\Enums\Color::UV_UNDER_280->value }}"
                                @if(in_array(App\Enums\Color::UV_UNDER_280->value, request('lighting_colors')??[])) checked @endif
                              >
                              <span class="checkbox-text"></span>UV
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="lighting_colors[]"
                                value="{{ App\Enums\Color::UV_OVER_280->value }}"
                                @if(in_array(App\Enums\Color::UV_OVER_280->value, request('lighting_colors')??[])) checked @endif
                              >
                              <span class="checkbox-text"></span>UV（深紫外）
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
                              <input type="checkbox" name="lighting_inputs[]" value="dc12v" @if(in_array('dc12v', request('lighting_inputs')??[])) checked @endif>
                              <span class="checkbox-text"></span>DC12V
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="lighting_inputs[]" value="dc24v" @if(in_array('dc24v', request('lighting_inputs')??[])) checked @endif>
                              <span class="checkbox-text"></span>DC24V
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="lighting_inputs[]" value="dc48v" @if(in_array('dc48v', request('lighting_inputs')??[])) checked @endif>
                              <span class="checkbox-text"></span>DC48V
                            </label>
                          </div>
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="lighting_inputs[]" value="350ma" @if(in_array('350ma', request('lighting_inputs')??[])) checked @endif>
                              <span class="checkbox-text"></span>350mA
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="lighting_inputs[]" value="700ma" @if(in_array('700ma', request('lighting_inputs')??[])) checked @endif>
                              <span class="checkbox-text"></span>700mA
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="lighting_inputs[]" value="1000ma" @if(in_array('1000ma', request('lighting_inputs')??[])) checked @endif>
                              <span class="checkbox-text"></span>1000mA
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
                            <input type="text" name="lighting_pc_min" value="{{ request('lighting_pc_min') }}">
                            <span class="checkbox-text">W以上～</span>
                          </div>
                          <div class="input-text">
                            <input type="text" name="lighting_pc_max" value="{{ request('lighting_pc_max') }}">
                            <span class="checkbox-text">W以下</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="aside-body-detail">
                      <span class="detail-title">器具重量</span>
                      <div class="detail-block">
                        <div class="input-text-wrap">
                          <div class="input-text">
                            <input type="text" name="lighting_weight_min" value="{{ request('lighting_weight_min') }}">
                            <span class="checkbox-text">ｇ以上～</span>
                          </div>
                          <div class="input-text">
                            <input type="text" name="lighting_weight_max" value="{{ request('lighting_weight_max') }}">
                            <span class="checkbox-text">ｇ以下</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="aside-body-detail">
                      <span class="detail-title">その他</span>
                      <div class="detail-block">
                        <div class="aside-body-list">
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="lighting_logistics"
                                value="1"
                                @if(request('lighting_logistics')) checked @endif
                              >
                              <span class="checkbox-text"></span>物流向け照明
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="lighting_partner"
                                value="1"
                                @if(request('lighting_partner')) checked @endif
                              >
                              <span class="checkbox-text"></span>提携企業製品
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="aside-section">
                  <h2 class="aside-head">
                    <button class="aside-head-btn is-active" type="button">コントローラ</button>
                  </h2>
                  <div class="aside-body" style="display:block">
                    <div class="aside-body-inner">
                      <div class="aside-body-list">
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="genres[]"
                              value="{{ App\Enums\Genre::CR_AC_INPUT->value }}"
                              @if(in_array(App\Enums\Genre::CR_AC_INPUT->value, request('genres')??[])) checked @endif
                            >
                            <span class="checkbox-text"></span>AC入力コントローラ
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="genres[]"
                              value="{{ App\Enums\Genre::CR_DC_INPUT->value }}"
                              @if(in_array(App\Enums\Genre::CR_DC_INPUT->value, request('genres')??[])) checked @endif
                            >
                            <span class="checkbox-text"></span>DC入力コントローラ
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="genres[]"
                              value="{{ App\Enums\Genre::CR_PoE_INPUT->value }}"
                              @if(in_array(App\Enums\Genre::CR_PoE_INPUT->value, request('genres')??[])) checked @endif
                            >
                            <span class="checkbox-text"></span>PoE入力コントローラ
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="genres[]"
                              value="{{ App\Enums\Genre::CR_EX_AND_SP->value }}"
                              @if(in_array(App\Enums\Genre::CR_EX_AND_SP->value, request('genres')??[])) checked @endif
                            >
                            <span class="checkbox-text"></span>専用/特殊コントローラ
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
                              <input type="checkbox" name="controller_controls[]"
                                value="{{ App\Enums\DimmableControl::PWM->value }}"
                                @if(in_array(App\Enums\DimmableControl::PWM->value, request('controller_controls')??[])) checked @endif
                              >
                              <span class="checkbox-text"></span>PWM方式
                            </label>
                          </div>
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="controller_controls[]"
                                value="{{ App\Enums\DimmableControl::VARIABLE_CURRENT->value }}"
                                @if(in_array(App\Enums\DimmableControl::VARIABLE_CURRENT->value, request('controller_controls')??[])) checked @endif
                              >
                              <span class="checkbox-text"></span>電流可変方式
                            </label>
                          </div>
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="controller_controls[]"
                                value="{{ App\Enums\DimmableControl::VARIABLE_VOLTAGE->value }}"
                                @if(in_array(App\Enums\DimmableControl::VARIABLE_VOLTAGE->value, request('controller_controls')??[])) checked @endif
                              >
                              <span class="checkbox-text"></span>電圧可変方式
                            </label>
                          </div>
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="controller_controls[]"
                                value="{{ App\Enums\DimmableControl::OVERDRIVE->value }}"
                                @if(in_array(App\Enums\DimmableControl::OVERDRIVE->value, request('controller_controls')??[])) checked @endif
                              >
                              <span class="checkbox-text"></span>オーバードライブ
                            </label>
                          </div>
                        </div>
                      </div>
                      <span class="detail-title">出力</span>
                      <div class="detail-block">
                        <div class="aside-body-list">
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="controller_inputs[]" value="dc12v" @if(in_array('dc12v', request('controller_inputs')??[])) checked @endif>
                              <span class="checkbox-text"></span>DC12V
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="controller_inputs[]" value="dc24v" @if(in_array('dc24v', request('controller_inputs')??[])) checked @endif>
                              <span class="checkbox-text"></span>DC24V
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="controller_inputs[]" value="dc48v" @if(in_array('dc48v', request('controller_inputs')??[])) checked @endif>
                              <span class="checkbox-text"></span>DC48V
                            </label>
                          </div>
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="controller_inputs[]" value="350ma" @if(in_array('350ma', request('controller_inputs')??[])) checked @endif>
                              <span class="checkbox-text"></span>350mA
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="controller_inputs[]" value="700ma" @if(in_array('700ma', request('controller_inputs')??[])) checked @endif>
                              <span class="checkbox-text"></span>700mA
                            </label>
                            <label class="checkbox-label">
                              <input type="checkbox" name="controller_inputs[]" value="1000ma" @if(in_array('1000ma', request('controller_inputs')??[])) checked @endif>
                              <span class="checkbox-text"></span>1000mA
                            </label>
                          </div>
                        </div>
                      </div>
                      <span class="detail-title">外部出力制御</span>
                      <div class="detail-block">
                        <div class="aside-body-list">
                          <div class="aside-body-item">
                            <label class="checkbox-label">
                              <input type="checkbox" name="controller_external_switch" value="1" @if(request('controller_external_switch')) checked @endif>
                              <span class="checkbox-text"></span>外部ON/OFF制御
                            </label checkbox>
                          </div>
                          <div class="aside-body-item">
                              <span class="checkbox-text"></span>外部調光制御
                            <div class="aside-body-list">
                              <div class="aside-body-item">
                                <label class="checkbox-label">
                                  <input type="checkbox" name="controller_ethernet" value="1" @if(request('controller_ethernet')) checked @endif>
                                  <span class="checkbox-text"></span>LAN通信
                                </label>
                                <label class="checkbox-label">
                                  <input type="checkbox" name="controller_rs232c" value="1" @if(request('controller_rs232c')) checked @endif>
                                  <span class="checkbox-text"></span>RS-232C通信
                                </label>
                                <label class="checkbox-label">
                                  <input type="checkbox" name="controller_8bit" value="1" @if(request('controller_8bit')) checked @endif>
                                  <span class="checkbox-text"></span>8bitパラレル通信
                                </label>
                                <label class="checkbox-label">
                                  <input type="checkbox" name="controller_10bit" value="1" @if(request('controller_10bit')) checked @endif>
                                  <span class="checkbox-text"></span>10bitパラレル通信
                                </label>
                                <label class="checkbox-label">
                                  <input type="checkbox" name="controller_analog" value="1" @if(request('controller_analog')) checked @endif>
                                  <span class="checkbox-text"></span>アナログ0～5V
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
                            <input type="text" name="controller_ch" value="{{ request('controller_ch') }}">
                            <span class="checkbox-text">CH以上</span>
                          </div>
                        </div>
                      </div>
                      <span class="detail-title">合計容量</span>
                      <div class="detail-block">
                        <div class="input-text-wrap">
                          <div class="input-text">
                            <input type="text" name="controller_capacity_min" value="{{ request('controller_capacity_min') }}">
                            <span class="checkbox-text">W以上～</span>
                          </div>
                          <div class="input-text">
                            <input type="text" name="controller_capacity_max" value="{{ request('controller_capacity_max') }}">
                            <span class="checkbox-text">W以下</span>
                          </div>
                        </div>
                      </div>
                      <span class="detail-title">器具重量</span>
                      <div class="detail-block">
                        <div class="input-text-wrap">
                          <div class="input-text">
                            <input type="text" name="controller_weight_min" value="{{ request('controller_weight_min') }}">
                            <span class="checkbox-text">ｇ以上～</span>
                          </div>
                          <div class="input-text">
                            <input type="text" name="controller_weight_max" value="{{ request('controller_weight_max') }}">
                            <span class="checkbox-text">ｇ以下</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="aside-section">
                  <h2 class="aside-head">
                    <button class="aside-head-btn is-active" type="button">オプショナルパーツ</button>
                  </h2>
                  <div class="aside-body" style="display:block">
                    <div class="aside-body-inner">
                      <div class="aside-body-list">
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="genres[]"
                              value="{{ App\Enums\Genre::CB_LIGHTING->value }}"
                              @if(in_array(App\Enums\Genre::CB_LIGHTING->value, request('genres')??[])) checked @endif
                            >
                            <span class="checkbox-text"></span>照明用ケーブル
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="genres[]"
                              value="{{ App\Enums\Genre::CB_EXTERNAL->value }}"
                              @if(in_array(App\Enums\Genre::CB_EXTERNAL->value, request('genres')??[])) checked @endif
                            >
                            <span class="checkbox-text"></span>外部制御用ケーブル
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="genres[]"
                              value="{{ App\Enums\Genre::OP_LIGHTING->value }}"
                              @if(in_array(App\Enums\Genre::OP_LIGHTING->value, request('genres')??[])) checked @endif
                            >
                            <span class="checkbox-text"></span>照明オプション
                          </label>
                        </div>
                        <div class="aside-body-item">
                          <label class="checkbox-label">
                            <input type="checkbox" name="genres[]"
                              value="{{ App\Enums\Genre::OP_OTHER->value }}"
                              @if(in_array(App\Enums\Genre::OP_OTHER->value, request('genres')??[])) checked @endif
                            >
                            <span class="checkbox-text"></span>その他オプション
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
