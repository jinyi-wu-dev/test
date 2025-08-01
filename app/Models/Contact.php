<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Prefecture;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'name',
        'kana',
        'postal_code',
        'prefecture',
        'country',
        'city',
        'area',
        'building',
        'phone_number',
        'company',
        'department',
        'type',
        'contents',
    ];
    protected function casts(): array
    {
        return [
            'prefecture' => Prefecture::class,
        ];
    }
}
