<?php

namespace App\Enums;

use App\Traits\EnumKeyValiable;

enum Category: string
{
    use EnumKeyValiable;

    case LIGHTING   = 'lighting';
    case CONTROLLER = 'controller';
    case CABLE      = 'cable';
    case OPTION     = 'option';

    public function label($lang=null): string {
        if (!$lang) {
            $lang = app()->getLocale();
        }
        return match($lang) {
            'ja' => match($this) {
                Category::LIGHTING      => '照明',
                Category::CONTROLLER    => 'コントローラー',
                Category::CABLE         => 'ケーブル',
                Category::OPTION        => 'オプション',
            },
            'en' => match($this) {
                Category::LIGHTING      => '照明',
                Category::CONTROLLER    => 'コントローラー',
                Category::CABLE         => 'ケーブル',
                Category::OPTION        => 'オプション',
            },
        };
    }
}


