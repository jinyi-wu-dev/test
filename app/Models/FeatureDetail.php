<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;

class FeatureDetail extends Model
{
    protected $fillable = [
        'feature_id',
        'language',
        'title',
        'body',
    ];

    public function uploadImage(UploadedFile $file=null) {
        if ($file) {
            $file->storeAs(
                sprintf('%s/%d',
                    config('system.feature.directory'),
                    $this->feature_id
                ),
                sprintf(config('system.feature.image_file'), $this->language),
                'public'
            );
        }
    }

    public function hasImage() {
        return File::exists(sprintf('%s/%s/%d/%s',
            config('system.public_storage'),
            config('system.feature.directory'),
            $this->feature_id,
            sprintf(config('system.feature.image_file'), $this->language)
        ));
    }

    public function imageUrl() {
        return url(sprintf('%s/%s/%d/%s',
            config('system.public_storage'),
            config('system.feature.directory'),
            $this->feature_id,
            sprintf(config('system.feature.image_file'), $this->language)
        ));
    }
}
