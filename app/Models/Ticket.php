<?php

namespace App\Models;

use App\Models\User;
use App\Models\Thread;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['ticket', 'status', 'customer_name', 'customer_email', 'support_type'];


    //Ticket has many messages
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    //Ticket has many threads
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    //Ticket belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
