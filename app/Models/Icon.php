<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use App\Traits\FileUploadable;

class Icon extends Model
{
    use SoftDeletes;
    use FileUploadable;
    
    protected $fillable = [
        'title',
    ];

    public function __construct($attributes = []) {
        parent::__construct($attributes);
        $this->initializeFileUpload('icon');
    }

}
