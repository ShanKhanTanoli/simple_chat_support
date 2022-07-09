<?php

namespace App\Helpers;

use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

class Support
{
    //If support is tokenable
    public static function isTokenable($token)
    {
        //Find token
        $find_token = PersonalAccessToken::findToken($token);
        if ($find_token) {
            return $find_token->tokenable;
        } else return false;
    }

    //Check if support is authenticated
    public static function isAuthenticated($token)
    {
        //If support is tokenable
        if ($support = self::isTokenable($token)) {
            //If role is support
            if ($support->role == "support") {
                //Return support
                return $support;
            } else return false;
            //If support not found
        } else return false;
    }

    //Find support
    public static function Find($support)
    {
        return User::find($support)
            ->where('role', 'support')
            ->first();
    }
}
