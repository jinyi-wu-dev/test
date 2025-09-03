@extends('front/'.app()->getLocale().'/base')


@section('title')
  <title>Leimac | 新規会員登録</title>
@endsection


@section('main')
    <!-- Site Main-->
    <main class="site-main" id="site-main">
      <!-- section-fv-->
      <section class="section section-fv">
        <div class="img"><img src="../assets/img/page/fv-register.png" alt=""></div>
        <div class="section-content">
          <div class="content">
            <div class="section__title">
              <h1 class="ja">新規会員登録</h1>
              <span class="en">New member registration</span>
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
            <article class="article page-article article-register">
              <div class="article-block form-block register-block">
                <div class="row w1000">
                  <div class="mailform">
                    <table class="mailform-table">
                    <form method="post" action="{{ route('signup.complete') }}">
                      @csrf
                      <tbody>
                        <tr>
                          <th class="required">
                            <span>お名前</span>
                          </th>
                          <td class="name">{{ request('name') }}</td>
                          <input type="hidden" name="name" value="{{ request('name') }}">
                        </tr>
                        <tr>
                          <th class="required">
                            <span>フリガナ</span>
                          </th>
                          <td class="name">{{ request('kana') }}</td>
                          <input type="hidden" name="kana" value="{{ request('kana') }}">
                        </tr>
                        <tr>
                          <th class="required">
                            <span>郵便番号</span>
                          </th>
                          <td>{{ request('postal_code') }}</td>
                          <input type="hidden" name="postal_code" value="{{ request('postal_code') }}">
                        </tr>
                        <tr>
                          <th class="required">
                            <span>都道府県</span>
                          </th>
                          <td>
                            @if (request('prefecture')=='_forign')
                              {{ request('country') }}
                            @else
                              @foreach(\App\Enums\Prefecture::cases() as $pref)
                                @if ($pref->value==request('prefecture'))
                                  {{ $pref->label() }}
                                @endif
                              @endforeach
                            @endif
                          </td>
                          <input type="hidden" name="prefecture" value="{{ request('prefecture') }}">
                          <input type="hidden" name="country" value="{{ request('country') }}">
                        </tr>
                        <tr>
                          <th class="required">
                            <span>市町村区</span>
                          </th>
                          <td>{{ request('city') }}</td>
                          <input type="hidden" name="city" value="{{ request('city') }}">
                        </tr>
                        <tr>
                          <th>
                            <span>番地</span>
                          </th>
                          <td>{{ request('area') }}</td>
                          <input type="hidden" name="area" value="{{ request('area') }}">
                        </tr>
                        <tr>
                          <th>
                            <span>ビル名</span>
                          </th>
                          <td>{{ request('building') }}</td>
                          <input type="hidden" name="building" value="{{ request('building') }}">
                        </tr>
                        <tr>
                          <th class="required">
                            <span>電話番号</span>
                          </th>
                          <td>{{ request('phone_number') }}</td>
                          <input type="hidden" name="phone_number" value="{{ request('phone_number') }}">
                        </tr>
                        <tr>
                          <th class="required">
                            <span>会社名</span>
                          </th>
                          <td>{{ request('company') }}</td>
                          <input type="hidden" name="company" value="{{ request('company') }}">
                        </tr>
                        <tr>
                          <th class="required">
                            <span>部署</span>
                          </th>
                          <td>{{ request('department') }}</td>
                          <input type="hidden" name="department" value="{{ request('department') }}">
                        </tr>
                        <tr>
                          <th class="required">
                            <span>役職</span>
                          </th>
                          <td>
                            @foreach (config('enums.ja.position') as $val => $label)
                              @if (in_array($val, request('positions')))
                                {{ $label }}
                                <input type="hidden" name="positions[]" value="{{ $val }}">
                              @endif
                            @endforeach
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>業種</span>
                          </th>
                          <td>
                            @foreach (config('enums.ja.industry') as $val => $label)
                              @if (in_array($val, request('industries')))
                                {{ $label }}
                                <input type="hidden" name="industries[]" value="{{ $val }}">
                              @endif
                            @endforeach
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>職種</span>
                          </th>
                          <td>
                            @foreach (config('enums.ja.occupation') as $val => $label)
                              @if (in_array($val, request('occupationes')))
                                {{ $label }}
                                <input type="hidden" name="occupationes[]" value="{{ $val }}">
                              @endif
                            @endforeach
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>Emailアドレス</span>
                          </th>
                          <td>{{ request('email') }}</td>
                          <input type="hidden" name="email" value="{{ request('email') }}">
                        </tr>
                        <tr>
                          <th class="required">
                            <span>パスワード</span>
                          </th>
                          <td>{{ request('password') }}</td>
                          <input type="hidden" name="password" value="{{ request('password') }}">
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
