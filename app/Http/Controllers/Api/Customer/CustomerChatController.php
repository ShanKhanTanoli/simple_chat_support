<?php

namespace App\Http\Controllers\Api\Customer;

use App\Helpers\Ticket;
use App\Helpers\Message;
use App\Helpers\Customer;
use App\Helpers\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerChatController extends Controller
{
    //View all chat
    public function Chat($ticket, $token)
    {
        //If customer is authenticated
        if ($customer = Customer::isAuthenticated($token)) {
            //Find ticket
            if ($find_ticket = Customer::Ticket($customer->id, $ticket)) {
                //Return chats
                return response()->json([
                    'chat' => $find_ticket->chats,
                ], 404);
                //If not found
            } else {
                //Return error
                return response()->json([
                    'message' => 'ticket does not exist',
                ], 404);
            }
            //Return customer tickets
            return response()->json([
                'tickets' => $customer->tickets,
            ], 200);
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Message on a ticket
    public function Message(Request $request, $ticket, $token)
    {
        //If customer is authenticated
        if ($customer = Customer::isAuthenticated($token)) {
            //Find ticket
            if ($find_ticket = Customer::Ticket($customer->id, $ticket)) {
                //Validate
                $validated = $request->validate([
                    'body' => 'required|string',
                ]);
                //Return message
                return response()->json([
                    'message' => Message::To($customer, $find_ticket, $validated['body']),
                ], 200);
                //If not found
            } else {
                //Return error
                return response()->json([
                    'message' => 'ticket does not exist',
                ], 404);
            }
            //Return customer tickets
            return response()->json([
                'tickets' => $customer->tickets,
            ], 200);
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Reply on a ticket
    public function Reply(Request $request, $message, $ticket, $token)
    {
        //If customer is authenticated
        if ($customer = Customer::isAuthenticated($token)) {
            //Find ticket
            if ($find_ticket = Customer::Ticket($customer->id, $ticket)) {
                //Find message
                if ($find_message = Ticket::Message($find_ticket->id, $message)) {
                    //Validate
                    $validated = $request->validate([
                        'body' => 'required|string',
                    ]);
                    //Return reply
                    return response()->json([
                        'reply' => Reply::To($customer, $find_ticket, $find_message->id, $validated['body']),
                    ], 200);
                    //If message not found
                } else {
                    //Return error
                    return response()->json([
                        'message' => 'message does not exist',
                    ], 404);
                }
                //If ticket not found
            } else {
                //Return error
                return response()->json([
                    'message' => 'ticket does not exist',
                ], 404);
            }
            //Return customer tickets
            return response()->json([
                'tickets' => $customer->tickets,
            ], 200);
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }
}
