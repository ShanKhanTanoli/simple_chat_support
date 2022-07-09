<?php

namespace App\Helpers;

use DateTime;
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

    //Last message on a ticket
    public static function Last($ticket)
    {
        return Chat::where('support_ticket_id', $ticket)
            ->orderBy('created_at', 'desc')->first();
    }

    //Calculate last message time age on a ticket
    public static function LastCalculateTime($ticket)
    {
        if ($message = self::Last($ticket)) {
            $date2 = new DateTime($message->created_at);
            $diff = $date2->diff(now());
            $hours = $diff->h;
            return $hours + ($diff->days * 24);
        } else return false;
    }
}
