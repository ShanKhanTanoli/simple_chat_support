<?php

namespace App\Helpers;

use App\Models\Answer as AnswerModel;

class Answer
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

    //Start answering
    public static function Start($ticket, $question, $user, $body)
    {
        //change ticket status to in progress
        self::TicketInProgress($ticket, $user);
        //Return this Answer
        return AnswerModel::create([
            'question_id' => $question->id,
            'user_id' => $user->id,
            'body' => $body,
        ]);
    }

    //Find Answer
    public static function Find($id)
    {
        return AnswerModel::find($id);
    }

    //Search answer with algolia
    public static function Search($query)
    {
        return AnswerModel::search($query)->get();
    }
}
