<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Client extends Model
{   
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'city',
        'province',
        'postal',
        'phone',
        'business',
        'position'
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function user() 
    {
        return $this->belongsTo('App\Models\User');
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
