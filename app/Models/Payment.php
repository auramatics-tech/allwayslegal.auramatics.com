<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'paypal_id',
        'appointment_id',
        'price',
        'status',
        'order_date',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function Lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }

}
