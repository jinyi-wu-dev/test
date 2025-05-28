<?php

namespace App\Enums;

use App\Traits\EnumKeyValiable;

enum DimmableControll: string
{
    use EnumKeyValiable;

    case PWM        = 'pwm';
    case V_CURRENT  = 'variable_current';
    case V_VOLTAGE  = 'variable_voltage';
    case OVERDRIVE  = 'overdrive';

    public function label(): string {
        return match($this) {
            DimmableControll::LIGHTING      => 'PWM方式',
            DimmableControll::CONTROLLER    => '電流可変方式',
            DimmableControll::CABLE         => '電圧可変方式',
            DimmableControll::OPTION        => 'オーバードライブ',
        };
    }
}


