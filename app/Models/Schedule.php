<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ScheduleUnavailability;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'lawyer_id',
        'date',
        'start_time',
        'end_time'
    ];

    protected $casts = [
        // This grabs the data from the database as carbon instances/objects so we could easily manipulate them
        'lawyer_id' => 'integer',
        'date' => 'datetime',
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];
    
    protected $dates = ['date', 'start_time', 'end_time'];
    // protected $dates = ['start_time'];
    // protected $dates = ['end_time'];
    // public function lawyers()
    // {  
    //     return $this->hasMany(Lawyer::class);
    // }

    public function unavailabilities() 
    {
        return $this->hasMany(ScheduleUnavailability::class);
    }
}
