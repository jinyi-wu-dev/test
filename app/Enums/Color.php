<?php

namespace App\Enums;

use App\Traits\EnumKeyValiable;

enum Color: string
{
    use EnumKeyValiable;

    case NONE           = '';
    case WHITE          = 'white';
    case BLUE           = 'blue';
    case GREEN          = 'green';
    case YELLOW         = 'yellow';
    case RED            = 'red';
    case FULL_COLOR     = 'full_color';
    case MULTI_COLOR    = 'multi_color';
    case IR_UNDER_1000  = 'ir_u1000';
    case IR_OVER_1000   = 'ir_o1000';
    case UV_UNDER_280   = 'uv_u280';
    case UV_OVER_280    = 'uv_o280';

    public function label($lang=null): string {
        if (!$lang) {
            $lang = app()->getLocale();
        }
        return match($lang) {
            'ja' => match($this) {
                self::NONE          => '',
                self::WHITE         => '白',
                self::BLUE          => '青',
                self::GREEN         => '緑',
                self::YELLOW        => '黄',
                self::RED           => '赤',
                self::FULL_COLOR    => 'フルカラーRGB',
                self::MULTI_COLOR   => '7色マルチカラー',
                self::IR_UNDER_1000 => 'IR（～1000nm）',
                self::IR_OVER_1000  => 'IR（1000nm～）',
                self::UV_UNDER_280  => 'UV（〜280nm）',
                self::UV_OVER_280   => 'UV（280nm〜）',
            },
            'en' => match($this) {
                self::NONE          => '',
                self::WHITE         => 'White',
                self::BLUE          => 'Blue',
                self::GREEN         => 'Green',
                self::YELLOW        => 'Yellow',
                self::RED           => 'Red',
                self::FULL_COLOR    => 'FullColorRGB',
                self::MULTI_COLOR   => 'MultiColor',
                self::IR_UNDER_1000 => 'IR（～1000nm）',
                self::IR_OVER_1000  => 'IR（1000nm～）',
                self::UV_UNDER_280  => 'UV（〜280nm）',
                self::UV_OVER_280   => 'UV（280nm〜）',
            }
        };
    }
}


