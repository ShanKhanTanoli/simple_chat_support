<?php

namespace App\Http\Controllers\Api\Customer;

use App\Models\User;
use App\Helpers\Ticket;
use App\Helpers\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerTicketController extends Controller
{

    //View all tickets
    public function Tickets($token)
    {
        //If customer is authenticated
        if ($customer = Customer::isAuthenticated($token)) {
            //Retuen customer tickets
            return response()->json([
                'tickets' => $customer->tickets,
            ], 200);
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Open a ticket when customer is authenticated
    public function OpenTicket(Request $request, $token)
    {
        //If customer is authenticated
        if ($customer = Customer::isAuthenticated($token)) {
            //Validate
            $validated = $request->validate([
                'support_type' => 'required|string',
            ]);
            //Open a new ticket
            $ticket = Ticket::Open($customer->name, $customer->email, $validated['support_type']);
            //Display that ticket
            return response()->json([
                'ticket' => $ticket,
            ], 200);
            //If customer is not authenticated then create and authenticate
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Open a new ticket when customer is not authenticated
    public function NewTicket(Request $request)
    {
        //Validate
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'support_type' => 'required|string',
        ]);
        //Open a new ticket
        $ticket = Ticket::Open($validated['name'], $validated['email'], $validated['support_type']);
        //Find a customer
        $customer = Customer::Find($ticket->user_id);
        $token = $customer->createToken('auth-token')->plainTextToken;
        //Return that ticket
        return response()->json([
            'ticket' => $ticket,
            'token' => $token,
            'message' => 'autenticated',
        ], 200);
    }
}
