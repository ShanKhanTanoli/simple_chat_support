<?php

namespace App\Helpers;

use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

class Customer
{
    //If customer is tokenable
    public static function isTokenable($token)
    {
        //Find token
        $find_token = PersonalAccessToken::findToken($token);
        if ($find_token) {
            return $find_token->tokenable;
        } else return false;
    }

    //Check if customer is authenticated
    public static function isAuthenticated($token)
    {
        //If customer is tokenable
        if ($customer = self::isTokenable($token)) {
            //If role is customer
            if ($customer->role == "customer") {
                //Return customer
                return $customer;
            } else return false;
            //If customer not found
        } else return false;
    }

    //Find customer
    public static function Find($customer)
    {
        return User::find($customer)
            ->where('role', 'customer')
            ->first();
    }

    //Find customer tickets
    public static function Tickets($customer)
    {
        return User::find($customer)->tickets;
    }

    //Find customer ticket
    public static function Ticket($customer, $ticket)
    {
        return self::Tickets($customer)
            ->find($ticket);
    }
}
