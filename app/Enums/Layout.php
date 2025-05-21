<?php

namespace App\Enums;

use App\Traits\EnumKeyValiable;

enum Layout: string
{
    use EnumKeyValiable;

    case VERTICAL   = 'vertical';
    case HORIZONTAL = 'horizontal';

    public function label(): string {
        return match($this) {
            Layout::VERTICAL      => 'タテ並び',
            Layout::HORIZONTAL    => 'ヨコ並び',
        };
    }
}


