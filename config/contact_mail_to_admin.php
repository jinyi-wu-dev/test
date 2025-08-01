<?php

$body = <<<BODY
レイマック製品案内サイトサイトより、以下の内容でお問合せを受け付けました。  
────────────────────────
■ お問合せ情報

【お問合せ日時】：{date}
【お問合せ先】：{type}

【お名前】：{name} 様  
【フリガナ】：{kana}
【郵便番号】：〒{postal_code}
【ご住所】：{prefecture}{city}{area}{building}
【電話番号】：{phone_number}
【会社名】：{company}
【部署・所属】：{department}
【Emailアドレス】：{email}

【お問合せ内容】：
{contents}

────────────────────────
BODY;

return [
    'subject'   => '【レイマック製品案内サイト】お問合せ受付のお知らせ',
    'to'        => 'led_sales@leimac.jp',
    'body'      => $body,
];

