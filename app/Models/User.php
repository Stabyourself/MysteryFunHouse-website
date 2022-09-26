<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'username',
        'discriminator',
        'email',
        'avatar',
        'verified',
        'locale',
        'mfa_enabled',
        'refresh_token',

        "slug",
        "challonge_username",
        "twitch",
        "pronouns",
        "timezone",
        "availability",
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var boolean
     */
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'refresh_token',
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function events()
    {
        return $this->belongsToMany(Event::class, "signups")->withTimestamps()->withPivot("flavor");
    }

    public function impairments()
    {
        return $this->belongsToMany(Impairment::class)->withTimestamps();
    }
}
