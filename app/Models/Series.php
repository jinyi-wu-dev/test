<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use App\Models\Icon;
use App\Models\Feature;
use App\Enums\Category;
use App\Enums\Genre;

class Series extends Model
{
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
        'show_diming_controll',
        'show_total_capacity',
        'show_ct_num_of_ch',
        'show_input',
        'show_output',
        'show_external_onoff',
        'show_external_diming_control',
        'show_throughput',
        'memo',
    ];

    protected $casts = [
        'category'  => Category::class,
        'genre'     => Genre::class,
    ];

    public function jp_detail() {
        return $this->detail('jp');
    }

    public function details() {
        return $this->hasMany(SeriesDetail::class, 'series_id');
    }

    public function detail($language='jp') {
        return $this->hasOne(SeriesDetail::class, 'series_id')->where('language', $language);
    }

    public function icons() {
        return $this->belongsToMany(Icon::class, 'series_icon')->withTimestamps();
    }

    public function features() {
        return $this->belongsToMany(Feature::class, 'series_feature')->withTimestamps();
    }

    public function uploadFile($type, UploadedFile $file=null) {
        if (config('system.series.'.$type.'_file')) {
            if ($file) {
                $file->storeAs(
                    config('system.series.directory').'/'.$this->id,
                    config('system.series.'.$type.'_file'),
                    'public'
                );
            }
        }
    }

    public function fileUrl($type) {
        return config('system.series.'.$type.'_file') ? 
            url(
                config('system.public_storage').'/'.
                config('system.series.directory').'/'.
                $this->id.'/'.
                config('system.series.'.$type.'_file')
            ) : 
            false;
    }

    public function hasFile($type) {
        return config('system.series.'.$type.'_file') ? 
            File::exists(
                config('system.public_storage').'/'.
                config('system.series.directory').'/'.
                $this->id.'/'.
                config('system.series.'.$type.'_file')
            ) :
            false;
    }

}
