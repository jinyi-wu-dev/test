@extends('front/'.app()->getLocale().'/base')


@section('main')
    <!-- Site Main-->
    <main class="site-main" id="site-main">
      <!-- section-fv-->
      <section class="section section-fv">
        <div class="img"><img src="{{ asset('/assets/img/page/fv-optera.png') }}" alt=""></div>
        <div class="section-content">
          <div class="content">
            <div class="section__title">
              <h1 class="ja">特殊用途照明</h1>
              <span class="en">OPTERA</span>
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
              </span> &gt; <span class="breadcrumb_last" aria-current="page">特殊用途照明</span>
            </span>
          </div>
        </div>
      </div>
      <!-- article-page-->
      <div class="page-column-wrap">
        <div class="content row">
          <div class="page-column">
            <article class="article page-article article-optera">
              <div class="article-block">
                <h2 class="optera-h2">バイオ蛍光試薬用ポータブル分光検出器の開発に成功しました</h2>
                <h3 class="optera-h3">OPTERA製品</h3>
                <ul class="optera-list">
                  <li class="optera-list__item">
                    <div class="optera-list__img"><img src="{{ asset('/assets/img/optera/optera-list01.png') }}" alt="LED点灯電源OPT-MS01A"></div>
                    <div class="optera-list__text">
                      <h4 class="optera-list__title">
                        <span class="sub">LED点灯電源 </span>
                        <span class="main">OPT-MS01A</span>
                      </h4>
                      <p>LEDユニット専用の電流表示モニター付点灯電源装置。
                        <br>光パワーメーター「OPT-MSD01」と連動した計測も可能です。
                      </p>
                    </div>
                  </li>
                  <li class="optera-list__item">
                    <div class="optera-list__img"><img src="{{ asset('/assets/img/optera/optera-list02.png') }}" alt="光パワーメーターOPT-MSD01"></div>
                    <div class="optera-list__text">
                      <h4 class="optera-list__title">
                        <span class="sub">光パワーメーター </span>
                        <span class="main">OPT-MSD01</span>
                      </h4>
                      <p>紫外（190nm）〜可視光（550nm）までの受光感度を持つ受光検出装置。2ヘッドで使用する事で、計測環境ドリフトや、基準サンプルとのリアルタイム比較・演算等にも対応できます。
                        <br>*紫外（190nm）〜赤外（1100nm）の広範囲波長タイプもご用意できます。
                      </p>
                    </div>
                  </li>
                  <li class="optera-list__item">
                    <div class="optera-list__img"><img src="{{ asset('/assets/img/optera/optera-list03.png') }}" alt="紫外線LEDユニットOPT-MSLxxx"></div>
                    <div class="optera-list__text">
                      <h4 class="optera-list__title">
                        <span class="sub">紫外線LEDユニット</span>
                        <span class="main">OPT-MSLxxx</span>
                      </h4>
                      <p>255nm~365nmLEDユニットをラインナップしました。 *オプションの集光レンズ・光ファイバー・光学フィルターと組合わせる事が出来ます。
                        <br>（255・260・270・280・290・300・310・320・330・340・350・365nm）
                      </p>
                    </div>
                  </li>
                  <li class="optera-list__item">
                    <div class="optera-list__img"><img src="{{ asset('/assets/img/optera/optera-list04.png') }}" alt="紫外線バンドパスフィルターBPFxxx"></div>
                    <div class="optera-list__text">
                      <h4 class="optera-list__title">
                        <span class="sub">紫外線バンドパスフィルター</span>
                        <span class="main">BPFxxx</span>
                      </h4>
                      <p>255nm~365nmLEDユニットをラインナップしました。
                        <br>主に受光側に取り付ける10x10mmサイズの高透過率バンドパスフィルターです。
                        <br>各波長在庫あり、サイズ違いも受注生産いたします。
                      </p>
                    </div>
                  </li>
                  <li class="optera-list__item">
                    <div class="optera-list__img"><img src="{{ asset('/assets/img/optera/optera-list05.png') }}" alt="ファイバーマルチチャンネル光源OPT-MSF08"></div>
                    <div class="optera-list__text">
                      <h4 class="optera-list__title">
                        <span class="sub">ファイバーマルチチャンネル光源</span>
                        <span class="main">OPT-MSF08</span>
                      </h4>
                      <p>紫外線LEDユニット「OPT-Lxx」を8個まで接続可能。リアルタイムで、投光波長が見れるモニターシステムを内蔵、波長別の電流制御が可能で、任意の投光波形が作り出せます。</p>
                    </div>
                  </li>
                  <li class="optera-list__item">
                    <div class="optera-list__img"><img src="{{ asset('/assets/img/optera/optera-list06.png') }}" alt="分光測定表示モニターsys"></div>
                    <div class="optera-list__text">
                      <h4 class="optera-list__title">
                        <span class="sub">分光測定表示モニター</span>
                        <span class="main">sys</span>
                      </h4>
                      <p>CCD・PDからの計測結果を演算、液晶タッチパネルモニターに表示します。カメラで撮像した対象物画像に、分光波形やpdの実測数値を重ね合わせることも可能。
                        <br>データーの保存から、長時間実験のロガ―としても構築できます。専用分光器の操作・表示モニターとしてご利用ください。
                      </p>
                    </div>
                  </li>
                  <li class="optera-list__item">
                    <div class="optera-list__img"><img src="{{ asset('/assets/img/optera/optera-list07.png') }}" alt="PMT（光電子倍増管）光検出装置OPT-PMTxx"></div>
                    <div class="optera-list__text">
                      <h4 class="optera-list__title">
                        <span class="sub">PMT（光電子倍増管）光検出装置</span>
                        <span class="main">OPT-PMTxx</span>
                      </h4>
                      <p>高感度光センサー「フォトマル」を使用した光検出装置です。
                        <br>230~870nmの紫外線から近赤外の光を高感度で検出します。
                      </p>
                    </div>
                  </li>
                  <li class="optera-list__item">
                    <div class="optera-list__img"><img src="{{ asset('/assets/img/optera/optera-list08.png') }}" alt="分光検出実験フレーム"></div>
                    <div class="optera-list__text">
                      <h4 class="optera-list__title">
                        <span class="main">分光検出実験フレーム</span>
                      </h4>
                      <p>弊社製「ＭＳＤ０１」光パワーメータと、波長別のＬＥＤユニット＋ＬＥＤ点灯電源「ＭＳ０１Ａ」の組み合わせにより、液中内容物の分光検出実験が可能です。</p>
                    </div>
                  </li>
                </ul>
                <h3 class="optera-h3">制作事例</h3>
                <p>ご要望に合わせた専用分光検出器を作成します（試作1台から量産まで）</p>
                <div class="column column-2">
                  <figure class="column-item optera-figure">
                    <figcaption>石英セルでの蛍光・吸光実験
                      <br>レイアウト例
                    </figcaption><img src="{{ asset('/assets/img/optera/optera-case01_1.png') }}" alt="石英セルでの蛍光・吸光実験 レイアウト例"><img src="../assets/img/optera/optera-case01_2.png" alt="石英セルでの蛍光・吸光実験 レイアウト例">
                  </figure>
                  <figure class="column-item optera-figure">
                    <figcaption>固形物分光実験
                      <br>レイアウト例
                    </figcaption><img src="../assets/img/optera/optera-case02_1.png" alt="固形物分光実験 レイアウト例"><img src="../assets/img/optera/optera-case02_2.png" alt="固形物分光実験 レイアウト例"><img src="../assets/img/optera/optera-case02_3.png" alt="固形物分光実験 レイアウト例">
                  </figure>
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
