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

    //Mark as in progress
    public static function MarkInProgress($ticket)
    {
        return $ticket->update([
            'status' => "in_progress",
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

    //Mark as not answered
    public static function MarkNotAnswered($ticket)
    {
        return $ticket->update([
            'status' => "not_answered",
        ]);
    }

    //Mark as spam
    public static function MarkSpam($ticket)
    {
        return $ticket->update([
            'status' => "spam",
        ]);
    }

    //View all tickets
    public static function All()
    {
        return SupportTicket::all();
    }

    //Find ticket
    public static function Find($id)
    {
        return SupportTicket::find($id);
    }

    //Find ticket user
    public static function User($id)
    {
        return self::Find($id)->user;
    }

    //Search ticket with algolia
    public static function Search($query)
    {
        return SupportTicket::search($query)->get();
    }
}
