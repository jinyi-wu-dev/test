<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\FileUploadable;
use App\Traits\HasCompositePrimaryKey;
use App\Enums\Color;

class LightingItem extends Model
{
    use FileUploadable;
    use HasCompositePrimaryKey;

    protected $primaryKey = ['item_id', 'language'];

    public $incrementing = false;
    
    protected $fillable = [
        'item_id',
        'language',
        'type',
        'color',
        'color1',
        'color2',
        'power_consumption',
        'num_of_ch',
        'input',
        'etc',
        'description1',
        'description2',
        'description3',
        'description4',
        'description5',
        'note',
    ];

    protected $casts = [
        'color'  => Color::class,
    ];

    public function __construct($attributes = []) {
        parent::__construct($attributes);
        $this->initializeFileUpload('item', 'item_id', ['language']);
    }

}
