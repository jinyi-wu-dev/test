@extends('front/'.app()->getLocale().'/base')


@section('title')
  <title>Leimac | 新着情報</title>
@endsection


@section('main')
    <!-- Site Main-->
    <main class="site-main" id="site-main">
      <div class="page">

        <!-- section-fv-->
        <section class="section section-fv">
          <div class="img"><img src="../assets/img/page/fv-technology.png" alt=""></div>
          <div class="section-content">
            <div class="content">
              <div class="section__title">
                <h1 class="ja">新着情報</h1>
                <span class="en">News</span>
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
          <div class="content row w1000">
            <div class="page-column">
              <article class="article page-article article-news">
                <div class="article-block">
                  <h2 class="page-title--news">新着情報</h2>
                  <ul class="news-list">
                    @foreach($news as $n)
                      <li class="news-list__item">
                        <div class="meta">
                          <time datetime="0000-00-00">{{ date('Y年m月d日', strtotime($n->post_date)) }}</time>
                          <span class="category">{{ $n->name }}</span>
                          <!--span class="tag">製品情報</span-->
                        </div>
                        <a href="{{ config('system.news.link_url') }}{{ $n->post_name }}" target="_blank" rel="noopener">{{ $n->post_title }}</a>
                      </li>
                    @endforeach
                  </ul>
                </div>
                {{ $news->links('front.ja.news_pagination') }}
              </article>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- End Site Main-->
@endsection
