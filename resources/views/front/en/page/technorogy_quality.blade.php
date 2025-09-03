@extends('front/'.app()->getLocale().'/base')


@section('title')
  <title>Leimac | 技術・品質情報</title>
@endsection

@section('body_class')
  page--technorogycw
@endsection


@section('main')
    <!-- Site Main-->
    <main class="site-main" id="site-main">
      <!-- section-fv-->
      <section class="section section-fv">
        <div class="img"><img src="{{ asset('assets/img/page/fv-technology.png') }}" alt=""></div>
        <div class="section-content">
          <div class="content">
            <div class="section__title">
              <h1 class="ja">技術・品質情報</h1>
              <span class="en">TECHNOLOGY &amp; QUALITY</span>
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
            <article class="article page-article article-technorogy">
              <div class="article-block">
                <div class="tab-area tab-technorogy">
                  <input type="radio" name="tabneme01" id="tab01" checked>
                  <label for="tab01">技術情報</label>
                  <input type="radio" name="tabneme01" id="tab02">
                  <label for="tab02">品質情報</label>
                  <div class="tab-block technorogy-block" data-tab-group="tabneme01">
                    <div class="tab-block__inner">
                      <div class="content row w1000">
                        <h2 class="article-title text-center">
                          <span class="ja">技術情報</span>
                          <span class="en">TECHNICAL INFO </span>
                        </h2>
                        <ul class="technorogy-innerlist">
                          <li class="technorogy-innerlist__item">
                            <a href="#product-features">レイマック照明製品の特徴</a>
                          </li>
                          <li class="technorogy-innerlist__item">
                            <a href="#what-is-led">LEDとは？</a>
                          </li>
                          <li class="technorogy-innerlist__item">
                            <a href="#how-to-choose-led">LEDの選び方</a>
                          </li>
                          <li class="technorogy-innerlist__item">
                            <a href="#how-to-choose-controller">照明製品用コントローラの選び方</a>
                          </li>
                          <li class="technorogy-innerlist__item">
                            <a href="#how-to-use-lighting">照明製品の上手な使い方</a>
                          </li>
                          <li class="technorogy-innerlist__item">
                            <a href="#lighting-simulation">照明シミュレーション</a>
                          </li>
                        </ul>
                        <div class="entry">
                          <h2 class="c-title main" id="product-features">
                            <span>レイマック照明製品の特徴</span>
                          </h2>
                          <h3 class="c-title">
                            <span class="color-pink">FAシステムとのコラボレーションが出来ます</span>
                          </h3>
                          <ol>
                            <li>組立/加工が社内なので図面が流出しない。</li>
                            <li>メカトロや電気、プログラムのノウハウが活かせる。</li>
                            <li>検査装置全体の検討/設計/製作も可能。</li>
                          </ol>
                          <h3 class="c-title">
                            <span class="color-pink">代理店様/OEMご依頼を歓迎します</span>
                          </h3>
                          <ul>
                            <li>特定ユーザー様/特定購入先様との系列関係が無い。</li>
                            <li>営業管理費を抑えて価格低減に反映。</li>
                          </ul>
                          <h3 class="c-title">
                            <span class="color-pink">カスタム/新規開発・設計を歓迎します</span>
                          </h3>
                          <ul>
                            <li>画像処理再現実験専用ラボを保有。</li>
                            <li>画像処理分野に限らないLED光源の可能性追求。</li>
                          </ul>
                          <p class="bold">照明に使用する光学設計は独自に行います。</p>
                          <h2 class="c-title main" id="what-is-led">
                            <span>LEDとは</span>
                          </h2>
                          <p class="indent">電流を流すことで、光を放出する半導体素子。</p>
                          <figure class="text-center"><img src="{{ asset('assets/img/technorogy/image-led.png') }}" width="480" alt="LEDとは"></figure>
                          <h3 class="c-title square border">LEDの特徴</h3>
                          <div class="column">
                            <div class="column-item">
                              <ul>
                                <li>極性（±）がある</li>
                                <li>素子によって定格電圧/電流が違う</li>
                                <li>応答速度が非常に速い</li>
                                <li>高効率=低消費電力</li>
                                <li>長寿命（自発熱による輝度劣化はある）</li>
                              </ul>
                            </div>
                            <div class="column-item">
                              <ul>
                                <li>スイッチングに強い</li>
                                <li>振動/衝撃に強い</li>
                                <li>素子そのものは防水仕様</li>
                                <li>ロケット型やチップ型が一般的</li>
                                <li>光に指向性があるものが多い</li>
                              </ul>
                            </div>
                          </div>
                          <figure class="text-center"><img class="modal-img" src="{{ asset('assets/img/technorogy/image-led-feature.png') }}" width="745" alt="LEDの特徴"></figure>
                          <h3 class="c-title square border">LEDの寿命</h3>
                          <p>LEDはその特性上、白熱灯のようにフィラメントが切れて点灯しなくなることはありません。
                            <br>しかし、LEDチップや、チップを封止している樹脂などの封止材が劣化することにより、光の透過率が低下し光束減衰が生じます。そのため、一般的にLEDの寿命とは、LEDが点灯しなくなるまでの時間ではなく<span class="color-pink">周囲温度25℃においてLEDの輝度が初期の値と比べ70％になる時間を寿命と表現しています。</span>
                          </p>
                          <p>LED素子を実装した照明製品においてもこの寿命の定義は同じです。
                            <br>また照明製品の寿命である”照明として使えなくなるレベル”はお客様が必要とされる明るさが 「初期と比較して何％か」によって異なります。初期の明るさで「やっと明るさが足りる」お客様にとっては２０％の明るさ減衰でも「寿命を過ぎた」と言えます。
                          </p>
                          <p>逆に当初から照明能力の50％の明るさで足りていたお客様にとっては（LEDが減衰したら少しずつコントローラからの通電量UPで、必要な明るさを維持できるので）50％減衰してもまだ寿命ではないことになります。
                            <br>よって、<span class="color-pink">「この照明の寿命はいつまで」と一律には言えません。</span>
                          </p>
                          <h3 class="c-title square border">LEDの明るさ</h3>
                          <p>人間の目は、緑色（555nm）が最も感度が良いので、目視検査などの用途では緑色が向いています。
                            <br>しかし画像処理では、目視で明るく見える照明でも、カメラでの撮像が暗くなることがあり、カメラが個々に持つピーク感度特性と照明波長の相性を考慮する必要があります。
                            <br>カメラのピーク感度と照明波長が近づくと撮像も明るくなります。
                          </p>
                          <h2 class="c-title main" id="how-to-choose-led">
                            <span>LEDの選び方</span>
                          </h2>
                          <div class="column choose-led-column">
                            <div class="column-item">
                              <ul>
                                <li>短波長になるほど散乱率は大きくなり、表面の検査用途に向いています。</li>
                                <li>ワークと照明が同じ色になると、コントラストが悪くなります。</li>
                                <li>カラー処理をされないときは、低コストの赤色照明からの選定をお勧め致します。</li>
                              </ul>
                              <p>
                                <small>散乱率は波長の4乗に反比例</small>
                                <small>記載波長は参考値です。上記に当てはまらないLEDを使用している製品もございます。</small>
                              </p>
                            </div>
                            <div class="column-item">
                              <figure class="text-center"><img class="modal-img" src="{{ asset('assets/img/technorogy/image-led-choose-table.png') }}" width="450" alt="LEDの特徴"></figure>
                            </div>
                          </div>
                          <figure class="text-center"><img class="modal-img" src="{{ asset('assets/img/technorogy/image-led-choose-graph.png') }}" width="1000" alt="LEDの特徴"></figure>
                          <h3 class="c-title square border">波長とワークの対比</h3>
                          <p>一般的な照明とは「明るくする」という意味合いですが、画像処理のフィールドでは検査した項目のみを「強調させ」「最適な画像を撮像する」ことが重要な役割になってきます。一般的な補色の関係を考慮した、波長（照明色）とワークの色関係は下記の表のようになります。</p>
                          <div class="column ratio-column">
                            <div class="column-item">
                              <figure><img class="modal-img" src="{{ asset('assets/img/technorogy/wavelength01.png') }}" alt="色見本"></figure>
                            </div>
                            <div class="column-item">
                              <figure><img class="modal-img" src="{{ asset('assets/img/technorogy/wavelength02.png') }}" alt="赤R照射"></figure>
                            </div>
                            <div class="column-item">
                              <figure><img class="modal-img" src="{{ asset('assets/img/technorogy/wavelength03.png') }}" alt="緑G照射"></figure>
                            </div>
                            <div class="column-item">
                              <figure><img class="modal-img" src="{{ asset('assets/img/technorogy/wavelength04.png') }}" alt="青B照射"></figure>
                            </div>
                            <div class="column-item">
                              <figure><img class="modal-img" src="{{ asset('assets/img/technorogy/wavelength05.png') }}" alt="白W（RBG）照射"></figure>
                            </div>
                            <div class="column-item">
                              <figure><img class="modal-img" src="{{ asset('assets/img/technorogy/wavelength06.png') }}" alt="黄Y照射"></figure>
                            </div>
                            <div class="column-item">
                              <figure><img class="modal-img" src="{{ asset('assets/img/technorogy/wavelength07.png') }}" alt="シアンC（GB）照射"></figure>
                            </div>
                            <div class="column-item">
                              <figure><img class="modal-img" src="{{ asset('assets/img/technorogy/wavelength08.png') }}" alt="マゼンタM（RB）照射"></figure>
                            </div>
                          </div>
                          <p>
                            <small>代表例になりますので、ワークの特性（反射・透過・吸収）・カメラ・レンズ（光学系）との相性により、当てはまらないこともあります。</small>
                          </p>
                          <h3 class="c-title square border">色の反射と吸収</h3>
                          <figure class="text-center"><img class="modal-img" src="{{ asset('assets/img/technorogy/reflection-and-absorption.png') }}" width="1000" alt="色の反射と吸収"></figure>
                          <h3 class="c-title square border">照明製品のタイプによる選定</h3>
                          <div class="type-list">
                            <div class="type-item">
                              <div class="type-text">
                                <h4 class="c-title color-pink">直射方式</h4>
                                <p>ダイレクトリング照明、ダイレクトバー照明など</p>
                                <ul>
                                  <li>LED素子を高密度に実装</li>
                                  <li>明るさが必要な時に最適な照明です</li>
                                </ul>
                              </div>
                              <div class="type-image">
                                <figure><img src="{{ asset('assets/img/technorogy/type01.png') }}" alt="直射方式"></figure>
                              </div>
                            </div>
                            <div class="type-item">
                              <div class="type-text">
                                <h4 class="c-title color-pink">透過方式</h4>
                                <p>角型エッジライト照明、チップ面発光照明など</p>
                                <ul>
                                  <li>均一な面発光照明</li>
                                  <li>バックライトによる形状検査に最適です</li>
                                </ul>
                              </div>
                              <div class="type-image">
                                <figure><img src="{{ asset('assets/img/technorogy/type02.png') }}" alt="透過方式"></figure>
                              </div>
                            </div>
                            <div class="type-item">
                              <div class="type-text">
                                <h4 class="c-title color-pink">スポット方式</h4>
                                <p>同軸・スポット照明</p>
                                <ul>
                                  <li>光ファイバライトガイドの置換え</li>
                                  <li>スポット照明としても最適です</li>
                                </ul>
                              </div>
                              <div class="type-image">
                                <figure><img src="{{ asset('assets/img/technorogy/type03.png') }}" alt="スポット方式"></figure>
                              </div>
                            </div>
                            <div class="type-item">
                              <div class="type-text">
                                <h4 class="c-title color-pink">間接方式</h4>
                                <p>無影リング照明、ドーム照明など</p>
                                <ul>
                                  <li>間接的な光により素子の映りこみがありません</li>
                                  <li>光沢のある対象物に有効です</li>
                                </ul>
                              </div>
                              <div class="type-image">
                                <figure><img src="{{ asset('assets/img/technorogy/type04.png') }}" alt="間接方式"></figure>
                              </div>
                            </div>
                            <div class="type-item">
                              <div class="type-text">
                                <h4 class="c-title color-pink">特殊照明</h4>
                                <p>RGB照明、赤外・紫外照明など</p>
                                <ul>
                                  <li>色・赤外・紫外・防水など</li>
                                  <li>特殊なご用途に</li>
                                </ul>
                              </div>
                              <div class="type-image">
                                <figure><img src="{{ asset('assets/img/technorogy/type05.png') }}" alt="特殊照明"></figure>
                              </div>
                            </div>
                          </div>
                          <h2 class="c-title main" id="how-to-choose-controller">
                            <span>照明製品用コントローラの選び方</span>
                          </h2>
                          <h3 class="c-title square border">パルス調光方式:PWM(Pulse Width Modulation)</h3>
                          <p>パルス幅の可変で照明の明るさを変える方式</p>
                          <div class="column choose-controller-column">
                            <div class="column-item">
                              <h4 class="c-title color-pink">長所</h4>
                              <ul>
                                <li>素子のVfのバラつきによる影響をうけにくいので照明を点灯させたときムラが少ない。</li>
                                <li>高速でON/OFFしているので電圧調光で同じ時間点灯させるよりも寿命が長くなる。</li>
                              </ul>
                              <h4 class="c-title color-pink">短所</h4>
                              <ul>
                                <li>超高速シャッター速度のカメラではシャッターと非同期して真っ暗になることがある。</li>
                                <li>高速でON/ノイズが発生しやすい。</li>
                              </ul>
                            </div>
                            <div class="column-item">
                              <figure><img class="modal-img" src="{{ asset('assets/img/technorogy/pulse-widthmodulation.png') }}" alt="パルス調光方式:PWM(Pulse Width Modulation)"></figure>
                            </div>
                          </div>
                          <h3 class="c-title square border">電圧調光方式</h3>
                          <p>電圧可変で照明の明るさを変える方式</p>
                          <div class="column choose-controller-column">
                            <div class="column-item full">
                              <h4 class="c-title color-pink">長所</h4>
                              <p class="indent">パルス調光コントローラのようにシャッターと非同期して真っ暗になることはない。</p>
                              <h4 class="c-title color-pink">短所</h4>
                              <p class="indent">素子のVfのバラつきによる影響を受けやすいので輝度ムラが発生しやすい。</p>
                            </div>
                          </div>
                          <h2 class="c-title main" id="how-to-use-lighting">
                            <span>照明製品の上手な使い方</span>
                          </h2>
                          <h3 class="c-title square border">照明製品は、輝度の低下・劣化を早めるため、高温での使用は避けてください</h3>
                          <p>LEDは、発熱することによって（自発熱により）輝度を下げたり劣化を早める性質があります。LED素子の寿命は、約４万時間程度（TYP）といわれていますが、高温状態で連続使用されますと短時間で劣化し輝度が低下することがあります。</p>
                          <h3 class="c-title square border">発熱による輝度低下や劣化を抑えるためには</h3>
                          <div class="column use-lighting-column">
                            <div class="column-item full">
                              <h4 class="c-title color-pink">照明製品本体の放熱効果をよくする</h4>
                              <p>冷却効果を工夫するなど、放熱しやすい構造・環境への取付をお勧めします</p>
                              <ul>
                                <li>通気口を付ける</li>
                                <li>ファンを取り付ける</li>
                                <li>放熱効果の良い厚めのブラケットや金属板に取り付ける</li>
                              </ul>
                              <h4 class="c-title color-pink">画像取り込みのタイミングに合わせて照明をON/OFFする</h4>
                              <p>照明製品はスイッチングに強い照明です。
                                <br>弊社調光コントローラの外部信号による照明ON/OFF機能を活用し、必要なときだけ点灯させることで寿命を延ばせます。（一部コントローラには、ON/OFF機能のない機種がありますのでご注意ください。）
                              </p>
                              <h4 class="c-title color-pink">調光ボリュームを下げて使用する</h4>
                              <p>照明を選定される際には、カメラの絞りをできるだけ開けた状態で評価されると、明るさに余裕のある照明が選定できます。連続点灯でご使用頂く場合は、調光ボリュームを50%程度までのご使用をお勧めします。
                                <br>（劣化し輝度が低下してもボリュームを上げれば元の輝度に戻せます）
                              </p>
                            </div>
                          </div>
                          <h3 class="c-title square border">照明製品は、できるだけ対象物に照明本体を近づけてご使用ください</h3>
                          <div class="column use-lighting-column">
                            <div class="column-item full">
                              <h4 class="c-title color-pink">照明製品は、素子自体が小さいため小型・軽量に製作できます</h4>
                              <p>照度は、距離の2乗に反比例しますので、近づけてご使用いただくことで、光量を大幅にUPできます。
                                <br>（ご使用用途に合わせた照明形状の設計も承っております）%程度までのご使用をお勧めします。
                              </p>
                              <h4 class="c-title color-pink">調光ボリュームを下げて使用する</h4>
                              <p>ダイレクト照明をご使用の場合は拡散板・偏光板との併用により照明の映り込みを取り除くことができる場合があります。</p>
                            </div>
                          </div>
                          <h2 class="c-title main" id="lighting-simulation">
                            <span>照明シミュレーション</span>
                          </h2>
                          <p>簡易光学シミュレーションで試作機を製作することなく適切なライティングを提案します。</p>
                          <ul>
                            <li>カスタム/新規開発</li>
                            <li>3D設計照明　など</li>
                          </ul>
                          <p>1台からでもカスタム対応致します。</p>
                          <div class="column simulation-column">
                            <div class="column-item">
                              <h3 class="c-title square border">光源（LED素子）の配置</h3>
                              <p>設計図面を元にLEDを配列します。</p>
                              <figure><img class="modal-img" src="{{ asset('assets/img/technorogy/simulation01.jpg') }}" alt="光源（LED素子）の配置"></figure>
                            </div>
                            <div class="column-item">
                              <h3 class="c-title square border">周辺部品の配置</h3>
                              <p>使用する部品を配置します。</p>
                              <figure><img class="modal-img" src="{{ asset('assets/img/technorogy/simulation02.jpg') }}" alt="周辺部品の配置"></figure>
                            </div>
                          </div>
                          <div class="column simulation-column">
                            <div class="column-item">
                              <h3 class="c-title square border">光源（LED素子）の配置</h3>
                              <figure><img class="modal-img" src="{{ asset('assets/img/technorogy/simulation03.jpg') }}" alt="光源（LED素子）の配置"></figure>
                            </div>
                            <div class="column-item">
                              <h3 class="c-title square border">周辺部品の配置</h3>
                              <p>計算で出された分布を、画像及びグラフで出力します。</p>
                              <figure><img class="modal-img" src="{{ asset('assets/img/technorogy/simulation04.jpg') }}" alt="周辺部品の配置"></figure>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-block technorogy-block" data-tab-group="tabneme01">
                    <div class="tab-block__inner">
                      <div class="content row w1000">
                        <h2 class="article-title text-center">
                          <span class="ja">品質情報</span>
                          <span class="en">QUALITY INFO</span>
                        </h2>
                        <ul class="technorogy-innerlist">
                          <li class="technorogy-innerlist__item">
                            <a href="#warranty">照明機器の品質保証</a>
                          </li>
                          <li class="technorogy-innerlist__item">
                            <a href="#operating-environment">照明機器の動作環境</a>
                          </li>
                          <li class="technorogy-innerlist__item">
                            <a href="#precautions">照明機器の使用上の注意</a>
                          </li>
                          <li class="technorogy-innerlist__item">
                            <a href="#maintenance">お手入れについて</a>
                          </li>
                          <li class="technorogy-innerlist__item">
                            <a href="#environmental-initiatives">照明機器の環境対応</a>
                          </li>
                          <li class="technorogy-innerlist__item">
                            <a href="#standards">規格について</a>
                          </li>
                        </ul>
                        <div class="entry">
                          <h2 class="c-title main" id="warranty">
                            <span>照明機器の品質</span>
                          </h2>
                          <h3 class="c-title square border">保証期間について</h3>
                          <p class="bold">保証期間：当社出荷日より2年間（※）</p>
                          <p>上記に定める保証期間内に万一当社製品に故障が発生した場合、もしくは照明機器の放射出力が50%に低下した場合は、「保証範囲」に定める通り無償修理又は代品交換をさせていただきます。該当製品をご提示の上、当社までお申し付けください。
                            <br>※但し、放射出力半減までの保証については当社出荷日より1年
                          </p>
                          <h3 class="c-title square border">Smart Vision Lights社製品の保証期間について</h3>
                          <p class="bold">保証期間：当社出荷日より最大10年間（※）</p>
                          <p>当社より購入したSmart Vision Lights社照明機器に故障が発生した場合は、下記条項と「保証範囲」に定める通り無償修理又は代品交換をさせていただきます。該当製品をご提示の上、当社までお申し付けください。</p>
                          <p class="small">
                            <small>該当製品をSVL社の製品登録に登録頂いた方を対象として、故障が発生した場合の保証を当社出荷日より10年とさせていただきます。</small>
                            <small>該当製品がSVL社の製品登録に未登録の場合、故障が発生した場合の保証を当社出荷日より5年とさせていただきます。</small>
                            <small>照明機器の放射出力が50%に低下した場合の保証については、当社出荷日より3年とさせていただきます。</small>
                            <small>製品筐体のTスロット部の保証については、当社出荷日より3年とさせていただきます。</small>
                          </p>
                          <p>SVL社の製品登録については<a href="https://smartvisionlights.com/10-year-warranty/" target="_blank" rel="noopener">こちら</a>から登録が可能です。</p>
                          <p style="background-color:#f00; color:#fff;">↑↑↑↑↑↑リンク404↑↑↑↑↑↑↑↑</p>
                          <h3 class="c-title square border">保証範囲</h3>
                          <p class="bold">取扱説明書に従った当社指定の使用条件のもとで、保証期間内に万一故障が発生した場合は、無償にて故障個所の修理又は代品交換をさせていただきます。但し、保証期間内であっても次の場合は有償となります。</p>
                          <ul>
                            <li>当社製品以外の照明機器もしくは電源を接続したことにより生じた故障や損傷の場合</li>
                            <li>使用上の誤り及び不当な修理・改造・分解による故障や損傷の場合</li>
                            <li>火災・公害・暴動等の発生及び、地震・雷・水害その他の天災地変などの外部の要因または、特異な環境下（異常電圧、高温多湿等）での使用による故障や損傷の場合</li>
                            <li>その他、その責が当社にない場合</li>
                          </ul>
                          <h3 class="c-title square border">責任の制限</h3>
                          <p class="bold">当社製品の故障または損傷に起因するお客様での二次災害（装置の損傷・機会損失・逸失利益など)および、いかなる損害も補償の対象外とさせていただきます。）</p>
                          <h3 class="c-title square border">保証の制限</h3>
                          <p class="bold">「製品保証」は、明示した保証期間及び条件のもとで上記に記載の保証内容をお約束するものです。
                            <br>従いまして、明示、黙示を問わず、その他の一切の保証を行うものではありません。
                            <br>弊社製品は主に画像処理および工業用検査への使用を前提として設計されています。
                            <br>以下のような状況で使用される場合には、当保証は適用外とさせていただきます。
                          </p>
                          <ul>
                            <li>人身の損傷に至る可能性のある用途（原子力制御、鉄道、航空、安全機器や、特に信頼性が求められる用途への使用）</li>
                            <li>人命に直接関わる医療用機器への使用</li>
                            <li>財産に大きな影響が予測される用途への使用</li>
                          </ul>
                          <h2 class="c-title main" id="operating-environment">
                            <span>照明機器の動作環境</span>
                          </h2>
                          <h3 class="c-title square border">照明</h3>
                          <div class="column environment-column">
                            <div class="column-item"><img src="{{ asset('assets/img/technorogy/icon_ondo.png') }}" alt="">
                              <span>周囲温度：0〜+40℃</span>
                            </div>
                            <div class="column-item"><img src="{{ asset('assets/img/technorogy/icon_shitsudo.png') }}" alt="">
                              <span>周囲温度：0〜+40℃</span>
                            </div>
                          </div>
                          <h3 class="c-title square border">コントローラ</h3>
                          <div class="column environment-column">
                            <div class="column-item"><img src="{{ asset('assets/img/technorogy/icon_ondo.png') }}" alt="">
                              <span>周囲温度：0〜+40℃</span>
                            </div>
                            <div class="column-item"><img src="{{ asset('assets/img/technorogy/icon_shitsudo.png') }}" alt="">
                              <span>周囲湿度：20〜70％</span>
                            </div>
                          </div>
                          <h3 class="c-title square border">ケーブル</h3>
                          <div class="column environment-column">
                            <div class="column-item"><img src="{{ asset('assets/img/technorogy/icon_ondo.png') }}" alt="">
                              <span>周囲温度：0〜+40℃</span>
                            </div>
                            <div class="column-item"><img src="{{ asset('assets/img/technorogy/icon_shitsudo.png') }}" alt="">
                              <span>周囲湿度：35〜70％</span>
                            </div>
                          </div>
                          <div class="borderline"></div>
                          <p class="small">
                            <small>上記は代表値であり、全ての製品が該当するわけでは御座いません。ご使用の前には取扱説明書を良くお読みの上、正しくお使い下さい。</small>
                          </p>
                          <h2 class="c-title main" id="precautions">
                            <span>照明機器の使用上の注意</span>
                          </h2>
                          <ul>
                            <li>光源を直視しないでください。</li>
                            <li>照明/コントローラを分解/改造しないで下さい。</li>
                            <li>濡れた手で稼動中の製品に触れないで下さい。</li>
                            <li>高温/多湿/飛沫環境では未対策品を使用しないで下さい。</li>
                            <li>粉塵の多い場所への設置は避けて下さい。</li>
                            <li>放熱/冷却などの配慮をして下さい。</li>
                            <li>照明をできるだけワーク近くに設置して下さい。</li>
                            <li>必要最小出力/点滅使用などを心掛けて下さい。</li>
                            <li>他社の電源での点灯使用はしないで下さい。</li>
                            <li>照明/コントローラともに入力電圧の合致を確認して下さい。</li>
                            <li>コントローラ容量は照明の消費電力以上か確認して下さい。</li>
                            <li>AC電源は動力/電磁弁等とは別の電源から取って下さい。</li>
                            <li>設置場所周辺のサージ/ノイズに注意して下さい。</li>
                            <li>照明/コントローラからノイズが発生する場合があります。</li>
                            <li>アース端子のあるコントローラはアースを取って下さい。</li>
                            <li>照明取付時はネジ深さ指示ラベルに従ってください。</li>
                          </ul>
                          <h2 class="c-title main" id="maintenance">
                            <span>お手入れについて</span>
                          </h2>
                          <ul>
                            <li>お手入れのときは、必ず電源を切り、本製品が十分に冷えた状態で行ってください。感電ややけどの恐れがあります。</li>
                            <li>シンナーやベンジンなど揮発性のものを使用して拭かないで下さい。変色や破損の原因になります。</li>
                            <li>本体は、乾いた柔らかい布で拭いてください。発光面は特に傷つきやすいので、エアーブローまたはメガネ拭き等の柔らかい布をご使用ください。</li>
                            <li>汚れがひどいときは、柔らかい布を薄めた中性洗剤につけてよく絞ってから拭きとり、さらに洗剤成分が残らないようによく絞った水拭き用の柔らかい布で仕上げてください。</li>
                          </ul>
                          <h2 class="c-title main" id="environmental-initiatives">
                            <span>照明機器の環境対応</span>
                          </h2>
                          <h3 class="c-title square border">環境方針</h3>
                          <p>当社は「ものづくり」の研究開発型企業として社会に貢献し、次の方針による環境マネジメントシステムを構築します。</p>
                          <ul>
                            <li>「ものづくり」の原点として社会的責任である「地球環境への負荷を最小限にすること」につき継続的改善に取り組みます。</li>
                            <li>「ものづくり」への創造的挑戦として地球環境を豊かにするような製品の創造に努めます。</li>
                            <li>関連する法規制・地域との協定などの遵守につとめます。</li>
                            <li>環境保全活動として次の課題に取り組みます。
                              <ul>
                                <li>環境問題改善を促す及び長寿命化製品の開発/推奨販売</li>
                                <li>廃棄物の低減</li>
                                <li>省エネルギーの意識付けと実施</li>
                              </ul>
                            </li>
                            <li>本環境方針を実行・維持していくために全従業員並びに供給者や請負者に周知し、広く一般に公開することで環境に対する意識が向上するようつとめます。</li>
                          </ul>
                          <h3 class="c-title square border">改正RoHS指令(2011/65/EU+(EU)2015/863) 対応</h3>
                          <p>環境配慮製品の供給に係る化学物質の使用規制として、鉛などの有害6物質の使用に制限を加えた改正RoHS指令(2011/65/EU)は、追加事項(EU)2015/863に定めたフタル酸類4物質を規制に追加して10物質の規制として施行・運用されております。
                            <br>また、改正RoHS指令に対してフタル酸類4物質の追加とその適用時期を定めた追加事項(EU)2015/863が2015年6月4日に公布され、2019年7月22日から適用となっております。
                            <br>(レイマックのLED照明/コントローラなどは監視・制御機器のカテゴリにあたり、2021年7月22日から対応)
                          </p>
                          <p>当社製品は、改正RoHS指令の有害6物質に対してほぼ全ての製品で2007年4月に、追加4物質を含む10物質に対して一部を除くカタログ掲載の標準品で2021年7月に対象10物質閾値内(適用除外項目は除く)対応を完了しております。
                            <br>各製品の改正RoHS指令対応状況につきましては、当社HP内の個々の製品ページに記載されている規格項のRoHS2マークをご確認頂くか、当社営業担当までお問い合わせをお願いします。
                          </p>
                          <h4 class="c-title border color-pink">RoHS2マーク</h4>
                          <div class="icon-text rohs"><img src="{{ asset('assets/img/technorogy/icon_rohs.png') }}" alt="" width="104">
                            <span>RoHS2の10物質閾値内(適用除外項目は除く)</span>
                          </div>
                          <div class="column">
                            <div class="column-item">
                              <div class="rohs-data">
                                <p class="bold">改正RoHS指令(2011/65/EU)に記載の使用制限6物質</p>
                                <dl>
                                  <dt>鉛</dt>
                                  <dd>1000ppm以下</dd>
                                </dl>
                                <dl>
                                  <dt>水銀</dt>
                                  <dd>1000ppm以下</dd>
                                </dl>
                                <dl>
                                  <dt>カドミウム</dt>
                                  <dd>100ppm以下</dd>
                                </dl>
                                <dl>
                                  <dt>六価クロム</dt>
                                  <dd>1000ppm以下</dd>
                                </dl>
                                <dl>
                                  <dt>ポリ臭化ビフェニル (PBB)</dt>
                                  <dd>1000ppm以下</dd>
                                </dl>
                                <dl>
                                  <dt>ポリ臭化ジフェニルエーテル (PBDE)</dt>
                                  <dd>1000ppm以下</dd>
                                </dl>
                                <p class="small text-right">
                                  <small>適用除外は除く</small>
                                </p>
                              </div>
                            </div>
                            <div class="column-item">
                              <div class="rohs-data">
                                <p class="bold">追加事項(EU)2015/863に記載の使用制限4物質</p>
                                <dl>
                                  <dt>フタル酸ジ-2-エチルヘキシル (DEHP)</dt>
                                  <dd>1000ppm以下</dd>
                                </dl>
                                <dl>
                                  <dt>フタル酸ブチルベンジル (BBP)</dt>
                                  <dd>1000ppm以下</dd>
                                </dl>
                                <dl>
                                  <dt>フタル酸ジ-n-ブチル (DBP)</dt>
                                  <dd>1000ppm以下</dd>
                                </dl>
                                <dl>
                                  <dt>フタル酸ジイソブチル (DIBP)</dt>
                                  <dd>1000ppm以下</dd>
                                </dl>
                                <p class="small text-right">
                                  <small>適用除外は除く</small>
                                </p>
                              </div>
                            </div>
                          </div>
                          <h3 class="c-title square border">中国版RoHS指令対応</h3>
                          <p>中国版RoHS指令とは2007年3月1日から中国で施行された「電器電子製品有害物質使用制限管理弁法」のことを指します。
                            <br>欧州で施行されたRoHS指令と同様、鉛・水銀・カドミウム・六価クロム・ポリ臭化ビフェニル(PBB)・ポリ臭化ビフェニルエーテル(PBDE)の6物質を規制対象としています。
                            <br>中国国内で生産、販売、輸入された電子情報製品において、規制対象となる6物質の含有情報を明示するよう義務付けられています。
                            <br>弊社製品では、使用している部品によって含有情報が異なりますので、各製品ページに記載されている有害物質使用制限マークをご確認ください。
                          </p>
                          <h4 class="c-title border color-pink">有害物質使用制限マーク</h4>
                          <div class="icon-text harmful"><img src="{{ asset('assets/img/technorogy/icon_harmful01.png') }}" alt="" width="71">
                            <span>対象物質非含有</span>
                          </div>
                          <div class="icon-text harmful"><img src="{{ asset('assets/img/technorogy/icon_harmful02.png') }}" alt="" width="71">
                            <span>対象物質含有※数字は環境保護使用期限を示す</span>
                          </div>
                          <div class="harmful-data">
                            <div class="harmful-block">
                              <div class="harmful-item">
                                <p class="harmful-head">表1　有害物質名称と含有量の提示</p>
                                <div class="harmful-table table-wrap">
                                  <table>
                                    <tbody>
                                      <tr>
                                        <td class="img" rowspan="3">
                                          <span>有害物質
                                            <br>使用制限マーク
                                          </span><img src="{{ asset('assets/img/technorogy/icon_harmful01.png') }}" alt="" width="71">
                                        </td>
                                        <th colspan="6">有害物質の名称</th>
                                      </tr>
                                      <tr>
                                        <th>鉛</th>
                                        <th>水銀</th>
                                        <th>カドミウム</th>
                                        <th>六価クロム</th>
                                        <th>ポリ臭素化
                                          <br>ビフェニル
                                          <br> (PBB)
                                        </th>
                                        <th>ポリ臭素化
                                          <br>ジフェニルエーテル
                                          <br> (PBDE)
                                        </th>
                                      </tr>
                                      <tr>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div class="harmful-small">
                                  <p>（本表はSJ/T11364の規定に基づき作成。）
                                    <br>○：当該部品のすべての均質材料において、この有毒有害物質の含有量がGB/T26572-2011標準で定める制限要求量以下であることを示す。
                                    <br>×：当該部品のうちいずれかの均質材料において、この有毒有害物質の含有量がGB/T26572-2011標準で定める制限要求量を超過していることを示す。
                                  </p>
                                </div>
                              </div>
                              <div class="harmful-item sc">
                                <div class="harmful-table table-wrap">
                                  <table>
                                    <tbody>
                                      <tr>
                                        <td class="img" rowspan="3">
                                          <span>有害物质
                                            <br>限制的标志
                                          </span><img src="{{ asset('assets/img/technorogy/icon_harmful01.png') }}" alt="" width="71">
                                        </td>
                                        <th colspan="6">有害物质的名称</th>
                                      </tr>
                                      <tr>
                                        <th>铅</th>
                                        <th>汞</th>
                                        <th>镉</th>
                                        <th>六价铬</th>
                                        <th>ポリ臭素化
                                          <br>多溴联苯
                                          <br> (PBB)
                                        </th>
                                        <th>ポリ臭素化
                                          <br>多溴二苯醚
                                          <br> (PBDE)
                                        </th>
                                      </tr>
                                      <tr>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div class="harmful-small">
                                  <p>（本表格依据SJ / T11364的规定编制。）
                                    <br>○：表示该有毒有害物质在该部件所有均质材料中的含量均在GB / T26572-2011标准规定的限量要求以下。
                                    <br>×：表示该有毒有害物质至少在该部件的某一均质材料中的含量超出GB / T26572-2011标准规定的限量要求。
                                  </p>
                                </div>
                              </div>
                              <div class="harmful-item">
                                <p class="harmful-head">表2　部品名称別有害物質名称と含有量の提示：スイッチング電源有</p>
                                <p class="harmful-lead">IDGCシリーズ・IPPAシリーズ・IDCAシリーズ・IMCシリーズ・IWDV-24シリーズ・IWDV-48シリーズ・IJSシリーズ・SAGシリーズ</p>
                                <div class="harmful-table table-wrap">
                                  <table>
                                    <colgroup>
                                      <col>
                                      <col>
                                      <col>
                                      <col>
                                    </colgroup>
                                    <tbody>
                                      <tr>
                                        <td class="img" rowspan="2" colspan="2">
                                          <span>有害物質
                                            <br>使用制限マーク
                                          </span><img src="{{ asset('assets/img/technorogy/icon_harmful02.png') }}" alt="" width="71">
                                        </td>
                                        <th colspan="6">有害物質の名称</th>
                                      </tr>
                                      <tr>
                                        <th>鉛</th>
                                        <th>水銀</th>
                                        <th>カドミウム</th>
                                        <th>六価クロム</th>
                                        <th>ポリ臭素化
                                          <br>ビフェニル
                                          <br> (PBB)
                                        </th>
                                        <th>ポリ臭素化
                                          <br>ジフェニルエーテル
                                          <br> (PBDE)
                                        </th>
                                      </tr>
                                      <tr>
                                        <th class="bg vrl" rowspan="4">部品名称</th>
                                        <th class="bg">プリント基盤</th>
                                        <td>✕</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                      </tr>
                                      <tr>
                                        <th class="bg">筐体</th>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                      </tr>
                                      <tr>
                                        <th class="bg">コントローラ</th>
                                        <td>✕</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                      </tr>
                                      <tr>
                                        <th class="bg">その他
                                          <br>（電線等）
                                        </th>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div class="harmful-small">
                                  <p>（本表はSJ/T11364の規定に基づき作成。）
                                    <br>○：当該部品のすべての均質材料において、この有毒有害物質の含有量がGB/T26572-2011標準で定める制限要求量以下であることを示す。
                                    <br>×：当該部品のうちいずれかの均質材料において、この有毒有害物質の含有量がGB/T26572-2011標準で定める制限要求量を超過していることを示す。
                                  </p>
                                </div>
                              </div>
                              <div class="harmful-item sc">
                                <div class="harmful-table table-wrap">
                                  <table>
                                    <colgroup>
                                      <col>
                                      <col>
                                      <col>
                                      <col>
                                    </colgroup>
                                    <tbody>
                                      <tr>
                                        <td class="img" rowspan="2" colspan="2">
                                          <span>有害物质
                                            <br>限制的标志
                                          </span><img src="{{ asset('assets/img/technorogy/icon_harmful02.png') }}" alt="" width="71">
                                        </td>
                                        <th colspan="6">有害物质的名称</th>
                                      </tr>
                                      <tr>
                                        <th>铅</th>
                                        <th>汞</th>
                                        <th>镉</th>
                                        <th>六价铬</th>
                                        <th>ポリ臭素化
                                          <br>多溴联苯
                                          <br> (PBB)
                                        </th>
                                        <th>ポリ臭素化
                                          <br>多溴二苯醚
                                          <br> (PBDE)
                                        </th>
                                      </tr>
                                      <tr>
                                        <th class="bg vrl" rowspan="4">部件名称</th>
                                        <th class="bg">印刷基板 </th>
                                        <td>✕</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                      </tr>
                                      <tr>
                                        <th class="bg">框架</th>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                      </tr>
                                      <tr>
                                        <th class="bg">电源</th>
                                        <td>✕</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                      </tr>
                                      <tr>
                                        <th class="bg">其他
                                          <br>（电缆等）
                                        </th>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div class="harmful-small">
                                  <p>（本表格依据SJ / T11364的规定编制。）
                                    <br>○：表示该有毒有害物质在该部件所有均质材料中的含量均在GB / T26572-2011标准规定的限量要求以下。
                                    <br>×：表示该有毒有害物质至少在该部件的某一均质材料中的含量超出GB / T26572-2011标准规定的限量要求。
                                  </p>
                                </div>
                              </div>
                              <div class="harmful-item">
                                <p class="harmful-head">表3　部品名称別有害物質名称と含有量の提示：スイッチング電源無</p>
                                <p class="harmful-lead">ILPシリーズ・IDMUシリーズ・IPPAシリーズ・IRPAシリーズ・ILCシリーズ・ILC-24シリーズ・IRCシリーズ・IRC-24シリーズ・ILVシリーズ・ILSシリーズ・IPSAシリーズ</p>
                                <div class="harmful-table table-wrap">
                                  <table>
                                    <colgroup>
                                      <col>
                                      <col>
                                      <col>
                                      <col>
                                    </colgroup>
                                    <tbody>
                                      <tr>
                                        <td class="img" rowspan="2" colspan="2">
                                          <span>有害物質
                                            <br>使用制限マーク
                                          </span><img src="{{ asset('assets/img/technorogy/icon_harmful02.png') }}" alt="" width="71">
                                        </td>
                                        <th colspan="6">有害物質の名称</th>
                                      </tr>
                                      <tr>
                                        <th>鉛</th>
                                        <th>水銀</th>
                                        <th>カドミウム</th>
                                        <th>六価クロム</th>
                                        <th>ポリ臭素化
                                          <br>ビフェニル
                                          <br> (PBB)
                                        </th>
                                        <th>ポリ臭素化
                                          <br>ジフェニルエーテル
                                          <br> (PBDE)
                                        </th>
                                      </tr>
                                      <tr>
                                        <th class="bg vrl" rowspan="4">部品名称</th>
                                        <th class="bg">プリント基盤</th>
                                        <td>✕</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                      </tr>
                                      <tr>
                                        <th class="bg">筐体</th>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                      </tr>
                                      <tr>
                                        <th class="bg">その他
                                          <br>（電線等）
                                        </th>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div class="harmful-small">
                                  <p>（本表はSJ/T11364の規定に基づき作成。）
                                    <br>○：当該部品のすべての均質材料において、この有毒有害物質の含有量がGB/T26572-2011標準で定める制限要求量以下であることを示す。
                                    <br>×：当該部品のうちいずれかの均質材料において、この有毒有害物質の含有量がGB/T26572-2011標準で定める制限要求量を超過していることを示す。
                                  </p>
                                </div>
                              </div>
                              <div class="harmful-item sc">
                                <div class="harmful-table table-wrap">
                                  <table>
                                    <colgroup>
                                      <col>
                                      <col>
                                      <col>
                                      <col>
                                    </colgroup>
                                    <tbody>
                                      <tr>
                                        <td class="img" rowspan="2" colspan="2">
                                          <span>有害物质
                                            <br>限制的标志
                                          </span><img src="{{ asset('assets/img/technorogy/icon_harmful02.png') }}" alt="" width="71">
                                        </td>
                                        <th colspan="6">有害物质的名称</th>
                                      </tr>
                                      <tr>
                                        <th>铅</th>
                                        <th>汞</th>
                                        <th>镉</th>
                                        <th>六价铬</th>
                                        <th>ポリ臭素化
                                          <br>多溴联苯
                                          <br> (PBB)
                                        </th>
                                        <th>ポリ臭素化
                                          <br>多溴二苯醚
                                          <br> (PBDE)
                                        </th>
                                      </tr>
                                      <tr>
                                        <th class="bg vrl" rowspan="4">部件名称</th>
                                        <th class="bg">印刷基板 </th>
                                        <td>✕</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                      </tr>
                                      <tr>
                                        <th class="bg">框架</th>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                      </tr>
                                      <tr>
                                        <th class="bg">其他
                                          <br>（电缆等）
                                        </th>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                        <td>○</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div class="harmful-small">
                                  <p>（本表格依据SJ / T11364的规定编制。）
                                    <br>○：表示该有毒有害物质在该部件所有均质材料中的含量均在GB / T26572-2011标准规定的限量要求以下。
                                    <br>×：表示该有毒有害物质至少在该部件的某一均质材料中的含量超出GB / T26572-2011标准规定的限量要求。
                                  </p>
                                </div>
                              </div>
                            </div>
                            <script>
                              document.querySelectorAll("td").forEach((td) => {
                                if (td.textContent.trim() === "✕") {
                                  td.classList.add("bold");
                                }
                              });
                            </script>
                          </div>
                          <h3 class="c-title square border">米国 有害物質規制法(TSCA)対応</h3>
                          <p>米国有害物質規制法(TSCA) 対象物質含有製品の弊社対応について下記の通りご報告いたします。</p>
                          <p>弊社製品の一部において、PIP(3:1)含有封止樹脂使用フィルムコンデンサ搭載電源の使用を確認しております。</p>
                          <p>弊社製品に搭載している各電源メーカーより、PIP(3:1)未含有の封止樹脂を使用したフィルムコンデンサへの切り替えをおこなう案内をいただいております。
                            <br>電源メーカー及び部品型式によって対応時期(2021年10月～2023年1月までに生産切り替え予定)が異なっており、弊社への対応品入荷及び社内在庫の状況により、順次生産切り替えをおこない、2024年1月迄に全ての機種の対応を予定しております。
                            <br>また、封止樹脂の違いによるフィルムコンデンサへの変更に伴う弊社製品の型式、仕様、安全規格などの変更はございません。
                          </p>
                          <p>切り替え迄の間に当該製品を米国有害物質規制法(TSCA)適用地域へ流通される場合、<a href="{{ asset('assets/pdf/TSCA-20211001.pdf') }}" target="_blank" rel="noopener">案内PDF</a>を参照いただき、｢規則セクション§751.407、PIP(3:1)(e)川下への通知｣にご留意頂きますようお願い申し上げます。弊社製品の切り替え状況につきましては個別に弊社各担当営業窓口までご連絡をお願いいたします。</p>
                          <div class="tsca">
                            <div class="tsca-small">
                              <p class="bold">対象製品</p>
                              <p>含有部品を搭載する弊社調光コントローラー標準品、カスタム品、OEM品
                              <br>(詳細につきましては、<a href="{{ asset('assets/pdf/TSCA-20211001.pdf') }}" target="_blank" rel="noopener">案内PDF 別紙 対象機種</a>を参照願います。※カスタム品・OEM品は未記載)
                              </p>
                            </div>
                            <div class="tsca-data">
                              <p class="bold">含有状況</p>
                              <dl>
                                <dt>含有物質</dt>
                                <dd>PIP(3:1)リン酸トリアリールイソプロピル化物(別名：リン酸トリス(イソプロピルフェニル))
                                  <br>(CAS：68937-41-7)
                                </dd>
                              </dl>
                              <dl>
                                <dt>対象部品、含有部位</dt>
                                <dd>対象部品：AC/DCスイッチング電源のフィルムコンデンサ
                                  <br>対象部位：封止用ウレタン系樹脂
                                </dd>
                              </dl>
                              <dl>
                                <dt>TSCA 規制内容</dt>
                                <dd>§751.407 PIP(3:1)の(a)(2)(i)の「接着剤及び封止剤」に該当し、2025年1月6日以降
                                  <br>商業的流通が禁止されます。
                                </dd>
                              </dl>
                              <dl>
                                <dt>対象機種 </dt>
                                <dd>
                                  <a href="{{ asset('assets/pdf/TSCA-20211001.pdf') }}" target="_blank" rel="noopener"> 案内PDF 別紙 対象機種</a>
                                </dd>
                              </dl>
                            </div>
                          </div>
                          <h2 class="c-title main" id="standards">
                            <span>規格について</span>
                          </h2>
                          <h3 class="c-title square border">CEマーキングについて</h3>
                          <p>LED製品は、IEC62471「ランプ及びランプシステムの光生物学的安全性に関する規格」（国際電気委員会（IED）：2006年制定）の適用範囲に含まれており、 生物学的障害の度合いに応じて、次のようなリスクグループに分類されます。</p>
                          <div class="standard-table has-scroll">
                            <table>
                              <thead>
                                <tr>
                                  <th>Group
                                    <br>(Safety Risk Category)
                                  </th>
                                  <th>Code</th>
                                  <th>Description</th>
                                  <th>Label</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>免除グループ </td>
                                  <td>Exempt</td>
                                  <td class="text-left">何ら光生物学的障害も起こさないもの。</td>
                                  <td>
                                    <div class="img"> <img src="{{ asset('assets/img/technorogy/standard01.jpg') }}" alt=""></div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>リスクグループ1
                                    <br>（低危険度）
                                  </td>
                                  <td>RG1</td>
                                  <td class="text-left">通常の行動への制約が必要になるような
                                    <br>障害を引き起こさないもの。
                                  </td>
                                  <td>
                                    <div class="img"> <img src="{{ asset('assets/img/technorogy/standard02.jpg') }}" alt=""><img src="{{ asset('assets/img/technorogy/standard03.jpg') }}" alt=""><img src="{{ asset('assets/img/technorogy/standard04.jpg') }}" alt=""></div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>リスクグループ2
                                    <br>（中危険度）
                                  </td>
                                  <td>RG2</td>
                                  <td class="text-left">嫌悪感及び熱的な不快感を伴う障害を引
                                    <br>き起こさないもの。
                                  </td>
                                  <td>
                                    <div class="img"> <img src="{{ asset('assets/img/technorogy/standard05.jpg') }}" alt=""><img src="{{ asset('assets/img/technorogy/standard06.jpg') }}" alt=""><img src="{{ asset('assets/img/technorogy/standard07.jpg') }}" alt=""></div>
                                    <div class="img"> <img src="{{ asset('assets/img/technorogy/standard08.jpg') }}" alt=""><img src="{{ asset('assets/img/technorogy/standard09.jpg') }}" alt=""></div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>リスクグループ3
                                    <br>（高危険度）
                                  </td>
                                  <td>RG3</td>
                                  <td class="text-left">一般的又は短時間の露光によっても障害
                                    <br>を引き起こすもの。
                                  </td>
                                  <td></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <h3 class="c-title square border">UKCAについて</h3>
                          <p>UKCA（UK適合性評価済み）マークは、グレートブリテン島（イングランド、ウェールズ、スコットランド）の市場に出される商品に適用される安全基準の適合証明マークです。
                            <br>本製品にUKCAマークの記載があるものは、満たす必要のある技術要求(必須要求事項)、及び適合性を実証するために使用できる適合性評価プロセスと規格基準に適合しています。
                          </p>
                          <h3 class="c-title square border">ULについて</h3>
                          <p>弊社のLED照明、延長ケーブルは、DC48V以下で使用するため、計測，制御及び試験所用電気機器の安全規格UL61010-1の 6.3.1 a)項の電圧レベル以下であることから、米国の安全規格の対象外と判断します。
                            <br>LED照明用コントローラは、安全規格に該当する機種ではありますが、強制認証規格ではないため、取得する予定はございません。
                          </p>
                          <h3 class="c-title square border">電気用品安全法（PSE）について</h3>
                          <p>本製品にPSEマーク記載があるものは、特定電気用品（直流電源装置）省令第一項技術基準に適合しています。</p>
                          <h3 class="c-title square border">中国強制製品認証（CCC）について</h3>
                          <p>本製品にPSEマーク記載があるものは、特定電気用品（直流電源装置）省令第一項技術基準に適合しています。</p>
                          <div class="standard-table has-scroll">
                            <table>
                              <colgroup>
                                <col class="product">
                                <col class="code">
                                <col>
                              </colgroup>
                              <thead>
                                <tr>
                                  <th>製品</th>
                                  <th>HSコード</th>
                                  <th>説　明</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>照明</td>
                                  <td>9405.42 000</td>
                                  <td class="text-left">「2020年中国国家認証認可監督管理委員会第21号公布」の製品対象品目に対し、当社製品のHSコードは、規制対象の分類に含まれますが工業用のため非該当と判断します。</td>
                                </tr>
                                <tr>
                                  <td>コントローラ
                                    <br>（AC入力）
                                  </td>
                                  <td>8504.40 110</td>
                                  <td class="text-left">「2020年中国国家認証認可監督管理委員会第21号公布」の製品対象品目に対し、当社製品のHSコードは、規制対象の分類から外れ規制対象外と判断します。</td>
                                </tr>
                                <tr>
                                  <td>コントローラ
                                    <br>（DC入力）
                                  </td>
                                  <td>8504.40 900</td>
                                  <td class="text-left">「2020年中国国家認証認可監督管理委員会第21号公布」の製品対象品目に対し、当社製品のHSコードは、規制対象の分類に含まれますが入出力電圧が交流/直流36V未満のため非該当と判断します。</td>
                                </tr>
                                <tr>
                                  <td>PoEコントローラ</td>
                                  <td>8504.40 900</td>
                                  <td class="text-left">「2020年中国国家認証認可監督管理委員会第21号公布」の製品対象品目に対し、当社製品のHSコードは、規制対象の分類に含まれますが認証対象品目から外れ非該当と判断します。</td>
                                </tr>
                                <tr>
                                  <td>延長ケーブル</td>
                                  <td>8544.42.200</td>
                                  <td class="text-left">「2020年中国国家認証認可監督管理委員会第21号公布」の製品対象品目に対し、当社製品のHSコードは、規制対象の分類から外れ規制対象外と判断します。</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
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
@endsection
