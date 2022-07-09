<?php

namespace App\Helpers;

use App\Models\Chat;

class Message
{
    //Send a message
    public static function To($user, $ticket, $body)
    {
        //Return this
        return Chat::create([
            'user_id' => $user->id,
            'support_ticket_id' => $ticket->id,
            'body' => $body,
        ]);
    }
}
