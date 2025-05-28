<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CableItem extends Model
{
    protected $primaryKey = ['item_id', 'language'];

    public $incrementing = false;
    
    protected $fillable = [
        'item_id',
        'language',
        'type',
    ];

}
