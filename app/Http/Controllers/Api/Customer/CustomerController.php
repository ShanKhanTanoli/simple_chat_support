<?php

namespace App\Http\Controllers\Api\Customer;

use App\Helpers\Answer;
use App\Helpers\Question;
use App\Models\User;
use App\Helpers\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Sanctum\PersonalAccessToken;

class CustomerController extends Controller
{


    //Check if token is available Or is tokenable
    public static function tokenable($token)
    {
        //Find token
        $find_token = PersonalAccessToken::findToken($token);
        if ($find_token) {
            return $find_token->tokenable;
        } else return false;
    }

    //Check if customer is authenticated
    public static function authenticated($token)
    {
        //If user is tokenable
        if ($user = self::tokenable($token)) {
            //Return user
            return $user;
            //If user not found
        } else return false;
    }

    //View all tickets
    public function tickets($token)
    {
        //If user is authenticated
        if ($user = self::authenticated($token)) {
            //Display User Tickets
            return response()->json([
                'tickets' => $user->tickets,
            ], 200);
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Check if ticket belongs to customer
    public static function myticket($ticket, $user)
    {
        //If ticket found
        if ($find_ticket = Ticket::Find($ticket)) {
            //Get user from the ticket
            if ($find_ticket->user_id == $user->id) {
                return $find_ticket;
            } else return false;
        } else return false;
    }

    //Check if question belongs to customer
    public static function myquestion($question, $user)
    {
        //If question found
        if ($find_question = Question::Find($question)) {
            //Get user from the question
            if ($find_question->user_id == $user->id) {
                return $find_question;
            } else return false;
        } else return false;
    }

    //Open a ticket when user is authenticated
    public function openticket(Request $request, $token)
    {
        //If user is authenticated
        if ($user = self::authenticated($token)) {
            //Validate
            $validated = $request->validate([
                'support_type' => 'required|string',
            ]);
            //Open a new ticket
            $ticket = Ticket::Open($user->name, $user->email, $validated['support_type']);
            //Display that ticket
            return response()->json([
                'ticket' => $ticket,
            ], 200);
            //If user is not authenticated then create and authenticate
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Open a new ticket when user is not authenticated
    public function newticket(Request $request)
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
        $customer = User::find($ticket->user_id);
        $token = $customer->createToken('auth-token')->plainTextToken;
        //Display that ticket
        return response()->json([
            'ticket' => $ticket,
            'token' => $token,
            'message' => 'autenticated',
        ], 200);
    }

    //Ask a question
    public function askquestion(Request $request, $ticket, $token)
    {
        //If user is authenticated
        if ($user = self::authenticated($token)) {
            //If ticket is mine
            if ($find_ticket = self::myticket($ticket, $user)) {
                //Validate
                $validated = $request->validate([
                    'body' => 'required|string',
                ]);
                //Ask a question
                $question = Question::Start($user, $find_ticket, $validated['body']);
                //Display that question
                return response()->json([
                    'question' => $question,
                ], 200);
                //If not my ticket
            } else return response([
                'message' => 'something went wrong',
            ]);
            //If user is not authenticated
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Give an answer
    public function giveanswer(Request $request, $ticket, $question, $token)
    {
        //If user is authenticated
        if ($user = self::authenticated($token)) {
            //If ticket and question is also mine
            if ($find_ticket = self::myticket($ticket, $user) && $find_question = self::myquestion($question, $user)) {
                //Validate
                $validated = $request->validate([
                    'body' => 'required|string',
                ]);
                //Give an answer
                $answer = Answer::Start($find_ticket, $find_question, $user, $validated['body']);
                //Display that answer
                return response()->json([
                    'answer' => $answer,
                ], 200);
                //If not my ticket
            } else return response([
                'message' => 'something went wrong',
            ]);
            //If user is not authenticated
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Get all questions on this ticket
    public function questions($ticket, $token)
    {
        //If user is authenticated
        if ($user = self::authenticated($token)) {
            //If ticket and question is also mine
            if ($find_ticket = self::myticket($ticket, $user)) {
                //Display questions
                return response()->json([
                    'questions' => $find_ticket->questions,
                ], 200);
                //If not my ticket
            } else return response([
                'message' => 'something went wrong',
            ]);
            //If user is not authenticated
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Get all answers on this ticket
    public function answers($question, $token)
    {
        //If user is authenticated
        if ($user = self::authenticated($token)) {
            //If question and question is also mine
            if ($find_question = self::myquestion($question, $user)) {
                //Display answers
                return response()->json([
                    'answers' => $find_question->answers,
                ], 200);
                //If not my ticket
            } else return response([
                'message' => 'something went wrong',
            ]);
            //If user is not authenticated
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }
}
