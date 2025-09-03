@extends('front/'.app()->getLocale().'/base')


@section('title')
  <title>Leimac | お問合せ</title>
@endsection


@section('main')
    <!-- Site Main-->
    <main class="site-main" id="site-main">
      <!-- section-fv-->
      <section class="section section-fv">
        <div class="img"><img src="{{ asset('/assets/img/page/fv-contact.png') }}" alt=""></div>
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
                  <h2 class="text-center mb-4">お問合せいただきましてありがとうございます。</h2>
                  <p class="text-center">内容を確認させていただき、担当者よりご連絡させていただきます。
                    <br>内容により、お時間を頂戴する可能性がございますが、
                    <br>ご了承くださいますようよろしくお願い申し上げます。
                  </p>
                  <div class="btn--slide text-center mt-8">
                    <a href="../../">
                      <span>TOPページに戻る</span>
                    </a>
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
