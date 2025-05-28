<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionItem extends Model
{
    protected $primaryKey = ['item_id', 'language'];

    public $incrementing = false;
    
    protected $fillable = [
        'item_id',
        'language',
        'type',
        'throughput',
        'description1',
        'description2',
        'description3',
        'description4',
        'description5',
        'note',
    ];

}
