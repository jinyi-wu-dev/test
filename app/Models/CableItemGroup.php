<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Series;
use App\Models\Item;
use App\Models\CableItemGroupDetail;
use App\Traits\FileUploadable;

class CableItemGroup extends Model
{
    use SoftDeletes;
    use FileUploadable;

    protected $table = 'cable_item_groups';
    protected $fillable = [
        'series_id',
        'item_ids',
        'lighting_connector',
        'power_connector',
    ];

    protected $casts = [
        'item_ids' => 'array',
    ];

    public function __construct($attributes = []) {
        parent::__construct($attributes);
        $this->initializeFileUpload('group');
    }

    /**
     * Scope
     */

    /**
     * Relation
     */
    public function series() {
        return $this->belongsTo(Series::class);
    }

    public function details() {
        return $this->hasMany(CableItemGroupDetail::class, 'cable_item_group_id');
    }

    public function locale_detail() {
        return $this->hasOne(CableItemGroupDetail::class, 'cable_item_group_id')->where('language', app()->getLocale());
    }

    public function japanese_detail() {
        return $this->hasOne(CableItemGroupDetail::class, 'cable_item_group_id')->where('language', config('system.language.default'));
    }

    /**
     * ETC
     *
     */
    private $_items = null;
    public function items() {
        if ($this->_items==null) {
            if ($this->item_ids) {
                $this->_items = Item::whereIn('id', $this->item_ids)->get();
            } else {
                $this->_items = [];
            }
        }
        return $this->_items;
    }

    private $_first_item = null;
    public function first_item() {
        if ($this->_first_item==null) {
            if ($this->item_ids) {
                $this->_first_item = Item::whereIn('id', $this->item_ids)->first();
            }
        }
        return $this->_first_item;
    }

    public function addItem($id) {
        $item_ids = $this->item_ids;
        if (!$item_ids) {
            $item_ids = [$id];
        } else {
            array_push($item_ids, $id);
        }
        $this->item_ids = $item_ids;
    }

    public function removeItems($ids) {
        $this->item_ids = array_diff($this->item_ids, $ids);
    }

}
