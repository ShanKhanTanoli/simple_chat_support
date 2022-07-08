<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\TicketAnswered;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
            'ticket' => strtoupper("#" . Str::random(10)),
            'user_id' => $customer->id,
            'support_type' => $support_type,
        ]);
    }

    //Mark as answered
    public static function MarkAnswered($user, $ticket)
    {
        //pass the data to view
        $data = [
            'to' => $user->email,
            'subject' => 'Ticket Answered',
            'customer_name' => $user->name,
            'ticket' => $ticket->ticket,
            'support_type' => $ticket->support_type,
            'status' => "answered",
        ];

        //Send Notification Mail
        Mail::send(new TicketAnswered($data));
        return $ticket->update([
            'status' => "answered",
        ]);
    }

    //Mark as spam
    public static function MarkSpam($ticket)
    {
        return $ticket->update([
            'status' => "spam",
        ]);
    }

    //Find Ticket
    public static function Find($id)
    {
        return SupportTicket::find($id);
    }
}
