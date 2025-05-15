<?php

namespace App\Enums;

use App\Traits\EnumKeyValiable;

enum Line: string
{
    use EnumKeyValiable;

    case VERTICAL   = 'vertical';
    case HORIZONTAL = 'horizontal';

    public function label(): string {
        return match($this) {
            Line::VERTICAL      => 'タテ並び',
            Line::HORIZONTAL    => 'ヨコ並び',
        };
    }
}


