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

    public function label(): string {
        return match($this) {
            Category::LIGHTING      => '照明',
            Category::CONTROLLER    => 'コントロラー',
            Category::CABLE         => 'ケーブル',
            Category::OPTION        => 'オプション',
        };
    }
}


