<?php

namespace App\Models;

use App\Models\User;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupportTicket extends Model
{
    use HasFactory;

    protected $fillable = ['ticket','user_id', 'support_type', 'status'];

    //Ticket belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //User has many questions
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    //User has many answers
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
