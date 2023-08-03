<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     * 
     */

     protected $table ='users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'city',
        'province',
        'country',
        'postal'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function setPasswordAttribute($password)
    // {
    //     $this->attributes['password'] = Hash::make($password);
    // }
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }
    public function lawyer()
    {
        return $this->hasOne('App\Models\Lawyer');
    }
    public function client()
    {
        return $this->hasOne('App\Models\Client');
    }
    public function get_country()
    {
        return $this->belongsTo(Country::class, 'country');
    }
    public function get_province()
    {
        return $this->belongsTo(State::class, 'province');
    }
    public function get_city()
    {
        return $this->belongsTo(City::class, 'city');
    }
}
