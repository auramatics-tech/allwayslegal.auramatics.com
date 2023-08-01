<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{   

    protected $fillable = [
        'name',
        'image',
        'description'
    ];

    use HasFactory;

    public function lawyers() 
    {
        return $this->belongsToMany('App\Models\Lawyer');
    }
}
