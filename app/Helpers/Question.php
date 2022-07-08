<?php

namespace App\Helpers;

use App\Models\Question as QuestionModel;

class Question
{
    //Write a Question
    public static function Start($user, $ticket, $body)
    {
        //Return this Question
        return QuestionModel::create([
            'user_id' => $user->id,
            'support_ticket_id' => $ticket->id,
            'body' => $body,
        ]);
    }

    //Find Question
    public static function Find($id)
    {
        return QuestionModel::find($id);
    }

    //Find question user
    public static function User($id)
    {
        return self::Find($id)->user;
    }

    //Search question with algolia
    public static function Search($query)
    {
        return QuestionModel::search($query)->get();
    }
}
