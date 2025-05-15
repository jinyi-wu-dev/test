<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feture extends Model
{
    protected $fillable = [
        'feature_id',
        'language',
        'title',
        'body',
    ];
}
