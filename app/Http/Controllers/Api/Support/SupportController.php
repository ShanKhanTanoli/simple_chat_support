<?php

namespace App\Http\Controllers\Api\Support;

use App\Models\User;
use App\Helpers\Answer;
use App\Helpers\Ticket;
use App\Helpers\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Sanctum\PersonalAccessToken;

class SupportController extends Controller
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

    //Check if customer is authenticated and role is support
    public static function authenticated($token)
    {
        //If user is tokenable
        if ($user = self::tokenable($token)) {
            //Check if role is support
            if ($user->role == "support") {
                //Return user
                return $user;
                //If user role is support
            } else return false;
            //If user not found
        } else return false;
    }

    //View all tickets
    public function tickets($token)
    {
        //If user is authenticated
        if (self::authenticated($token)) {
            //Display User Tickets
            return response()->json([
                'tickets' => Ticket::All(),
            ], 200);
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Ask a question
    public function askquestion(Request $request, $ticket, $token)
    {
        //If user is authenticated
        if ($agent = self::authenticated($token)) {
            //If ticket found
            $find_ticket = Ticket::Find($ticket);
            if ($find_ticket) {
                //Validate
                $validated = $request->validate([
                    'body' => 'required|string',
                ]);
                //Ask a question
                $question = Question::Start($agent, $find_ticket, $validated['body']);
                //Display that question
                return response()->json([
                    'question' => $question,
                ], 200);
                //If ticket not found
            } else return response([
                'message' => 'something went wrong',
            ]);
            //If agent is not authenticated then create and authenticate
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Give an answer
    public function giveanswer(Request $request, $ticket, $question, $token)
    {
        //If agent is authenticated
        if ($agent = self::authenticated($token)) {
            //Find ticket
            $find_ticket = Ticket::Find($ticket);
            //Find question
            $find_question = Question::Find($question);
            //If ticket and question found
            if ($find_ticket && $find_question) {
                //Validate
                $validated = $request->validate([
                    'body' => 'required|string',
                ]);
                //Give an answer
                $answer = Answer::Start($find_ticket, $find_question, $agent, $validated['body']);
                //Display that answer
                return response()->json([
                    'answer' => $answer,
                ], 200);
                //If ticket and question not found
            } else return response([
                'message' => 'something went wrong',
            ]);
            //If agent is not authenticated
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Get all questions on this ticket
    public function questions($ticket, $token)
    {
        //If user is authenticated
        if ($agent = self::authenticated($token)) {
            //If ticket found
            if ($find_ticket = Ticket::Find($ticket)) {
                //Display questions
                return response()->json([
                    'questions' => $find_ticket->questions,
                ], 200);
                ////If ticket not found
            } else return response([
                'message' => 'something went wrong',
            ]);
            //If agent is not authenticated
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Get all answers on this ticket
    public function answers($question, $token)
    {
        //If agent is authenticated
        if ($agent = self::authenticated($token)) {
            //If question found
            if ($find_question = Question::Find($question)) {
                //Display answers
                return response()->json([
                    'answers' => $find_question->answers,
                ], 200);
                //If ticket not found
            } else return response([
                'message' => 'something went wrong',
            ]);
            //If agent is not authenticated
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Mark as answered
    public function markanswered($ticket, $token)
    {
        //If agent is authenticated
        if ($agent = self::authenticated($token)) {
            //If ticket found
            $find_ticket = Ticket::Find($ticket);
            //If customer found
            $find_customer = User::find($find_ticket->user_id);
            //If ticket and customer found
            if ($find_ticket && $find_customer) {
                //Mark as answered
                Ticket::MarkAnswered($find_customer, $find_ticket);
                //Return response
                return response()->json([
                    'message' => 'Ticket has been answered and an email has been sent',
                ], 200);
                //If ticket not found
            } else return response([
                'message' => 'something went wrong',
            ]);
            //If agent is not authenticated
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Mark as not answered
    public function marknotanswered($ticket, $token)
    {
        //If agent is authenticated
        if ($agent = self::authenticated($token)) {
            //If ticket found
            $find_ticket = Ticket::Find($ticket);
            //If ticket found
            if ($find_ticket) {
                //Mark as notanswered
                Ticket::MarkNotAnswered($find_ticket);
                //Return response
                return response()->json([
                    'message' => 'Marked as not answered',
                ], 200);
                //If ticket not found
            } else return response([
                'message' => 'something went wrong',
            ]);
            //If agent is not authenticated
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Mark as spam
    public function markspam($ticket, $token)
    {
        //If agent is authenticated
        if ($agent = self::authenticated($token)) {
            //If ticket found
            $find_ticket = Ticket::Find($ticket);
            //If ticket found
            if ($find_ticket) {
                //Mark as spam
                Ticket::MarkSpam($find_ticket);
                //Return response
                return response()->json([
                    'message' => 'Marked as spam',
                ], 200);
                //If ticket not found
            } else return response([
                'message' => 'something went wrong',
            ]);
            //If agent is not authenticated
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Mark as in progress
    public function markinprogress($ticket, $token)
    {
        //If agent is authenticated
        if ($agent = self::authenticated($token)) {
            //If ticket found
            $find_ticket = Ticket::Find($ticket);
            //If ticket found
            if ($find_ticket) {
                //Mark as in progress
                Ticket::MarkInProgress($find_ticket);
                //Return response
                return response()->json([
                    'message' => 'Marked as in progress',
                ], 200);
                //If ticket not found
            } else return response([
                'message' => 'something went wrong',
            ]);
            //If agent is not authenticated
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    /*Begin::Search*/
    //Search ticket
    public function searchticket(Request $request, $token)
    {
        //If agent is authenticated
        if ($agent = self::authenticated($token)) {
            //Validate
            $validated = $request->validate([
                'query' => 'required|string',
            ]);
            //Return response
            return response()->json([
                'search' => Ticket::Search($validated['query']),
            ], 200);
            //If agent is not authenticated
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Search question
    public function searchquestion(Request $request, $token)
    {
        //If agent is authenticated
        if ($agent = self::authenticated($token)) {
            //Validate
            $validated = $request->validate([
                'query' => 'required|string',
            ]);
            //Return response
            return response()->json([
                'search' => Question::Search($validated['query']),
            ], 200);
            //If agent is not authenticated
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }

    //Search answer
    public function searchanswer(Request $request, $token)
    {
        //If agent is authenticated
        if ($agent = self::authenticated($token)) {
            //Validate
            $validated = $request->validate([
                'query' => 'required|string',
            ]);
            //Return response
            return response()->json([
                'search' => Answer::Search($validated['query']),
            ], 200);
            //If agent is not authenticated
        } else return response([
            'message' => 'unauthenticated',
        ]);
    }
    /*End::Search*/
}
