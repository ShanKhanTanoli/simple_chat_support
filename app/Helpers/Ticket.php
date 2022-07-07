<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use App\Mail\TicketAnswered;
use Illuminate\Support\Facades\Mail;
use App\Models\Ticket as TicketModel;

class Ticket
{
    //Agent will answer
    public static function Open($user, $support_type)
    {
        //Create ticket and return it
        return TicketModel::create([
            'ticket' => strtoupper(Str::random(10)),
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'support_type' => $support_type,
        ]);
    }

    //Find Ticket
    public static function Find($id)
    {
        return TicketModel::find($id);
    }

    //Find Ticket
    public static function FindByEmail($email)
    {
        return TicketModel::where('customer_email', $email)->first();
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
}
