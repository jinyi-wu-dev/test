@extends('front/ja/base')


@section('title')
  <title>Leimac | お問合せ</title>
@endsection


@section('main')
    <!-- Site Main-->
    <main class="site-main" id="site-main">
      <!-- section-fv-->
      <section class="section section-fv">
        <div class="img"><img src="{{ asset('assets/img/page/fv-contact.png') }}" alt=""></div>
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
              <div class="article-block intro intro-contact">
                <h2 class="page-title">お問合せ</h2>
                <p>レイマックのホームページをご覧いただき、誠にありがとうございます。
                  <br>お問い合わせ、お見積もり、各種資料などについては迅速に対応しておりますので、お気軽に下記フォームよりお問い合わせください。
                </p>
                <p>オンライン商談をご希望の方は、お問い合わせ種別にて「オンライン商談のお申し込み」を選択いただき、お問合せ内容に「商談依頼内容」および「お客様のご希望日時」のご記入をお願いします。</p>
                <p>会員情報の変更や退会をご希望の方は<a href="{{ route('signin') }}">会員へログイン</a>の後に、お問い合わせ種別にて「会員情報の変更」を選択、お問い合わせ内容に変更内容または退会の旨をご記載ください。</p>
                <p>会員の方は<a href="{{ route('signin') }}">会員へログイン</a>してからお問い合わせいただけると項目入力の手間を省くことができます。
                  <br>LED照明総合カタログのダウンロードは<a href="{{ route('page', 'catalog') }}">こちら</a>より行えます。
                </p>
              </div>
              <div class="article-block form-block contact-block">
                <div class="row w1000">
                  <form class="mailform" action="{{ route('contact.confirm') }}" method="post">
                    @csrf
                    <table class="mailform-table">
                      <thead>
                        <tr>
                          <th colspan="2">(<span>*</span>入力必須項目）</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th class="required">
                            <span>お問い合せ先</span>
                          </th>
                          <td>
                            <div class="select type">
                              <select name="type" class="
                                @if($errors->has('type')) input-error @endif
                              ">
                                <option value=""></option>
                                @foreach(config('enums.ja.contacts') as $title)
                                  <option value="{{ $title }}"
                                  @if(old('type')==$title)
                                    selected
                                  @endif
                                  >{{ $title }}</option>
                                @endforeach
                              </select>
                              @if($errors->has('type'))
                                <span class="error" style="color: red; display: block;">▲{{ $errors->first('type') }}</span>
                              @endif
                              <span class="arrow"></span>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>お名前</span>
                          </th>
                          <td>
                            <input type="text" name="name" value="{{ old('name', $user->name??'') }}"
                              @if($errors->has('name')) class="input-error" @endif
                            >
                            @if($errors->has('name'))
                              <span class="error" style="color: red; display: block;">▲{{ $errors->first('name') }}</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th>
                            <span>フリガナ</span>
                          </th>
                          <td class="name">
                            <input type="text" name="kana" value="{{ old('kana', $user->kana??'') }}"
                              @if($errors->has('kana')) class="input-error" @endif
                            >
                            @if($errors->has('kana'))
                              <span class="error" style="color: red; display: block;">▲{{ $errors->first('kana') }}</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th>
                            <span>郵便番号</span>
                          </th>
                          <td>
                            <input type="text" name="postal_code" value="{{ old('postal_code', $user->postal_code??'') }}"
                              @if($errors->has('postal_code')) class="input-error" @endif
                            >
                            @if($errors->has('postal_code'))
                              <span class="error" style="color: red; display: block;">▲{{ $errors->first('postal_code') }}</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>都道府県</span>
                          </th>
                          <td>
                            <div class="select pref">
                              <select name="prefecture" class="mailform_text
                                @if($errors->has('prefecture')) input-error @endif
                              ">
                                <option value="" selected>都道府県を選択する</option>
                                @foreach(\App\Enums\Prefecture::cases() as $pref)
                                  <option value="{{ $pref->value }}" @if(old('prefecture', $user->prefecture->value??'')==$pref->value) selected @endif >{{ $pref->label() }}</option>
                                @endforeach
                              </select>
                              @if($errors->has('prefecture'))
                                <span class="error" style="color: red; display: block;">▲{{ $errors->first('prefecture') }}</span>
                              @endif
                              <span class="arrow"></span>
                            </div>
                            <span>
                              <input type="text" name="country" placeholder="海外選択の場合は国名をご記入ください" value="{{ old('country', $user->country??'') }}" class="comment
                                @if($errors->has('country')) input-error @endif
                              ">
                              @if($errors->has('country'))
                                <span class="error" style="color: red; display: block;">▲{{ $errors->first('country') }}</span>
                              @endif
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>市町村区</span>
                          </th>
                          <td>
                            <input type="text" name="city" value="{{ old('city', $user->city??'') }}"
                              @if($errors->has('city')) class="input-error" @endif
                            >
                            @if($errors->has('city'))
                              <span class="error" style="color: red; display: block;">▲{{ $errors->first('city') }}</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th>
                            <span>番地</span>
                          </th>
                          <td>
                            <input type="text" name="area" value="{{ old('area', $user->area??'') }}"
                              @if($errors->has('area')) class="input-error" @endif
                            >
                            @if($errors->has('area'))
                              <span class="error" style="color: red; display: block;">▲{{ $errors->first('area') }}</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th>
                            <span>ビル名</span>
                          </th>
                          <td>
                            <input type="text" name="building" value="{{ old('building', $user->building??'') }}"
                              @if($errors->has('building')) class="input-error" @endif
                            >
                            @if($errors->has('building'))
                              <span class="error" style="color: red; display: block;">▲{{ $errors->first('building') }}</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>電話番号</span>
                          </th>
                          <td>
                            <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number??'') }}"
                              @if($errors->has('phone_number')) class="input-error" @endif
                            >
                            @if($errors->has('phone_number'))
                              <span class="error" style="color: red; display: block;">▲{{ $errors->first('phone_number') }}</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>会社名</span>
                          </th>
                          <td>
                            <input type="text" name="company" value="{{ old('company', $user->company??'') }}"
                              @if($errors->has('company')) class="input-error" @endif
                            >
                            @if($errors->has('company'))
                              <span class="error" style="color: red; display: block;">▲{{ $errors->first('company') }}</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>部署・所属名</span>
                          </th>
                          <td>
                            <input type="text" name="department" value="{{ old('department', $user->department??'') }}"
                              @if($errors->has('department')) class="input-error" @endif
                            >
                            @if($errors->has('department'))
                              <span class="error" style="color: red; display: block;">▲{{ $errors->first('department') }}</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>Emailアドレス</span>
                          </th>
                          <td>
                            <input type="text" name="email" value="{{ old('email', $user->email??'') }}"
                              @if($errors->has('email')) class="input-error" @endif
                            >
                            @if($errors->has('email'))
                              <span class="error" style="color: red; display: block;">▲{{ $errors->first('email') }}</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>お問合わせ内容</span>
                          </th>
                          <td>
                            <textarea name="contents" rows="8" cols="80"
                              @if($errors->has('contents')) class="input-error" @endif
                            >{{ old('contents') }}</textarea>
                            @if($errors->has('contents'))
                              <span class="error" style="color: red; display: block;">▲{{ $errors->first('contents') }}</span>
                            @endif
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="agree">
                      <span>
                        <label>
                          <input type="checkbox" name="agree" value="agree"
                            @if($errors->has('agree')) class="input-error" @endif
                          >
                          <span class="agree-text">個人情報保護方針に同意します</span>
                          @if($errors->has('agree'))
                            <span class="error" style="color: red; display: block;">▲{{ $errors->first('agree') }}</span>
                          @endif
                        </label>
                      </span>
                    </div>
                    <div class="btn--slide text-center">
                      <button type="submit">
                        <span>確認</span>
                      </button>
                    </div>
                    <div class="policy-box">
                      <h2>個人情報保護方針</h2>
                      <p>お客様から取得した会社名、部署名、お名前、電話番号、メールアドレス、ご住所等の個人情報・機密情報（その他お客様からいただいた情報のうち個人情報・機密情報に該当するものを含む）及びお問い合わせの内容の利用目的は、次のとおりです。</p>
                      <p>ご意見、ご要望、お問い合わせへの対応及び確認 / 各種資料の送付 / 商材、サービスの改善</p>
                      <p>当社は、お客様の個人情報・機密情報の流出・漏洩の防止、その他情報の安全管理のために必要かつ適切な措置を講じるものとし、法令等に正当な理由がある場合を除き、お客様の同意なく目的外での利用及び第三者への提供は行いません。</p>
                    </div>
                  </form>
                </div>
              </div>
              <div class="article-block tel-block">
                <div class="row w1000">
                  <div class="title">
                    <h2>TEL・FAX でのお問い合せ</h2>
                    <span>（平日8：45－17：30）</span>
                  </div>
                  <div class="tel-list">
                    <dl>
                      <dt>レイマック総合窓口</dt>
                      <dd>
                        <span class="tel-list-item">
                          <span>tel.</span>077-585-6767
                        </span>
                        <span class="tel-list-item">
                          <span>fax.</span>077-585-6790
                        </span>
                      </dd>
                    </dl>
                    <dl>
                      <dt>LED照明機器</dt>
                      <dd>
                        <span class="tel-list-item">
                          <span>tel.</span>077-585-6771
                        </span>
                        <span class="tel-list-item">
                          <span>fax.</span>077-585-6773
                        </span>
                      </dd>
                    </dl>
                    <dl>
                      <dt>FAシステム・OEM/ODM
                        <br>ヘルスケア
                      </dt>
                      <dd>
                        <span class="tel-list-item">
                          <span>tel.</span>077-585-6770
                        </span>
                        <span class="tel-list-item">
                          <span>fax.</span>077-585-6790
                        </span>
                      </dd>
                    </dl>
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
