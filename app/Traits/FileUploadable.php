<?php

namespace app\Traits;

use Illuminate\Support\Facades\File;

trait FileUploadable
{
    protected $model = null;

    protected function setFileUploadModel($model) {
        $this->model = $model;
    } 
    
    public function uploadFile($type, UploadedFile $file=null) {
        if (config(sprintf('system.%s.%s', $this->model, $type))) {
            if ($file) {
                $file->storeAs(
                    sprintf('%s/%d', config(sprintf('system.%s.directory', $this->model)), $this->id),
                    config(sprintf('system.%s.%s', $this->model, $type)),
                    'public'
                );
            }
        }
    }

    public function fileUrl($type) {
        return config(sprintf('system.%s.%s', $this->model, $type)) ?
            url(
                sprintf('%s/%s/%d/%s',
                    config('system.public_storage'),
                    config(sprintf('system.%s.directory', $this->model)),
                    $this->id,
                    config(sprintf('system.%s.%s', $this->model, $type)),
                )
            ) : 
            false;
    }

    public function hasFile($type) {
        return config(sprintf('system.%s.%s', $this->model, $type)) ?
            File::exists(
                sprintf('%s/%s/%d/%s',
                    config('system.public_storage'),
                    config(sprintf('system.%s.directory', $this->model)),
                    $this->id,
                    config(sprintf('system.%s.%s', $this->model, $type)),
                )
            ) :
            false;
    }

}
