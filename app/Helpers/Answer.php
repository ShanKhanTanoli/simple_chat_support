<?php

namespace App\Helpers;

use App\Models\Answer as AnswerModel;

class Answer
{
    //Reply to that question
    public static function Start($question, $user, $body)
    {
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
}
