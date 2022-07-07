<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Hash;

class Ticket
{
    //Check if the customer is not registered
    public static function RegisterCustomer($name, $email)
    {
        //If user found then return it
        $user = User::where('email', $email)->where('role', 'customer')->first();
        if ($user) {
            return $user;
            //If user not found
        } else {
            //Create and return user
            return User::create([
                'name' => $name,
                'email' => $email,
                'role' => 'customer',
                'password' => Hash::make('password'),
            ]);
        }
    }

    //Open a new ticket
    public static function Open($name, $email, $support_type)
    {
        //If customer is not registered then create else get customer by email
        $customer = self::RegisterCustomer($name, $email);
        //Return this Ticket
        return SupportTicket::create([
            'user_id' => $customer->id,
            'support_type' => $support_type,
        ]);
    }

    //Find Ticket
    public static function Find($id)
    {
        return SupportTicket::find($id);
    }
}
