<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use App\Traits\FileUploadable;

class FeatureDetail extends Model
{
    use FileUploadable;

    protected $fillable = [
        'feature_id',
        'language',
        'title',
        'body',
    ];

    public function __construct($attributes = []) {
        parent::__construct($attributes);
        $this->initializeFileUpload('feature', 'feature_id', ['language']);
    }
}
