<?php

namespace App\Http\Controllers\Api\Support;

use App\Helpers\Chat;
use App\Helpers\Reply;
use App\Helpers\Ticket;
use App\Helpers\Message;
use App\Helpers\Support;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupportChatController extends Controller
{
    //View all chat
    public function Chat($ticket, $token)
    {
        //If customer is authenticated
        if ($support = Support::isAuthenticated($token)) {
            //Find ticket
            if ($find_ticket = Ticket::Find($ticket)) {
                //Return chats
                return response()->json([
                    'chat' => $find_ticket->chats,
                ], 404);
                //If not found
            } else {
                //Return error
                return response()->json([
                    'message' => 'ticket not found',
                ], 404);
            }
            //Return customer tickets
            return response()->json([
                'tickets' => $support->tickets,
            ], 200);
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Message on a ticket
    public function Message(Request $request, $ticket, $token)
    {
        //If customer is authenticated
        if ($support = Support::isAuthenticated($token)) {
            //Find ticket
            if ($find_ticket = Ticket::Find($ticket)) {
                //Validate
                $validated = $request->validate([
                    'body' => 'required|string',
                ]);
                //Return message
                return response()->json([
                    'message' => Message::To($support, $find_ticket, $validated['body']),
                ], 200);
                //If not found
            } else {
                //Return error
                return response()->json([
                    'message' => 'ticket not found',
                ], 404);
            }
            //Return customer tickets
            return response()->json([
                'tickets' => $support->tickets,
            ], 200);
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Reply on a ticket
    public function Reply(Request $request, $message, $ticket, $token)
    {
        //If customer is authenticated
        if ($support = Support::isAuthenticated($token)) {
            //Find ticket
            if ($find_ticket = Ticket::Find($ticket)) {
                //Find message
                if ($find_message = Ticket::Message($find_ticket->id, $message)) {
                    //Validate
                    $validated = $request->validate([
                        'body' => 'required|string',
                    ]);
                    //Return reply
                    return response()->json([
                        'reply' => Reply::To($support, $find_ticket, $find_message->id, $validated['body']),
                    ], 200);
                    //If message not found
                } else {
                    //Return error
                    return response()->json([
                        'message' => 'message not found',
                    ], 404);
                }
                //If ticket not found
            } else {
                //Return error
                return response()->json([
                    'message' => 'ticket not found',
                ], 404);
            }
            //Return customer tickets
            return response()->json([
                'tickets' => $support->tickets,
            ], 200);
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Chat Search
    public function ChatSearch(Request $request, $token)
    {
        //If customer is authenticated
        if (Support::isAuthenticated($token)) {
            //Validate
            $validated = $request->validate([
                'query' => 'required|string',
            ]);
            //Chat Search
            $chats = Chat::Search($validated['query']);
            //Return chat
            return response()->json([
                'chats' => $chats,
            ], 200);
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }
}
