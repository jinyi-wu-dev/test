<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\DimmableControl;
use App\Traits\FileUploadable;
use App\Traits\HasCompositePrimaryKey;

class ControllerItem extends Model
{
    use FileUploadable;
    use HasCompositePrimaryKey;

    protected $primaryKey = ['item_id', 'language'];

    public $incrementing = false;
    
    protected $fillable = [
        'item_id',
        'language',
        'type',
        'total_capacity',
        'num_of_ch',
        'input',
        'output',
        'dimmable_control',
        'is_external_switch',
        'is_ethernet',
        'is_8bit_parallel',
        'is_10bit_parallel',
        'is_rs232c',
        'is_analog',
        'description1',
        'description2',
        'description3',
        'description4',
        'description5',
        'note',
    ];

    protected $casts = [
        'dimmable_control'  => DimmableControl::class,
    ];

    public function __construct($attributes = []) {
        parent::__construct($attributes);
        $this->initializeFileUpload('item', 'item_id', ['language']);
    }

    public function externalDimmingControlsLabel() {
    }
}
