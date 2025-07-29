<?php

namespace App\Enums;

use App\Traits\EnumKeyValiable;

enum DimmableControl: string
{
    use EnumKeyValiable;

    case NONE               = '';
    case PWM                = 'pwm';
    case VARIABLE_CURRENT   = 'variable_current';
    case VARIABLE_VOLTAGE   = 'variable_voltage';
    case OVERDRIVE          = 'overdrive';

    public function label(): string {
        return match($this) {
            self::NONE              => '',
            self::PWM               => 'PWM方式',
            self::VARIABLE_CURRENT  => '電流可変方式',
            self::VARIABLE_VOLTAGE  => '電圧可変方式',
            self::OVERDRIVE         => 'オーバードライブ',
        };
    }
}


