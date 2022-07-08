<?php

namespace App\Models;

use App\Models\Answer;
use App\Models\Question;
use App\Models\SupportTicket;
use Laravel\Scout\Searchable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //User has many tickets
    public function tickets()
    {
        return $this->hasMany(SupportTicket::class);
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
