<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'name1',
        'name2',
        'kana1',
        'kana2',
        'postal_code',
        'prefecture',
        'country',
        'city',
        'area',
        'building',
        'phone_number',
        'company',
        'department',
        'positions',
        'industries',
        'occupationes',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function setPositionsAttribute($value) {
        $this->attributes['positions'] = is_array($value) ? implode(',', $value) : $value;
    }

    public function setIndustriesAttribute($value) {
        $this->attributes['industries'] = is_array($value) ? implode(',', $value) : $value;
    }

    public function setOccupationesAttribute($value) {
        $this->attributes['occupationes'] = is_array($value) ? implode(',', $value) : $value;
    }

}
