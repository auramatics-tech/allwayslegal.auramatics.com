<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketChat extends Model
{   

    use HasFactory;

    protected $table = 'ticket_chat';
    public function user_detail()
    {
         return $this->hasOne(User::class,'id','user_id');
     }
}
