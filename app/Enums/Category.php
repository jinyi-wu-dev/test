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
            Category::LIGHTING      => config('enums.system.category.lighting'),
            Category::CONTROLLER    => config('enums.system.category.controller'),
            Category::CABLE         => config('enums.system.category.cable'),
            Category::OPTION        => config('enums.system.category.option'),
        };
    }
}


