<?php

namespace App\Models;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = ["user_id", "ticket_id", "body"];


    //Thread has many messages
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    //Thread belongs to ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    //Thread belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
