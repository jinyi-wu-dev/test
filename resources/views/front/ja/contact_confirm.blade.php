@extends('front/ja/base')


@section('main')
    <!-- Site Main-->
    <main class="site-main" id="site-main">
      <!-- section-fv-->
      <section class="section section-fv">
        <div class="img"><img src="../assets/img/page/fv-contact.png" alt=""></div>
        <div class="section-content">
          <div class="content">
            <div class="section__title">
              <h1 class="ja">お問合せ</h1>
              <span class="en">Contact</span>
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
            <article class="article page-article article-contact">
              <div class="article-block form-block contact-block">
                <div class="row w1000">
                  <div class="mailform">
                    <table class="mailform-table">
                    <form method="post" action="{{ route('contact.complete') }}">
                      @csrf
                      <thead>
                        <tr>
                          <th colspan="2">(<span>*</span>入力必須項目）</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th class="required">
                            <span>お問い合わせ先</span>
                          </th>
                          <td class="name">{{ request('type') }}</td>
                          <input type="hidden" name="type" value="{{ request('type') }}">
                        </tr>
                        <tr>
                          <th class="required">
                            <span>お名前</span>
                          </th>
                          <td class="name">{{ request('name1') }}</td>
                          <input type="hidden" name="name1" value="{{ request('name1') }}">
                          <input type="hidden" name="name2" value="{{ request('name2') }}">
                        </tr>
                        <tr>
                          <th class="required">
                            <span>フリガナ</span>
                          </th>
                          <td class="name">{{ request('kana1') }}</td>
                          <input type="hidden" name="kana1" value="{{ request('kana1') }}">
                          <input type="hidden" name="kana2" value="{{ request('kana2') }}">
                        </tr>
                        <tr>
                          <th class="required">
                            <span>郵便番号</span>
                          </th>
                          <td class="name">{{ request('postal_code') }}</td>
                          <input type="hidden" name="postal_code" value="{{ request('postal_code') }}">
                        </tr>
                        <tr>
                          <th class="required">
                            <span>都道府県</span>
                          </th>
                          <td class="name">{{ request('prefecture') }}</td>
                          <input type="hidden" name="prefecture" value="{{ request('prefecture') }}">
                        </tr>
                        <tr>
                          <th class="required">
                            <span>市町村区</span>
                          </th>
                          <td class="name">{{ request('city') }}</td>
                          <input type="hidden" name="city" value="{{ request('city') }}">
                        </tr>
                        <tr>
                          <th>
                            <span>番地</span>
                          </th>
                          <td class="name">{{ request('area') }}</td>
                          <input type="hidden" name="area" value="{{ request('area') }}">
                        </tr>
                        <tr>
                          <th>
                            <span>ビル名</span>
                          </th>
                          <td class="name">{{ request('building') }}</td>
                          <input type="hidden" name="building" value="{{ request('building') }}">
                        </tr>
                        <tr>
                          <th class="required">
                            <span>電話番号</span>
                          </th>
                          <td class="name">{{ request('phone_number') }}</td>
                          <input type="hidden" name="phone_number" value="{{ request('phone_number') }}">
                        </tr>
                        <tr>
                          <th class="required">
                            <span>会社名</span>
                          </th>
                          <td class="name">{{ request('company') }}</td>
                          <input type="hidden" name="company" value="{{ request('company') }}">
                        </tr>
                        <tr>
                          <th class="required">
                            <span>会社名</span>
                          </th>
                          <td class="name">{{ request('department') }}</td>
                          <input type="hidden" name="department" value="{{ request('department') }}">
                        </tr>
                        <tr>
                          <th class="required">
                            <span>Emailアドレス</span>
                          </th>
                          <td class="name">{{ request('email') }}</td>
                          <input type="hidden" name="email" value="{{ request('email') }}">
                        </tr>
                        <tr>
                          <th class="required">
                            <span>お問合わせ内容</span>
                          </th>
                          <td class="name">{{ request('contents') }}</td>
                          <input type="hidden" name="contents" value="{{ request('contents') }}">
                        </tr>
                      </tbody>
                    </table>
                    <div class="btn--slide text-center">
                      <button type="submit" onClick="$('input[name=back]').val(1);">
                        <span>戻る</span>
                        <input type="hidden" name="back" value="0">
                      </button>
                      <button type="submit">
                        <span>送信する</span>
                      </button>
                    </div>
                    </form>
                  </div>
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
