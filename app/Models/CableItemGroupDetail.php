<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CableItemGroupDetail extends Model
{
    protected $primaryKey = ['cable_item_group_id', 'language'];

    public $incrementing = false;
    
    protected $fillable = [
        'cable_item_group_id',
        'language',
        'description1',
        'description2',
        'description3',
        'description4',
        'description5',
        'note',
    ];

}
