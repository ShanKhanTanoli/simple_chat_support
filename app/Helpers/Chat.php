<?php

namespace App\Helpers;

use App\Models\Chat as ChatModel;

class Chat
{

    //Find chat
    public static function Find($id)
    {
        return Chat::find($id);
    }

    //Find chat user
    public static function User($id)
    {
        return self::Find($id)->user;
    }

    //Search message with algolia
    public static function Search($query)
    {
        return ChatModel::search($query)->get();
    }
}
