<?php

namespace App\Http\Controllers\Api\Support;

use App\Helpers\Ticket;
use App\Helpers\Support;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupportTicketController extends Controller
{

    //View all tickets
    public function Tickets($token)
    {
        //If customer is authenticated
        if (Support::isAuthenticated($token)) {
            //Return tickets
            return response()->json([
                'tickets' => Ticket::All(),
            ], 200);
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Open a ticket when customer is authenticated
    public function OpenTicket(Request $request, $token)
    {
        //If customer is authenticated
        if ($customer = Support::isAuthenticated($token)) {
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
        $customer = Support::Find($ticket->user_id);
        $token = $customer->createToken('auth-token')->plainTextToken;
        //Return that ticket
        return response()->json([
            'ticket' => $ticket,
            'token' => $token,
            'message' => 'autenticated',
        ], 200);
    }


    //Mark as spam
    public function MarkSpam($ticket, $token)
    {
        //If customer is authenticated
        if (Support::isAuthenticated($token)) {
            //Find ticket
            if ($find_ticket = Ticket::Find($ticket)) {
                //Change status
                Ticket::MarkSpam($find_ticket);
                //Display that ticket
                return response()->json([
                    'ticket' => $ticket,
                    'message' => 'Marked as spam',
                ], 200);
            } else {
                //If ticket not found
                return response()->json([
                    'message' => 'ticket not found',
                ], 404);
            }
            //If customer is not authenticated then create and authenticate
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Mark as answered
    public function MarkAnswered($ticket, $token)
    {
        //If customer is authenticated
        if (Support::isAuthenticated($token)) {
            //Find ticket
            if ($find_ticket = Ticket::Find($ticket)) {
                //If marked as answered with email notification
                if (Ticket::MarkAnswered($find_ticket)) {
                    //Display that ticket
                    return response()->json([
                        'ticket' => $ticket,
                        'message' => 'Marked as answered',
                    ], 200);
                } else {
                    //If marked as answered is not executed
                    return response()->json([
                        'message' => 'please try again.something went wrong',
                    ], 404);
                }
            } else {
                //If ticket not found
                return response()->json([
                    'message' => 'ticket not found',
                ], 404);
            }
            //If customer is not authenticated then create and authenticate
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Mark as not answered
    public function MarkNotAnswered($ticket, $token)
    {
        //If customer is authenticated
        if (Support::isAuthenticated($token)) {
            //Find ticket
            if ($find_ticket = Ticket::Find($ticket)) {
                //Change status
                Ticket::MarkNotAnswered($find_ticket);
                //Display that ticket
                return response()->json([
                    'ticket' => $ticket,
                    'message' => 'Marked as not answered',
                ], 200);
            } else {
                //If ticket not found
                return response()->json([
                    'message' => 'ticket not found',
                ], 404);
            }
            //If customer is not authenticated then create and authenticate
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Mark as in progress
    public function MarkInProgress($ticket, $token)
    {
        //If customer is authenticated
        if (Support::isAuthenticated($token)) {
            //Find ticket
            if ($find_ticket = Ticket::Find($ticket)) {
                //Change status
                Ticket::MarkInProgress($find_ticket);
                //Display that ticket
                return response()->json([
                    'ticket' => $ticket,
                    'message' => 'Marked as in progress',
                ], 200);
            } else {
                //If ticket not found
                return response()->json([
                    'message' => 'ticket not found',
                ], 404);
            }
            //If customer is not authenticated then create and authenticate
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Ticket Search
    public function TicketSearch(Request $request, $token)
    {
        //If customer is authenticated
        if (Support::isAuthenticated($token)) {
            //Validate
            $validated = $request->validate([
                'query' => 'required|string',
            ]);
            //Tickets Search
            $tickets = Ticket::Search($validated['query']);
            //Return tickets
            return response()->json([
                'tickets' => $tickets,
            ], 200);
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }
}
