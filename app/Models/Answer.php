<?php

namespace App\Models;

use App\Models\User;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ["question_id","user_id", "body"];

    //Answer belongs to question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    //Answer belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
