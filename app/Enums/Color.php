<?php

namespace App\Enums;

use App\Traits\EnumKeyValiable;

enum Color: string
{
    use EnumKeyValiable;

    case WHITE          = 'white';
    case BLUE           = 'blue';
    case GREEN          = 'green';
    case YELLOW         = 'yellow';
    case RED            = 'red';
    case FULL_COLOR     = 'full_color';
    case MULTI_COLOR    = 'multi_color';
    case IR_UNDER_1000  = 'ir_u1000';
    case IR_OVER_1000   = 'ir_o1000';
    case UV             = 'uv';
    case UV_DUV         = 'uv_duv';

    public function label($lang='ja'): string {
        return match($lang) {
            'ja' => match($this) {
                self::WHITE         => '白',
                self::BLUE          => '青',
                self::GREEN         => '緑',
                self::YELLOW        => '黄',
                self::RED           => '赤',
                self::FULL_COLOR    => 'フルカラーRGB',
                self::MULTI_COLOR   => '7色マルチカラー',
                self::IR_UNDER_1000 => 'IR（～1000nm）',
                self::IR_OVER_1000  => 'IR（1000nm～）',
                self::UV            => 'UV',
                self::UV_DUV        => 'UV（深紫外）',
            }
        };
    }
}


