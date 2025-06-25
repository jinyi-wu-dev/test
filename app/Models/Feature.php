<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\FeatureDetail;
use App\Enums\Layout;

class Feature extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'layout',
        'title',
    ];

    protected $casts = [
        'layout'  => Layout::class,
    ];

    public function details() {
        return $this->hasMany(FeatureDetail::class, 'feature_id');
    }

    public function japanese_detail() {
        return $this->hasOne(FeatureDetail::class, 'feature_id')->where('language', 'ja');
    }
}
