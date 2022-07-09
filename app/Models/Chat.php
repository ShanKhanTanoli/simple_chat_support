<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Chat extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['user_id', 'support_ticket_id', 'parent_id', 'body'];


    //Self relation for maintaining thread
    public function messages()
    {
        return $this->hasMany(Chat::class, 'parent_id');
    }

    //Self relation for maintaining thread
    public function thread()
    {
        return $this->belongsTo(Chat::class, 'parent_id');
    }
}
