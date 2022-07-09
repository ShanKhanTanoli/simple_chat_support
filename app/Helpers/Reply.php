<?php

namespace App\Helpers;

use App\Models\Chat;

class Reply
{

    //change ticket status to in progresss
    public static function TicketInProgress($ticket, $user)
    {
        //If user role is support
        if ($user->role == "support") {
            //If ticket status is not answered
            if ($ticket->status == "not_answered") {
                return $ticket->update(['status' => 'in_progress',]);
            }
        }
    }

    //Reply to a message
    public static function To($user, $ticket, $parent_id, $body)
    {
        //Change ticket status to progress when start replying
        self::TicketInProgress($ticket, $user);
        //Return this
        return Chat::create([
            'user_id' => $user->id,
            'support_ticket_id' => $ticket->id,
            'parent_id' => $parent_id,
            'body' => $body,
        ]);
    }
}
