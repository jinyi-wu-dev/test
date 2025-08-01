<?php

namespace App\Enums;

use App\Traits\EnumKeyValiable;

enum Prefecture: string
{
    use EnumKeyValiable;

    case HOKKAIDO = "hokkaido";
    case AOMORI = "aomori";
    case IWATE = "iwate";
    case MIYAGI = "miyagi";
    case AKITA = "akita";
    case YAMAGATA = "yamagata";
    case FUKUSHIMA = "fukushima";
    case IBARAKI = "ibarki";
    case TOCHIGI = "tochigi";
    case GUNMA = "gunma";
    case SAITAMA = "saitama";
    case CHIBA = "chiba";
    case TOKYO = "tokyo";
    case KANAGAWA = "kanagawa";
    case NIIGATA = "niigata";
    case TOYAMA = "toyama";
    case ISHIKAWA = "ishikawa";
    case FUKUI = "fukui";
    case YAMANASHI = "yamanashi";
    case NAGANO = "nagano";
    case GIFU = "gifu";
    case SHIZUOKA = "shizuoka";
    case AICHI = "aichi";
    case MIE = "mie";
    case SHIGA = "shiga";
    case KYOTO = "kyoto";
    case OSAKA = "oosaka";
    case HYOGO = "hyogo";
    case NARA = "nara";
    case WAKAYAMA = "wakayama";
    case TOTTORI = "tottori";
    case SHIMANE = "shimane";
    case OKAYAMA = "okayama";
    case HIROSHIMA = "hiroshima";
    case YAMAGUCHI = "yamaguchi";
    case TOKUSHIMA = "tokushima";
    case KAGAWA = "kagawa";
    case EHIME = "ehime";
    case KOCHI = "kochi";
    case FUKUOKA = "fukuoka";
    case SAGA = "saga";
    case NAGASAKI = "nagasaki";
    case KUMAMOTO = "kumamoto";
    case OITA = "oita";
    case MIYAZAKI = "miyazaki";
    case KAGOSHIMA = "kagosima";
    case OKINAWA = "okinawa";
    case FOREIGN = "foreign";
    case UNKNOWN = "";

    public function label(): string {
        return match($this) {
            self::HOKKAIDO => "北海道",
            self::AOMORI => "青森県",
            self::IWATE => "岩手県",
            self::MIYAGI => "宮城県",
            self::AKITA => "秋田県",
            self::YAMAGATA => "山形県",
            self::FUKUSHIMA => "福島県",
            self::IBARAKI => "茨城県",
            self::TOCHIGI => "栃木県",
            self::GUNMA => "群馬県",
            self::SAITAMA => "埼玉県",
            self::CHIBA => "千葉県",
            self::TOKYO => "東京県",
            self::KANAGAWA => "神奈川県",
            self::NIIGATA => "新潟県",
            self::TOYAMA => "富山県",
            self::ISHIKAWA => "石川県",
            self::FUKUI => "福井県",
            self::YAMANASHI => "山梨県",
            self::NAGANO => "長野県",
            self::GIFU => "岐阜県",
            self::SHIZUOKA => "静岡県",
            self::AICHI => "愛知県",
            self::MIE => "三重県",
            self::SHIGA => "滋賀県",
            self::KYOTO => "京都県",
            self::OSAKA => "大阪県",
            self::HYOGO => "兵庫県",
            self::NARA => "奈良県",
            self::WAKAYAMA => "和歌山県",
            self::TOTTORI => "鳥取県",
            self::SHIMANE => "島根県",
            self::OKAYAMA => "岡山県",
            self::HIROSHIMA => "広島県",
            self::YAMAGUCHI => "山口県",
            self::TOKUSHIMA => "徳島県",
            self::KAGAWA => "香川県",
            self::EHIME => "愛媛県",
            self::KOCHI => "高知県",
            self::FUKUOKA => "福岡県",
            self::SAGA => "佐賀県",
            self::NAGASAKI => "長崎県",
            self::KUMAMOTO => "熊本県",
            self::OITA => "大分県",
            self::MIYAZAKI => "宮崎県",
            self::KAGOSHIMA => "鹿児島県",
            self::OKINAWA => "沖縄県",
            self::FOREIGN => "海外",
            self::UNKNOWN => "",
        };
    }
}


