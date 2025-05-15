<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeriesDetail extends Model
{
    protected $primaryKey = ['series_id', 'language'];

    public $incrementing = false;
    
    protected $fillable = [
        'series_id',
        'language',
        'name',
        'model',
        'body1',
        'body2',
        'body3',
        'note',
    ];
}
