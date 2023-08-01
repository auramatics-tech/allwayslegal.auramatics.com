<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Conversation;
use App\Models\User;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [

        'sender_id',
        'appointment_id',
        'type',
        'body'

    ];

    public function conversation()
    {
        return $this->belongsTo(Message::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function user_detail()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }
}
