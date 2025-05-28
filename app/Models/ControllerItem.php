<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Enums\DimmableControl;

class ControllerItem extends Model
{
    protected $primaryKey = ['item_id', 'language'];

    public $incrementing = false;
    
    protected $fillable = [
        'item_id',
        'language',
        'type',
        'total_capacity',
        'num_of_ch',
        'input',
        'output',
        'dimmable_control',
        'external_control',
        'is_ethernet',
        'is_8bit_parallel',
        'is_10bit_parallel',
        'is_rs232c',
        'is_analog',
        'description1',
        'description2',
        'description3',
        'description4',
        'description5',
        'note',
    ];

    protected $casts = [
        'dimmable_control'  => DimmableControl::class,
    ];
}
