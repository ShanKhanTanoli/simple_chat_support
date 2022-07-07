<?php

namespace App\Helpers;

use App\Models\Thread as ThreadModel;

class Thread
{
    //Write a thread
    public static function Start($user, $ticket, $body)
    {
        //Return this thread
        return ThreadModel::create([
            'user_id' => $user->id,
            'ticket_id' => $ticket->id,
            'body' => $body,
        ]);
    }

    //Find Thread
    public static function Find($id)
    {
        return ThreadModel::find($id);
    }
}
