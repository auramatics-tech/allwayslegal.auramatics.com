<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawyerArea extends Model
{   
    protected $table = 'area_lawyer';
    protected $fillable = [
        'area_id',
        'lawyer_id'
    ];

    use HasFactory;

}
