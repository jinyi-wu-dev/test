<?php

namespace App\Enums;

use App\Traits\EnumKeyValiable;

enum Genre: string
{
    use EnumKeyValiable;

    case LT_LINE            = 'lt_line';
    case LT_RING            = 'lt_ring';
    case LT_TRANSMISSION    = 'lt_transmission';
    case LT_FLATSURFACE     = 'lt_flatsurface';
    case LT_DOME            = 'lt_dome';
    case LT_COAXIAL_SPOT    = 'lt_coaxial-spot';
    case LT_OTHER           = 'lt_other';
    case CR_PWM             = 'cr_pwm';
    case CR_V_CURRENT       = 'cr_v_current';
    case CR_V_VOLTAGE       = 'cr_v_voltage';
    case CR_OVERDRIVE       = 'cr_overdrive';
    case CB_LIGHTING        = 'cb_lighting';
    case CB_EXTERNAL        = 'cb_external';
    case OP_LIGHTING        = 'op_lighting';
    case OP_OTHER           = 'op_other';

    public function label(): string {
        return match($this) {
            Genre::LT_LINE           => 'ライン照明',
            Genre::LT_RING           => 'リング照明',
            Genre::LT_TRANSMISSION   => 'バー照明',
            Genre::LT_FLATSURFACE    => '透過・面照明',
            Genre::LT_DOME           => 'ドーム照明',
            Genre::LT_COAXIAL_SPOT   => '同軸・スポット照明',
            Genre::LT_OTHER          => 'その他照明',
            Genre::CR_PWM            => 'PWMコントローラ',
            Genre::CR_V_CURRENT      => '電流可変コントローラ',
            Genre::CR_V_VOLTAGE      => '電圧可変コントローラ',
            Genre::CR_OVERDRIVE      => 'オーバードライブコントローラ',
            Genre::CB_LIGHTING       => '照明用ケーブル',
            Genre::CB_EXTERNAL       => '外部制御用ケーブル',
            Genre::OP_LIGHTING       => '照明用オプション',
            Genre::OP_OTHER          => 'その他オプション',
        };
    }
}


