@extends('front/ja/base')


@section('title')
  <title>Leimac | 貸出依頼</title>
@endsection


@section('main')
    <!-- Site Main-->
    <main class="site-main" id="site-main">
      <!-- section-fv-->
      <section class="section section-fv">
        <div class="img"><img src="../assets/img/page/fv-cart.png" alt=""></div>
        <div class="section-content">
          <div class="content">
            <div class="section__title">
              <h1 class="ja">貸出依頼</h1>
              <span class="en">Cart</span>
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
            <article class="article page-article article-cart">
              <div class="article-block cart-block">
                <div class="content row w1000">
                  <div class="comment text-center">
                    <h2>デモ機貸出ご依頼
                      <br class="show-small">ありがとうございます
                    </h2>
                    <p>内容を確認させていただき、
                      <br class="show-small">担当者よりご連絡させていただきます。
                      <br>内容によりましては
                      <br class="show-small">お時間頂戴する可能性もございます。
                      <br>予めご了承くださいますよう
                      <br class="show-small">よろしくお願い申し上げます。
                    </p>
                  </div>
                </div>
              </div>
              <div class="article-block cart-block">
                <div class="content row w1000">
                  <h2 class="c-title square border">デモ機貸出 ご依頼</h2>
                  <ul class="lending-list">

                    @foreach ($lend_item->items as $item)
                      <li class="lending-list__item">
                        <div class="lending-img"><img src="{{ $item->series->fileUrl('image') }}" alt="アイテム"></div>
                        <div class="lending-text">
                          <p>
                            {{ $item->name }}
                          </p>
                        </div>
                        <div class="lending-counter">
                          <span>数量:{{ $item->pivot->num_of_item }}</span>
                        </div>
                      </li>
                    @endforeach

                  </ul>
                </div>
              </div>
              <div class="article-block cart-block">
                <div class="content row w1000">
                  <h2 class="c-title square">お客様情報</h2>
                  <table>
                    <tbody>
                      <tr>
                        <th>メールアドレス</th>
                        <td>asahi@leimac.jp</td>
                      </tr>
                      <tr>
                        <th>お名前</th>
                        <td>旭 隆広 様</td>
                      </tr>
                      <tr>
                        <th>フリガナ</th>
                        <td>アサヒ タカヒロ 様</td>
                      </tr>
                      <tr>
                        <th>国名</th>
                        <td>日本</td>
                      </tr>
                      <tr>
                        <th>郵便番号</th>
                        <td>5240215</td>
                      </tr>
                      <tr>
                        <th>都道府県</th>
                        <td>滋賀県</td>
                      </tr>
                      <tr>
                        <th>市区郡町村</th>
                        <td>守山市幸津川町</td>
                      </tr>
                      <tr>
                        <th>番地</th>
                        <td>1551</td>
                      </tr>
                      <tr>
                        <th>ビル名 </th>
                        <td> </td>
                      </tr>
                      <tr>
                        <th>電話番号</th>
                        <td>0775856771</td>
                      </tr>
                      <tr>
                        <th>会社名</th>
                        <td>株式会社レイマック</td>
                      </tr>
                      <tr>
                        <th>部署</th>
                        <td>販売促進</td>
                      </tr>
                      <tr>
                        <th>役職</th>
                        <td>一般</td>
                      </tr>
                      <tr>
                        <th>業種</th>
                        <td>機器・精密機器メーカー</td>
                      </tr>
                      <tr>
                        <th>職種</th>
                        <td>営業・販売, マーケティング・広報・宣伝</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="article-block cart-block">
                <div class="content row w1000">
                  <h2 class="c-title square">備考欄</h2>
                  <p class="textarea">
                    {{ $lend_item->remarks }}
                  </p>
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
      <!-- End - article-page-->
    </main>
    <!-- End Site Main-->
@endsection
