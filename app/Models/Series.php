<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Icon;
use App\Models\Feature;
use App\Models\Item;
use App\Models\CableItemGroup;
use App\Enums\Category;
use App\Enums\Genre;
use App\Traits\FileUploadable;

class Series extends Model
{
    use SoftDeletes;
    use FileUploadable;

    protected $fillable = [
        'category',
        'genre',
        'model',
        'is_new',
        'is_end',
        'is_publish',
        'show_type',
        'show_model',
        'show_product_number',
        'show_weight',
        'show_other',
        'show_compatible_standards',
        'show_luminous_color',
        'show_lt_num_of_ch',
        'show_power_consumption',
        'show_seg',
        'show_input_voltage',
        'show_dimming_controll',
        'show_total_capacity',
        'show_ct_num_of_ch',
        'show_input',
        'show_output',
        'show_external_onoff',
        'show_external_dimming_control',
        'show_throughput',
        'memo',
    ];

    protected $casts = [
        'category'  => Category::class,
        'genre'     => Genre::class,
    ];

    public function __construct($attributes = []) {
        parent::__construct($attributes);
        $this->initializeFileUpload('series');
    }

    public function scopeLighting($query) {
        return $query->where('category', Category::LIGHTING);
    }

    public function scopeController($query) {
        return $query->where('category', Category::CONTROLLER);
    }

    public function scopeCable($query) {
        return $query->where('category', Category::CABLE);
    }

    public function scopeOption($query) {
        return $query->where('category', Category::OPTION);
    }

    public function details() {
        return $this->hasMany(SeriesDetail::class, 'series_id');
    }

    /*
    public function detail() {
        return $this->hasOne(SeriesDetail::class, 'series_id');
    }
     */

    public function japanese_detail() {
        return $this->hasOne(SeriesDetail::class, 'series_id')->where('language', config('system.language.default'));
    }

    public function locale_detail() {
        return $this->hasOne(SeriesDetail::class, 'series_id')->where('language', app()->getLocale());
    }

    public function icons() {
        return $this->belongsToMany(Icon::class, 'series_icon')->withTimestamps();
    }

    public function features() {
        return $this->belongsToMany(Feature::class, 'series_feature')->withTimestamps();
    }

    public function items() {
        return $this->hasMany(Item::class, 'series_id');
    }

    public function cable_item_groups() {
        return $this->hasMany(CableItemGroup::class, 'series_id');
    }

}
