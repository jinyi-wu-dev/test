<?php

namespace App\Enums;

use App\Traits\EnumKeyValiable;

enum Category: string
{
    use EnumKeyValiable;

    case LIGHTING   = 'lighting';
    case CONTROLLER = 'controller';
    case CABLE      = 'cable';
    case ACCESSALY  = 'accessaly';

    public function label(): string {
        return match($this) {
            Category::LIGHTING      => '照明',
            Category::CONTROLLER    => 'コントロラー',
            Category::CABLE         => 'ケーブル',
            Category::ACCESSALY     => 'オプション',
        };
    }
}


