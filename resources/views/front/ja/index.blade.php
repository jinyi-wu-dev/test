@extends('front/ja/base')


@section('title')
  <title>Leimac</title>
@endsection


@section('body_class')
  page--top
@endsection


@section('main')
    <main class="site-main" id="site-main">
      <div class="page">
        <div class="fv">
          <div class="fv-img"><img src="{{ asset('/assets/img/top/top-fv.jpg') }}" alt=""></div>
          <div class="fv-img-hv"><img src="{{ asset('/assets/img/top/top-fv-hv.jpg') }}" alt=""></div>
          <div class="fv-img-text"><img src="{{ asset('/assets/img/top/top-fv-text.png') }}" alt=""></div>
        </div>

        <!-- section-news-->
        <section class="section section-news">
          <div class="section-content">
            <div class="content row w1360">
              <h2 class="headline-title--2">
                <span>
                  <span class="text">NEWS</span>
                  <span class="bg"></span>
                </span>
              </h2>
              <ul class="news-list--top">
                @foreach($news as $n)
                  <li class="news-list--top__item">
                    <div class="meta">
                      <time datetime="0000-00-00">{{ date('Y年m月d日', strtotime($n->post_date)) }}</time>
                      <span class="category">{{ $n->name }}</span>
                    </div>
                    <a href="{{ config('system.news.link_url') }}{{ $n->post_name }}" target="_blank" rel="noopener">{{ $n->post_title }}</a>
                  </li>
                @endforeach
              </ul>
              <div class="news-link">
                <a href="{{ route('news') }}">NEWS 一覧へ</a>
              </div>
            </div>
          </div>
        </section>
        <!-- End - section-news-->

        <!-- section-product-->
        <section class="section section-product">
          <div class="section-content">
            <div class="content row">
              <form action="{{ route('search') }}" method="get">
                <div class="product-search">
                  <input type="text" name="keywords" placeholder="キーワード、型式等を入力して製品を検索">
                  <button type="submit"></button>
                  <!-- 	<input type="submit" value="">-->
                </div>
              </form>
              <div class="product-main">
                <div class="product-link">
                  <a href="./">＞＞すべての製品を見る</a>
                </div>
                <h2 class="headline-title--2">
                  <span>
                    <span class="text">PRODUCTS</span>
                    <span class="bg"></span>
                  </span>
                </h2>
                <div class="product-block">
                  <h3 class="headline-title--3">
                    <span>
                      <span class="text">LED LIGHTING</span>
                      <span class="bg"></span>
                    </span>
                  </h3>
                  <div class="product-list">
                    <div class="product-item">
                      <a href="{{ route('search', ['lighting_genres[]' => App\Enums\Genre::LT_LINE]) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product001.jpg') }}" alt="ライン照明">
                          <figcaption>ライン照明</figcaption>
                        </figure>
                      </a>
                    </div>
                    <div class="product-item">
                      <a href="{{ route('search', ['lighting_genres[]' => App\Enums\Genre::LT_RING]) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product002.jpg') }}" alt="リング照明">
                          <figcaption>リング照明</figcaption>
                        </figure>
                      </a>
                    </div>
                    <div class="product-item">
                      <a href="{{ route('search', ['lighting_genres[]' => App\Enums\Genre::LT_TRANSMISSION]) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product003.jpg') }}" alt="バー照明">
                          <figcaption>バー照明</figcaption>
                        </figure>
                      </a>
                    </div>
                    <div class="product-item">
                      <a href="{{ route('search', ['lighting_genres[]' => App\Enums\Genre::LT_FLATSURFACE]) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product004.jpg') }}" alt="透過・面照明">
                          <figcaption>透過・面照明</figcaption>
                        </figure>
                      </a>
                    </div>
                    <div class="product-item">
                      <a href="{{ route('search', ['lighting_genres[]' => App\Enums\Genre::LT_DOME]) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product005.jpg') }}" alt="ドーム照明">
                          <figcaption>ドーム照明</figcaption>
                        </figure>
                      </a>
                    </div>
                    <div class="product-item">
                      <a href="{{ route('search', ['lighting_genres[]' => App\Enums\Genre::LT_COAXIAL_SPOT]) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product006.jpg') }}" alt="同軸・スポット照明">
                          <figcaption>同軸・スポット照明</figcaption>
                        </figure>
                      </a>
                    </div>
                    <div class="product-item">
                      <a href="{{ route('search', ['lighting_genres[]' => App\Enums\Genre::LT_OTHER]) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product007.jpg') }}" alt="その他照明">
                          <figcaption>その他照明</figcaption>
                        </figure>
                      </a>
                    </div>
                    <div class="product-item">
                      <a href="{{ route('search', ['lighting_partner' => '1']) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product008.jpg') }}" alt="提携製品">
                            figcaption>提携製品</figcaption>
                        </figure>
                      </a>
                    </div>
                    <div class="product-item">
                      <a href="{{ route('search', ['lighting_colors' => [App\Enums\Color::IR_UNDER_1000, App\Enums\Color::IR_OVER_1000]]) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product009.jpg') }}" alt="赤外照明">
                          <figcaption>赤外照明</figcaption>
                        </figure>
                      </a>
                    </div>
                    <div class="product-item">
                      <a href="{{ route('search', ['lighting_colors' => [App\Enums\Color::UV_UNDER_280, App\Enums\Color::UV_OVER_280]]) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product010.jpg') }}" alt="紫外照明">
                          <figcaption>紫外照明</figcaption>
                        </figure>
                      </a>
                    </div>
                    <div class="product-item">
                      <a href="{{ route('search', ['lighting_colors' => [App\Enums\Color::FULL_COLOR, App\Enums\Color::MULTI_COLOR]]) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product011.jpg') }}" alt="フルカラー・マルチカラー照明">
                          <figcaption>フルカラー・マルチカラー照明</figcaption>
                        </figure>
                      </a>
                    </div>
                    <div class="product-item">
                      <a href="{{ route('search', ['lighting_logistics' => '1']) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product012.jpg') }}" alt="物流用照明">
                          <figcaption>物流用照明</figcaption>
                        </figure>
                      </a>
                    </div>
                  </div>
                  <div class="index-link">
                    <a href="{{ route('search', ['lighting_genres' => [
                      App\Enums\Genre::LT_LINE->value,
                      App\Enums\Genre::LT_RING->value,
                      App\Enums\Genre::LT_TRANSMISSION->value,
                      App\Enums\Genre::LT_FLATSURFACE->value,
                      App\Enums\Genre::LT_DOME->value,
                      App\Enums\Genre::LT_COAXIAL_SPOT->value,
                      App\Enums\Genre::LT_OTHER->value,
                    ]]) }}">
                      ＞＞すべてのLED照明を見るi
                    </a>
                  </div>
                </div>
                <div class="product-block">
                  <h3 class="headline-title--3">
                    <span>
                      <span class="text">CONTROLLER</span>
                      <span class="bg"></span>
                    </span>
                  </h3>
                  <div class="product-list">
                    <div class="product-item">
                      <a href="{{ route('search', ['controller_genres[]' => App\Enums\Genre::CR_AC_INPUT]) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product013.jpg') }}" alt="AC入力コントローラ">
                          <figcaption>AC入力コントローラ</figcaption>
                        </figure>
                      </a>
                    </div>
                    <div class="product-item">
                      <a href="{{ route('search', ['controller_genres[]' => App\Enums\Genre::CR_DC_INPUT]) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product014.jpg') }}" alt="DC入力コントローラ">
                          <figcaption>DC入力コントローラ</figcaption>
                        </figure>
                      </a>
                    </div>
                    <div class="product-item">
                      <a href="{{ route('search', ['controller_genres[]' => App\Enums\Genre::CR_PoE_INPUT]) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product015.jpg') }}" alt="PoEコントローラ">
                          <figcaption>PoEコントローラ</figcaption>
                        </figure>
                      </a>
                    </div>
                    <div class="product-item">
                      <a href="{{ route('search', ['controller_genres[]' => App\Enums\Genre::CR_EX_AND_SP]) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product016.jpg') }}" alt="専用/特殊コントローラ">
                          <figcaption>専用/特殊コントローラ</figcaption>
                        </figure>
                      </a>
                    </div>
                  </div>
                  <div class="index-link">
                    <a href="{{ route('search', ['controller_genres' => [
                      App\Enums\Genre::CR_AC_INPUT->value,
                      App\Enums\Genre::CR_DC_INPUT->value,
                      App\Enums\Genre::CR_PoE_INPUT->value,
                      App\Enums\Genre::CR_EX_AND_SP->value,
                    ]]) }}">
                      ＞＞すべてのコントローラを見る
                    </a>
                  </div>
                </div>
                <div class="product-block">
                  <h3 class="headline-title--3">
                    <span>
                      <span class="text">OPTIONAL PARTS</span>
                      <span class="bg"></span>
                    </span>
                  </h3>
                  <div class="product-list">
                    <div class="product-item">
                      <a href="{{ route('search', ['genres[]' => App\Enums\Genre::CB_LIGHTING]) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product017.jpg') }}" alt="照明用ケーブル">
                          <figcaption>照明用ケーブル</figcaption>
                        </figure>
                      </a>
                    </div>
                    <div class="product-item">
                      <a href="{{ route('search', ['genres[]' => App\Enums\Genre::CB_EXTERNAL]) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product018.jpg') }}" alt="外部制御ケーブル">
                          <figcaption>外部制御ケーブル</figcaption>
                        </figure>
                      </a>
                    </div>
                    <div class="product-item">
                      <a href="{{ route('search', ['genres[]' => App\Enums\Genre::OP_LIGHTING]) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product019.jpg') }}" alt="照明オプション">
                          <figcaption>照明オプション</figcaption>
                        </figure>
                      </a>
                    </div>
                    <div class="product-item">
                      <a href="{{ route('search', ['genres[]' => App\Enums\Genre::OP_OTHER]) }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product020.jpg') }}" alt="その他">
                          <figcaption>その他</figcaption>
                        </figure>
                      </a>
                    </div>
                  </div>
                  <div class="index-link">
                    <a href="{{ route('search', ['genres' => [
                      App\Enums\Genre::CB_LIGHTING->value,
                      App\Enums\Genre::CB_EXTERNAL->value,
                      App\Enums\Genre::OP_LIGHTING->value,
                      App\Enums\Genre::OP_OTHER->value,
                    ]]) }}">
                      ＞＞すべてのオプショナルパーツを見る
                    </a>
                  </div>
                </div>
                <div class="product-block">
                  <h3 class="headline-title--3">
                    <span>
                      <span class="text">OPTERA</span>
                      <span class="bg"></span>
                    </span>
                  </h3>
                  <div class="optera-column">
                    <div class="product-item">
                      <a href="{{ route('page', 'optera') }}">
                        <figure class="figure"><img src="{{ asset('/assets/img/top/top-product021.jpg') }}" alt="特殊用途照明">
                          <figcaption>特殊用途照明</figcaption>
                        </figure>
                      </a>
                    </div>
                    <p>分光検出や樹脂硬化など紫外線を利用した機器を
                      <br>特注で試作・開発しています。
                    </p>
                  </div>
                </div>
              </div>
              <div class="product-end">
                <a href="{{ route('search', ['only_end'=>1]) }}">生産終了製品はこちら</a>
              </div>
            </div>
          </div>
        </section>
        <!-- End - section-product-->
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
    </main>
    <!-- End Site Main-->
@endsection
