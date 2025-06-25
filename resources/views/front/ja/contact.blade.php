@extends('front/ja/base')


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
                <p>会員情報の変更や退会をご希望の方は<a href="../login">会員へログイン</a>の後に、お問い合わせ種別にて「会員情報の変更」を選択、お問い合わせ内容に変更内容または退会の旨をご記載ください。</p>
                <p>会員の方は<a href="../login">会員へログイン</a>してからお問い合わせいただけると項目入力の手間を省くことができます。
                  <br>LED照明総合カタログのダウンロードは<a href="../">こちら</a>より行えます。
                </p>
              </div>
              <div class="article-block form-block contact-block">
                <div class="row w1000">
                  <form class="mailform">
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
                              <select name="type">
                                <option value="照明製品に関するお問い合せ" selected>照明製品に関するお問い合せ</option>
                                <option value="FAシステムに関するお問い合せ">FAシステムに関するお問い合せ</option>
                                <option value="ヘルスケア製品に関するお問い合せ">ヘルスケア製品に関するお問い合せ</option>
                                <option value="OEM/ODMに関するお問い合せ">OEM/ODMに関するお問い合せ</option>
                                <option value="【オンライン商談のお申し込み】照明機器">【オンライン商談のお申し込み】照明機器</option>
                                <option value="【オンライン商談のお申し込み】FAシステム">【オンライン商談のお申し込み】FAシステム</option>
                                <option value="【オンライン商談のお申し込み】ヘルスケア">【オンライン商談のお申し込み】ヘルスケア</option>
                                <option value="【オンライン商談のお申し込み】OEM/ODM">【オンライン商談のお申し込み】OEM/ODM</option>
                                <option value="会社に関するお問い合せ">会社に関するお問い合せ</option>
                                <option value="【会社見学会の参加希望】">【会社見学会の参加希望】</option>
                                <option value="【インターンシップの参加希望】">【インターンシップの参加希望】</option>
                                <option value="採用に関するお問い合せ">採用に関するお問い合せ</option>
                                <option value="ホームページに関するお問い合わせ">ホームページに関するお問い合わせ</option>
                                <option value="会員情報の変更">会員情報の変更</option>
                                <option value="その他お問い合わせ">その他お問い合わせ</option>
                              </select>
                              <span class="arrow"></span>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>お名前</span>
                          </th>
                          <td class="name">
                            <input type="text" name="name1" required>
                            <input type="text" name="name2" required>
                          </td>
                        </tr>
                        <tr>
                          <th>
                            <span>フリガナ</span>
                          </th>
                          <td class="name">
                            <input type="text" name="kana1">
                            <input type="text" name="kana2">
                          </td>
                        </tr>
                        <tr>
                          <th>
                            <span>郵便番号</span>
                          </th>
                          <td>
                            <input type="text" name="zip">
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>都道府県</span>
                          </th>
                          <td>
                            <div class="select pref">
                              <select class="mailform_text" name="pref">
                                <option value="" selected>都道府県を選択する</option>
                                <option value="北海道">北海道</option>
                                <option value="青森県">青森県</option>
                                <option value="岩手県">岩手県</option>
                                <option value="宮城県">宮城県</option>
                                <option value="秋田県">秋田県</option>
                                <option value="山形県">山形県</option>
                                <option value="福島県">福島県</option>
                                <option value="茨城県">茨城県</option>
                                <option value="栃木県">栃木県</option>
                                <option value="群馬県">群馬県</option>
                                <option value="埼玉県">埼玉県</option>
                                <option value="千葉県">千葉県</option>
                                <option value="東京都">東京都</option>
                                <option value="神奈川県">神奈川県</option>
                                <option value="新潟県">新潟県</option>
                                <option value="富山県">富山県</option>
                                <option value="石川県">石川県</option>
                                <option value="福井県">福井県</option>
                                <option value="山梨県">山梨県</option>
                                <option value="長野県">長野県</option>
                                <option value="岐阜県">岐阜県</option>
                                <option value="静岡県">静岡県</option>
                                <option value="愛知県">愛知県</option>
                                <option value="三重県">三重県</option>
                                <option value="滋賀県">滋賀県</option>
                                <option value="京都府">京都府</option>
                                <option value="大阪府">大阪府</option>
                                <option value="兵庫県">兵庫県</option>
                                <option value="奈良県">奈良県</option>
                                <option value="和歌山県">和歌山県</option>
                                <option value="鳥取県">鳥取県</option>
                                <option value="島根県">島根県</option>
                                <option value="岡山県">岡山県</option>
                                <option value="広島県">広島県</option>
                                <option value="山口県">山口県</option>
                                <option value="徳島県">徳島県</option>
                                <option value="香川県">香川県</option>
                                <option value="愛媛県">愛媛県</option>
                                <option value="高知県">高知県</option>
                                <option value="福岡県">福岡県</option>
                                <option value="佐賀県">佐賀県</option>
                                <option value="長崎県">長崎県</option>
                                <option value="熊本県">熊本県</option>
                                <option value="大分県">大分県</option>
                                <option value="宮崎県">宮崎県</option>
                                <option value="鹿児島県">鹿児島県</option>
                                <option value="沖縄県">沖縄県</option>
                                <option value="海外">海外</option>
                              </select>
                              <span class="arrow"></span>
                            </div>
                            <span>
                              <input class="comment" type="text" placeholder="海外選択の場合は国名をご記入ください">
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>市町村区</span>
                          </th>
                          <td>
                            <input type="text" name="city">
                          </td>
                        </tr>
                        <tr>
                          <th>
                            <span>番地</span>
                          </th>
                          <td>
                            <input type="text" name="area">
                          </td>
                        </tr>
                        <tr>
                          <th>
                            <span>ビル名</span>
                          </th>
                          <td>
                            <input type="text" name="addr">
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>電話番号</span>
                          </th>
                          <td>
                            <input type="text" name="tel">
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>会社名</span>
                          </th>
                          <td>
                            <input type="text" name="company">
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>部署・所属名</span>
                          </th>
                          <td>
                            <input type="text" name="department">
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>Emailアドレス</span>
                          </th>
                          <td>
                            <input type="text" name="email">
                          </td>
                        </tr>
                        <tr>
                          <th class="required">
                            <span>お問合わせ内容</span>
                          </th>
                          <td>
                            <textarea name="contents" rows="8" cols="80"></textarea>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="agree">
                      <span>
                        <label>
                          <input type="checkbox" name="agree" value="agree">
                          <span>個人情報保護方針に同意します</span>
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
