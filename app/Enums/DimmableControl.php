<?php

namespace App\Enums;

use App\Traits\EnumKeyValiable;

enum DimmableControl: string
{
    use EnumKeyValiable;

    case NONE       = '';
    case PWM        = 'pwm';
    case V_CURRENT  = 'variable_current';
    case V_VOLTAGE  = 'variable_voltage';
    case OVERDRIVE  = 'overdrive';

    public function label(): string {
        return match($this) {
            DimmableControl::NONE       => '',
            DimmableControl::PWM        => 'PWM方式',
            DimmableControl::V_CURRENT  => '電流可変方式',
            DimmableControl::V_VOLTAGE  => '電圧可変方式',
            DimmableControl::OVERDRIVE  => 'オーバードライブ',
        };
    }
}


