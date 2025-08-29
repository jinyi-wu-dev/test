@extends('front/ja/base')


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
              <div class="article-block intro">
                <h2 class="page-title">新規会員登録（無料）</h2>
                <p>登録していただくことで、各種サービスをご利用頂けます。</p>
                <p>会員ご登録時の注意事項について
                  <br>レイマックのホームページをご覧いただき、誠にありがとうございます。
                  <br>この度セキュリティー強化のため、ホームページの会員登録システムの変更を行いました。
                  <br>それに伴いフリーメールアドレスからのご登録ができませんのでご注意下さい。
                  <br>現在、フリーメールアドレスにてご登録をされてるお客様におきましては、今後各種サービスがご利用いただけなくなります。
                  <br>お手数をおかけし申し訳ございませんが、再度会員登録を行ってくださいますようお願い申し上げます。
                  <br>今後、より安心してお使いいただけるウェブサイトとなるよう進めて参りますのでよろしくお願いいたします。
                </p>
              </div>
              <div class="article-block form-block register-block">
                <div class="row w1000">
                  <form class="mailform" method="post" action="{{ route('signup.confirm') }}">
                    @csrf

                    {{--
                    @foreach ($errors->all() as $error)
                      <div>{{ $error }}</div>
                    @endforeach
                    --}}

                    <table class="mailform-table">
                      <thead>
                        <th colspan="2">(<span>*</span>入力必須項目）</th>
                      </thead>
                      <tbody>
                        <tr>
                          <th class="required">
                            <span>お名前</span>
                          </th>
                          <td>
                            <input type="text" name="name" value="{{ old('name') }}"
                              @if($errors->has('name')) class="input-error" @endif
                            >
                            @if($errors->has('name'))
                            <span class="error" style="color: red; display: block;">▲{{ $errors->first('name') }}</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>フリガナ</span>
                          </th>
                          <td>
                            <input type="text" name="kana" value="{{ old('kana') }}"
                              @if($errors->has('kana')) class="input-error" @endif
                            >
                            @if($errors->has('kana'))
                              <span class="error" style="color: red; display: block;">▲{{ $errors->first('kana') }}</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>郵便番号</span>
                          </th>
                          <td>
                            <input type="text" name="postal_code" value="{{ old('postal_code') }}"
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
                                  <option value="{{ $pref->value }}" @if(old('prefecture')==$pref->value) selected @endif >{{ $pref->label() }}</option>
                                @endforeach
                              </select>
                              @if($errors->has('prefecture'))
                                <span class="error" style="color: red; display: block;">▲{{ $errors->first('prefecture') }}</span>
                              @endif
                              <span class="arrow"></span>
                            </div>
                            <span>
                              <input type="text" name="country" placeholder="海外選択の場合は国名をご記入ください" value="{{ old('country') }}" class="comment
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
                            <input type="text" name="city" value="{{ old('city') }}"
                              @if($errors->has('city')) class="input-error" @endif
                            >
                            @if($errors->has('city'))
                              <span class="error" style="color: red; display: block;">▲{{ $errors->first('city') }}</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>番地</span>
                          </th>
                          <td>
                            <input type="text" name="area" value="{{ old('area') }}"
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
                            <input type="text" name="building" value="{{ old('building') }}"
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
                            <input type="text" name="phone_number" value="{{ old('phone_number') }}"
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
                            <input type="text" name="company" value="{{ old('company') }}"
                              @if($errors->has('company')) class="input-error" @endif
                            >
                            @if($errors->has('company'))
                              <span class="error" style="color: red; display: block;">▲{{ $errors->first('company') }}</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>部署</span>
                          </th>
                          <td>
                            <input type="text" name="department" value="{{ old('department') }}"
                              @if($errors->has('department')) class="input-error" @endif
                            >
                            @if($errors->has('department'))
                              <span class="error" style="color: red; display: block;">▲{{ $errors->first('department') }}</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>役職</span>
                          </th>
                          <td>
                            <div class="checkbox-block col03">
                              @foreach (config('enums.ja.position') as $val => $label)
                                <label class="checkbox-label">
                                  <input type="checkbox" name="positions[]" value="{{ $val }}" @if(in_array($val, old('positions')??[])) checked @endif equired>
                                  <span class="checkbox-text"></span>{{ $label }}
                                </label>
                              @endforeach
                              @if($errors->has('positions'))
                                <span class="error" style="color: red; display: block;">▲{{ $errors->first('positions') }}</span>
                              @endif
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>業種</span>
                          </th>
                          <td>
                            <div class="checkbox-block col02">
                              @foreach (config('enums.ja.industry') as $val => $label)
                                <label class="checkbox-label">
                                  <input type="checkbox" name="industries[]" value="{{ $val }}" @if(in_array($val, old('industries')??[])) checked @endif equired>
                                  <span class="checkbox-text"></span>{{ $label }}
                                </label>
                              @endforeach
                              @if($errors->has('industries'))
                                <span class="error" style="color: red; display: block;">▲{{ $errors->first('industries') }}</span>
                              @endif
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>職種</span>
                          </th>
                          <td>
                            <div class="checkbox-block col02">
                              @foreach (config('enums.ja.occupation') as $val => $label)
                                <label class="checkbox-label">
                                  <input type="checkbox" name="occupationes[]" value="{{ $val }}" @if(in_array($val, old('occupationes')??[])) checked @endif equired>
                                  <span class="checkbox-text"></span>{{ $label }}
                                </label>
                              @endforeach
                              @if($errors->has('occupationes'))
                                <span class="error" style="color: red; display: block;">▲{{ $errors->first('occupationes') }}</span>
                              @endif
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <th class="equired">
                            <span>Emailアドレス</span>
                          </th>
                          <td>
                            <input type="text" name="email" value="{{ old('email') }}"
                              @if($errors->has('email')) class="input-error" @endif
                            >
                            @if($errors->has('email'))
                              <span class="error" style="color: red; display: block;">▲{{ $errors->first('email') }}</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th class="equired">
                            <span>Emailアドレス（確認用）</span>
                          </th>
                          <td>
                            <input type="text" name="email_confirmation"
                              @if($errors->has('email_confirm')) class="input-error" @endif
                            >
                            @if($errors->has('email_confirm'))
                              <span class="error" style="color: red; display: block;">▲{{ $errors->first('email_confirm') }}</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>パスワード</span>
                          </th>
                          <td>
                            <div class="input show-password-wrap">
                              <input type="password" name="password" value="{{ old('password') }}"
                                @if($errors->has('password')) class="input-error" @endif
                              >
                              <span class="show-password"></span>
                              @if($errors->has('password'))
                                <span class="error" style="color: red; display: block;">▲{{ $errors->first('password') }}</span>
                              @endif
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>パスワード（確認用）</span>
                          </th>
                          <td>
                            <div class="input show-password-wrap">
                              <input type="password" name="password_confirmation"
                                @if($errors->has('password_confirm')) class="input-error" @endif
                              >
                              <span class="show-password"></span>
                              @if($errors->has('password_confirm'))
                                <span class="error" style="color: red; display: block;">▲{{ $errors->first('password_confirm') }}</span>
                              @endif
                            </div>
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
                    <script>
                      /*
                      alert("OK");
                      document.addEventListener('DOMContentLoaded', function() {
                        const email = document.querySelector('input[name="email"]');
                        const emailConfirm = document.querySelector('input[name="email_confirm"]');
                        const password = document.querySelector('input[name="login_password"]');
                        const passwordConfirm = document.querySelector('input[name="login_password_confirm"]');
                        const form = email.closest('form');

                        // エラーメッセージ表示用
                        function setError(input, message) {
                          input.setCustomValidity(message);
                          input.reportValidity();
                        }

                        // 入力が一致するかをチェック
                        function validateMatch(input1, input2, message) {
                          if (input1.value !== input2.value) {
                            setError(input2, message);
                          } else {
                            input2.setCustomValidity('');
                          }
                        }

                        // リアルタイムチェック
                        emailConfirm.addEventListener('input', () => {
                          validateMatch(email, emailConfirm, 'メールアドレスが一致しません');
                        });

                        passwordConfirm.addEventListener('input', () => {
                          validateMatch(password, passwordConfirm, 'パスワードが一致しません');
                        });

                        // 送信時の最終チェック
                        form.addEventListener('submit', function(e) {
                          validateMatch(email, emailConfirm, 'メールアドレスが一致しません');
                          validateMatch(password, passwordConfirm, 'パスワードが一致しません');

                          if (!form.checkValidity()) {
                            e.preventDefault();
                          }
                        });
                      });
                      */
                    </script>



                  </form>
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
