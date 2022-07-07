<?php

namespace App\Helpers;

use App\Models\Question as QuestionModel;

class Question
{
    //Write a Question
    public static function Start($user, $body)
    {
        //Return this Question
        return QuestionModel::create([
            'user_id' => $user->id,
            'body' => $body,
        ]);
    }

    //Find Question
    public static function Find($id)
    {
        return QuestionModel::find($id);
    }
}
