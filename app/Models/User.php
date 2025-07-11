<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\Prefecture;

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
            'prefecture' => Prefecture::class,
            'password' => 'hashed',
        ];
    }

    public function positionsString($lang='ja', $dlmt=',') {
        $texts = [];
        $conf = config('enums.'.$lang.'.position');
        foreach ($this->positions as $pos) {
            $texts[] = $conf[$pos];
        }
        return implode($dlmt, $texts);
    }

    public function industriesString($lang='ja', $dlmt=',') {
        $texts = [];
        $conf = config('enums.'.$lang.'.industry');
        foreach ($this->industries as $pos) {
            $texts[] = $conf[$pos];
        }
        return implode($dlmt, $texts);
    }

    public function occupationesString($lang='ja', $dlmt=',') {
        $texts = [];
        $conf = config('enums.'.$lang.'.occupation');
        foreach ($this->occupationes as $pos) {
            $texts[] = $conf[$pos];
        }
        return implode($dlmt, $texts);
    }

    public function getPositionsAttribute() {
        return $this->attributes['positions'] ? explode(',', $this->attributes['positions']) : [];
    }
    
    public function getIndustriesAttribute() {
        return $this->attributes['industries'] ? explode(',', $this->attributes['industries']) : [];
    }
    
    public function getOccupationesAttribute() {
        return $this->attributes['occupationes'] ? explode(',', $this->attributes['occupationes']) : [];
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
