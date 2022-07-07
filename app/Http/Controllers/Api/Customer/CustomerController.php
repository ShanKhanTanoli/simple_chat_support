<?php

namespace App\Http\Controllers\Api\Customer;

use App\Models\User;
use App\Helpers\Thread;
use App\Helpers\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Ticket as ModelsTicket;
use Laravel\Sanctum\PersonalAccessToken;

class CustomerController extends Controller
{

    //Check if the customer is not registered
    public static function RegisterCustomer($name, $email)
    {
        //If user found then return it
        if ($user = User::where('email', $email)->first()) {
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

    //Check if token is available Or is tokenable
    public static function Tokenable($token)
    {
        $find_token = PersonalAccessToken::findToken($token);
        if ($find_token) {
            return $find_token->tokenable;
        } else return false;
    }

    //View all tickets
    public function Tickets($token)
    {
        //If user is tokenable
        if ($user = self::Tokenable($token)) {
            //Display User Tickets
            return response()->json([
                'tickets' => ModelsTicket::where('customer_email', $user->email)->get(),
            ], 200);
            //If User not found
        } else return response()->json([
            'message' => 'Not found',
        ], 404);
    }

    //Check if ticket belongs to specific customer
    public static function IsMyTicket($email)
    {
        if ($ticket = Ticket::FindByEmail($email)) {
            return $ticket;
        } else return false;
    }

    //Open a new ticket
    public function OpenTicket(Request $request, $token)
    {
        //If user is tokenable
        if ($user = self::Tokenable($token)) {
            //Validate
            $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'support_type' => 'required|string',
            ]);
            //Get user
            $user = self::RegisterCustomer($validated['name'], $validated['email']);
            //Open a new ticket
            $ticket = Ticket::Open($user, $validated['support_type']);
            //Display that ticket
            return response()->json([
                'ticket' => $ticket,
            ], 200);
            //If User not found
        } else return response()->json([
            'message' => 'Not found',
        ], 404);
    }

    //Write a thread
    public function WriteThread(Request $request, $ticket, $token)
    {
        //If user is tokenable
        if ($user = self::Tokenable($token)) {
            //Validate
            $validated = $request->validate([
                'body' => 'required|string',
            ]);
            //Check if this is my ticket
            $find = self::IsMyTicket($user->email);
            //If this is my own ticket and the ticket i am looking for
            if ($find && $find->id == $ticket) {
                //Thread
                $thread = Thread::Start($user, $find, $validated['body']);
                //Display that thread
                return response()->json([
                    'thread' => $thread,
                ], 200);
                //If not my ticket
            } else return response()->json([
                'message' => 'Something went wrong',
            ], 404);
            //If User not found
        } else return response()->json([
            'message' => 'Not found',
        ], 404);
    }

    //View all threads
    public function threads($token)
    {
        //If user is tokenable
        if ($user = self::Tokenable($token)) {
            //Display User Tickets
            return response()->json([
                'threads' => $user->threads,
            ], 200);
            //If User not found
        } else return response()->json([
            'message' => 'Not found',
        ], 404);
    }

    //View all messages
    public function messages($token)
    {
        //If user is tokenable
        if ($user = self::Tokenable($token)) {
            //Display User Tickets
            return response()->json([
                'messages' => $user->messages,
            ], 200);
            //If User not found
        } else return response()->json([
            'message' => 'Not found',
        ], 404);
    }

        //Reply to a thread
        public function threadreply(Request $request, $ticket, $token)
        {
            //If user is tokenable
            if ($user = self::Tokenable($token)) {
                //Validate
                $validated = $request->validate([
                    'body' => 'required|string',
                ]);
                //Check if this is my ticket
                $find = self::IsMyTicket($user->email);
                //If this is my own ticket and the ticket i am looking for
                if ($find && $find->id == $ticket) {
                    //Thread
                    $thread = Thread::Start($user, $find, $validated['body']);
                    //Display that thread
                    return response()->json([
                        'thread' => $thread,
                    ], 200);
                    //If not my ticket
                } else return response()->json([
                    'message' => 'Something went wrong',
                ], 404);
                //If User not found
            } else return response()->json([
                'message' => 'Not found',
            ], 404);
        }
}
