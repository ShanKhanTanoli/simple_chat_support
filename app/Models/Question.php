<?php

namespace App\Models;

use App\Models\User;
use App\Models\Answer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ["user_id","body"];


    //Thread has many answers
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    //Thread belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
