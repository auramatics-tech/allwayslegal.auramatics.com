<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawyerService extends Model
{   
    protected $table = 'lawyer_service';
    protected $fillable = [
        'service_id',
        'lawyer_id'
    ];

    use HasFactory;

}
