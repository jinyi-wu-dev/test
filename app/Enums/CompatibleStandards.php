<?php

namespace App\Enums;

use App\Traits\EnumKeyValiable;

enum CompatibleStandards: string
{
    use EnumKeyValiable;

    case RoHS           = 'RoHS';
    case RoHS2          = 'RoHS2';
    case CN_RoHS_E1     = 'CN_RoHS_e1';
    case CN_RoHS_102    = 'CN_RoHS_102';
    case CE_IEC         = 'CE_IEC';
    case CE_EN          = 'CE_EN';
    case UKCA           = 'UKCA';

    public function label(): string {
        return match($this) {
            Category::LIGHTING      => '照明',
            Category::CONTROLLER    => 'コントロラー',
            Category::CABLE         => 'ケーブル',
            Category::ACCESSALY     => 'オプション',
        };
    }
}


