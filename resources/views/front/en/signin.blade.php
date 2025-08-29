@extends('front/ja/base')


@section('title')
  <title>Leimac | ログイン</title>
@endsection


@section('main')
    <!-- Site Main-->
    <main class="site-main" id="site-main">
      <!-- section-fv-->
      <section class="section section-fv">
        <div class="img"><img src="{{ asset('assets/img/page/fv-login.png') }}" alt=""></div>
        <div class="section-content">
          <div class="content">
            <div class="section__title">
              <h1 class="ja">マイページログイン</h1>
              <span class="en">Login</span>
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
            <article class="article page-article article-login">
              <div class="article-block login-block">
                <p>レイマック照明機器グループ会員にご登録いただきますと、
                  <br>各種資料（図面、取扱説明書等）のダウンロードをホームページから行うことが可能になります。
                </p>
              </div>
              <div class="article-block login-block">
                <h2 class="c-title square border">会員ログイン</h2>
                <div class="content row w500">
                  <form action="{{ route('signin.do') }}" method="post">
                    @csrf
                    <div class="login-block-wrap">
                      <dl class="login-data-list">
                        <dt>Emailアドレス</dt>
                        <dd>
                          <div class="input">
                            <input type="text" name="email" value="{{ old('email') }}" required>
                          </div>
                        </dd>
                      </dl>
                      <dl class="login-data-list">
                        <dt>パスワード</dt>
                        <dd>
                          <div class="input show-password-wrap">
                            <input type="password" name="password" required>
                            <span class="show-password"></span>
                          </div>
                        </dd>
                      </dl>
                      <div class="login-block-text text-right">
                        {{--
                        <p>
                          <label class="checkbox-label">
                            <input type="checkbox">
                            <span class="checkbox-text"></span>ログイン情報を記録
                          </label>
                        </p>
                        <p>※パスワードを再設定は<a href="../">コチラ</a>
                        </p>
                        --}}
                      </div>
                      <div class="btn--slide text-center">
                        <button type="submit" value="送信">ログイン</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="article-block login-block">
                <h2 class="c-title square border">新規会員登録</h2>
                <div class="login-block-wrap">
                  <div class="btn--slide text-center">
                    <a href="{{ route('signup') }}">新規会員登録</a>
                  </div>
                  <p>会員情報の変更・会員の退会について
                    <br>会員情報の変更ならびに会員の退会につきましては、会員ログインの後に<a href="{{ route('contact') }}">お問い合せフォーム</a>よりご連絡ください。
                  </p>
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
