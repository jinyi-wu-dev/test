<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use App\Models\LightingItem;
use App\Models\ControllerItem;
use App\Models\CableItem;
use App\Models\OptionItem;
use App\Models\Icon;
use App\Models\Feature;
use App\Enums\Category;
use App\Traits\FileUploadable;

class Item extends Model
{
    use SoftDeletes;
    use FileUploadable;

    protected $fillable = [
        'series_id',
        'is_new',
        'is_end',
        'is_publish',
        'is_lend',
        'model',
        'product_number',
        'operating_temperature',
        'operating_humidity',
        'weight',
        'is_RoHS',
        'is_RoHS2',
        'is_CN_RoHSe1',
        'is_CN_RoHS102',
        'is_CE_IEC',
        'is_CE_EN',
        'is_UKCA',
        'is_PSE',
        'memo',
    ];

    public function __construct($attributes = []) {
        parent::__construct($attributes);
        $this->initializeFileUpload('item');
    }

    /**
     * Scope
     */
    public function scopeLightings($query) {
        return $query
            ->join('series', 'items.series_id', '=', 'series.id')
            ->where('series.category', Category::LIGHTING)
            ->select([
                'items.*',
            ]);
    }

    public function scopeControllers($query) {
        return $query
            ->join('series', 'items.series_id', '=', 'series.id')
            ->where('series.category', Category::CONTROLLER)
            ->select([
                'items.*',
            ]);
    }

    public function scopeCables($query) {
        return $query
            ->join('series', 'items.series_id', '=', 'series.id')
            ->where('series.category', Category::CABLE)
            ->select([
                'items.*',
            ]);
    }

    public function scopeOptions($query) {
        return $query
            ->join('series', 'items.series_id', '=', 'series.id')
            ->where('series.category', Category::OPTION)
            ->select([
                'items.*',
            ]);
    }

    /**
     * Relation
     */
    public function series() {
        return $this->belongsTo(Series::class);
    }

    public function lighting_items() {
        return $this->hasMany(LightingItem::class, 'item_id');
    }

    public function controller_items() {
        return $this->hasMany(ControllerItem::class, 'item_id');
    }

    public function cable_items() {
        return $this->hasMany(CableItem::class, 'item_id');
    }

    public function option_items() {
        return $this->hasMany(OptionItem::class, 'item_id');
    }

    public function japanese_lighting_item() {
        return $this->hasOne(LightingItem::class, 'item_id')->where('language', config('system.language.default'));
    }

    public function japanese_controller_item() {
        return $this->hasOne(ControllerItem::class, 'item_id')->where('language', config('system.language.default'));
    }

    public function japanese_cable_item() {
        return $this->hasOne(CableItem::class, 'item_id')->where('language', config('system.language.default'));
    }

    public function japanese_option_item() {
        return $this->hasOne(OptionItem::class, 'item_id')->where('language', config('system.language.default'));
    }

    public function locale_item() {
        return match($this->series->category) {
            Category::LIGHTING => $this->locale_lighting_item(),
            Category::CONTROLLER => $this->locale_controller_item(),
            Category::CABLE => $this->locale_cable_Item(),
            Category::OPTION => $this->locale_option_item(),
        };
    }

    public function locale_lighting_item() {
        return $this->hasOne(LightingItem::class, 'item_id')->where('language', app()->getLocale());
    }

    public function locale_controller_item() {
        return $this->hasOne(ControllerItem::class, 'item_id')->where('language', app()->getLocale());
    }

    public function locale_cable_Item() {
        return $this->hasOne(CableItem::class, 'item_id')->where('language', app()->getLocale());
    }

    public function locale_option_item() {
        return $this->hasOne(OptionItem::class, 'item_id')->where('language', app()->getLocale());
    }

    public function related_controllers() {
        return $this->belongsToMany(Series::class)
                    ->withPivot('category')
                    ->wherePivot('category', Category::CONTROLLER)
                    ->withTimestamps();
    }

    public function related_cables() {
        return $this->belongsToMany(Series::class)
                    ->withPivot('category')
                    ->wherePivot('category', Category::CABLE)
                    ->withTimestamps();
    }

    public function related_options() {
        return $this->belongsToMany(Series::class)
                    ->withPivot('category')
                    ->wherePivot('category', Category::OPTION)
                    ->withTimestamps();
    }

    public function isNew() {
        return ($this->series->is_new || $this->is_new);
    }

    public function isPublic() {
        return ($this->series->is_publish && $this->is_publish);
    }

    public function isDiscontinued() {
        return ($this->series->is_end || $this->is_end);
    }

    public function isLending() {
        return ($this->isPublic() && !$this->isDiscontinued() && $this->is_lend);
    }

}
