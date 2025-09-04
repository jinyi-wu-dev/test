<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\FileUploadable;
use App\Traits\HasCompositePrimaryKey;

class CableItemGroupDetail extends Model
{
    use FileUploadable;
    use HasCompositePrimaryKey;

    protected $primaryKey = ['cable_item_group_id', 'language'];

    public $incrementing = false;
    
    protected $fillable = [
        'cable_item_group_id',
        'language',
        'description1',
        'description2',
        'description3',
        'description4',
        'description5',
        'note',
    ];

    public function __construct($attributes = []) {
        parent::__construct($attributes);
        $this->initializeFileUpload('group', 'cable_item_group_id', ['language']);
    }
}
