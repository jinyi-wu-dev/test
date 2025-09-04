<?php

namespace App\Enums;

use App\Traits\EnumKeyValiable;

enum Genre: string
{
    use EnumKeyValiable;

    case NONE               = '';
    case LT_LINE            = 'lt_line';
    case LT_RING            = 'lt_ring';
    case LT_TRANSMISSION    = 'lt_transmission';
    case LT_FLATSURFACE     = 'lt_flatsurface';
    case LT_DOME            = 'lt_dome';
    case LT_COAXIAL_SPOT    = 'lt_coaxial-spot';
    case LT_OTHER           = 'lt_other';
    case CR_AC_INPUT        = 'cr_ac_input';
    case CR_DC_INPUT        = 'cr_dc_input';
    case CR_PoE_INPUT       = 'cr_poe_input';
    case CR_EX_AND_SP       = 'cr_ex_and_sp';
    case CB_LIGHTING        = 'cb_lighting';
    case CB_EXTERNAL        = 'cb_external';
    case OP_LIGHTING        = 'op_lighting';
    case OP_OTHER           = 'op_other';

    public function label($lang=null): string {
        if (!$lang) {
            $lang = app()->getLocale();
        }
        return match($lang) {
            'ja' => match($this) {
                self::NONE              => '',
                self::LT_LINE           => 'ライン照明',
                self::LT_RING           => 'リング照明',
                self::LT_TRANSMISSION   => 'バー照明',
                self::LT_FLATSURFACE    => '透過・面照明',
                self::LT_DOME           => 'ドーム照明',
                self::LT_COAXIAL_SPOT   => '同軸・スポット照明',
                self::LT_OTHER          => 'その他照明',
                self::CR_AC_INPUT       => 'AC入力コントローラ',
                self::CR_DC_INPUT       => 'DC入力コントローラ',
                self::CR_PoE_INPUT      => 'PoE入力コントローラ',
                self::CR_EX_AND_SP      => '専用/特殊コントローラ',
                self::CB_LIGHTING       => '照明用ケーブル',
                self::CB_EXTERNAL       => '外部制御用ケーブル',
                self::OP_LIGHTING       => '照明用オプション',
                self::OP_OTHER          => 'その他オプション',
            },
            'en' => match($this) {
                self::NONE              => '',
                self::LT_LINE           => 'ライン照明',
                self::LT_RING           => 'リング照明',
                self::LT_TRANSMISSION   => 'バー照明',
                self::LT_FLATSURFACE    => '透過・面照明',
                self::LT_DOME           => 'ドーム照明',
                self::LT_COAXIAL_SPOT   => '同軸・スポット照明',
                self::LT_OTHER          => 'その他照明',
                self::CR_AC_INPUT       => 'AC入力コントローラ',
                self::CR_DC_INPUT       => 'DC入力コントローラ',
                self::CR_PoE_INPUT      => 'PoE入力コントローラ',
                self::CR_EX_AND_SP      => '専用/特殊コントローラ',
                self::CB_LIGHTING       => '照明用ケーブル',
                self::CB_EXTERNAL       => '外部制御用ケーブル',
                self::OP_LIGHTING       => '照明用オプション',
                self::OP_OTHER          => 'その他オプション',
            },
        };
    }
}


