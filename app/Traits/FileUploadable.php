<?php

namespace app\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;

trait FileUploadable
{
    protected $_fu_model = null;
    protected $_fu_id = 'id';
    protected $file_name_replaces = null;

    protected function initializeFileUpload($model, $id=null, $replaces=null) {
        $this->_fu_model = $model;
        if ($id) {
            $this->_fu_id = $id;
        }
        $this->file_name_replaces = $replaces;
    } 

    protected function getFileName($type) {
        $name = config(sprintf('system.file.%s.%s', $this->_fu_model, $type));
        if ($this->file_name_replaces) {
            $keys = [];
            $values = [];
            foreach ($this->file_name_replaces as $key => $val) {
                $keys[] = '{'.$val.'}';
                $values[] = $this->{$val};
            }
            $name = str_replace($keys, $values, $name);
        }
        return $name;
    }
    
    public function uploadFile($type, UploadedFile $file=null) {
        if (config(sprintf('system.file.%s.%s', $this->_fu_model, $type))) {
            if ($file) {
                $file->storeAs(
                    sprintf('%s/%d', config(sprintf('system.file.%s.directory', $this->_fu_model)), $this->{$this->_fu_id}),
                    $this->getFileName($type),
                    'public'
                );
            }
        }
    }

    public function fileUrl($type) {
        return config(sprintf('system.file.%s.%s', $this->_fu_model, $type)) ?
            url(
                sprintf('%s/%s/%d/%s',
                    config('system.file.public_storage'),
                    config(sprintf('system.file.%s.directory', $this->_fu_model)),
                    $this->{$this->_fu_id},
                    $this->getFileName($type),
                )
            ) : 
            false;
    }

    public function hasFile($type) {
        return config(sprintf('system.file.%s.%s', $this->_fu_model, $type)) ?
            File::exists(
                sprintf('%s/%s/%d/%s',
                    config('system.file.public_storage'),
                    config(sprintf('system.file.%s.directory', $this->_fu_model)),
                    $this->{$this->_fu_id},
                    $this->getFileName($type),
                )
            ) :
            false;
    }

}
