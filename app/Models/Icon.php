<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;

class Icon extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
    ];

    public function uploadImage(UploadedFile $file=null) {
        if ($file) {
            $file->storeAs(
                config('system.icon.directory').'/'.$this->id,
                config('system.icon.image_file'),
                'public'
            );
        }
    }

    public function imageUrl() {
        return url(
            config('system.public_storage').'/'.
            config('system.icon.directory').'/'.
            $this->id.'/'.
            config('system.icon.image_file')
        );
    }

    public function hasImage() {
        return File::exists(
            config('system.public_storage').'/'.
            config('system.icon.directory').'/'.
            $this->id.'/'.
            config('system.icon.image_file')
        );
    }

}
