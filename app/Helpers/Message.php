<?php

namespace App\Helpers;

use App\Models\Message as MessageModel;

class Message
{
    //Reply to that thread
    public static function Send($ticket, $thread, $user, $body)
    {
        //If status is not in_progress then update the status
        if ($ticket->status !== "in_progress") {
            //Update Ticket Status
            $ticket->update(['status' => 'in_progress']);
        }

        //Return this message
        return MessageModel::create([
            'thread_id' => $thread->id,
            'user_id' => $user->id,
            'body' => $body,
        ]);
    }


    //Find Message
    public static function Find($id)
    {
        return MessageModel::find($id);
    }
}
