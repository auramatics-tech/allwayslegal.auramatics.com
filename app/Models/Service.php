<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{   

    protected $fillable = [

        'title', 'duration',
        'price', 'service_fee',
        'service_fee_tax',
        'legal_fee',
        'legal_fee_tax',
        'description'
    ];

    use HasFactory;

    public function lawyers() 
    {
        return $this->belongsToMany('App\Models\Lawyer');
    }
    public function services()
    {
        return $this->belongsToMany('App\Models\Service');
    }
     protected function get_area_name()
    {
        return $this->hasOne(Area::class, 'id', 'practice_area_id')->latest();
    }
}
 