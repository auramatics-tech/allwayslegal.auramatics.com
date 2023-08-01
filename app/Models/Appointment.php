<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'start_time',
        'end_time',   
        'lawyer_id',
        'lawyer_name',
        'practice_area',
        'service_id',
        'service_title',
        'client_name',
        'client_email',
        'case_title',
        'case_note',
        'case_file',
        'cancelled_at'
    ];

    protected $casts = [
        'date' => 'datetime',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'cancelled_at' => 'datetime'
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
            $model->token = Str::random(32);
        });
    }

    public function scopeNotCancelled(Builder $builder)
    {
        $builder->whereNull('cancelled_at');
    }

    public function isCancelled()
    {
        return !is_null($this->cancelled_at);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function Lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }
    
}
