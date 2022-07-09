<?php

namespace App\Models;

use App\Models\User;
use App\Models\Chat;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupportTicket extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['ticket', 'user_id', 'support_type', 'status'];

    //Ticket belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //User has many chats
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}
