<?php

namespace App\Enums;

use App\Traits\EnumKeyValiable;

enum Genre: string
{
    use EnumKeyValiable;

    case NONE               = '';
    case LT_LINE            = 'lt_line';
    case LT_RING            = 'lt_ring';
    case LT_TRANSMISSION    = 'lt_transmission';
    case LT_FLATSURFACE     = 'lt_flatsurface';
    case LT_DOME            = 'lt_dome';
    case LT_COAXIAL_SPOT    = 'lt_coaxial-spot';
    case LT_OTHER           = 'lt_other';
    case CR_AC_INPUT        = 'cr_ac_input';
    case CR_DC_INPUT        = 'cr_dc_input';
    case CR_PoE_INPUT       = 'cr_poe_input';
    case CR_EX_AND_SP       = 'cr_ex_and_sp';
    case CB_LIGHTING        = 'cb_lighting';
    case CB_EXTERNAL        = 'cb_external';
    case OP_LIGHTING        = 'op_lighting';
    case OP_OTHER           = 'op_other';

    public function label(): string {
        return match($this) {
            self::NONE              => '',
            self::LT_LINE           => config('enums.system.genre.lt_line'),
            self::LT_RING           => config('enums.system.genre.lt_ring'),
            self::LT_TRANSMISSION   => config('enums.system.genre.lt_transmission'),
            self::LT_FLATSURFACE    => config('enums.system.genre.lt_flatsurface'),
            self::LT_DOME           => config('enums.system.genre.lt_dome'),
            self::LT_COAXIAL_SPOT   => config('enums.system.genre.lt_coaxial'),
            self::LT_OTHER          => config('enums.system.genre.lt_other'),
            self::CR_AC_INPUT       => config('enums.system.genre.cr_ac_input'),
            self::CR_DC_INPUT       => config('enums.system.genre.cr_dc_input'),
            self::CR_PoE_INPUT      => config('enums.system.genre.cr_poe_input'),
            self::CR_EX_AND_SP      => config('enums.system.genre.cr_ex_and_sp'),
            self::CB_LIGHTING       => config('enums.system.genre.cb_lighting'),
            self::CB_EXTERNAL       => config('enums.system.genre.cb_external'),
            self::OP_LIGHTING       => config('enums.system.genre.op_lighting'),
            self::OP_OTHER          => config('enums.system.genre.op_other'),
        };
    }
}


