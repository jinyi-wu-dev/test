<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class LendItem extends Model
{
    protected $fillable = [
        'user_id',
        'remarks',
    ];

    public function items() {
        return $this->belongsToMany(Item::class, 'lend_item', 'lend_id', 'item_id')
                    ->withPivot('num_of_item')
                    ->withTimestamps();
    }

}
