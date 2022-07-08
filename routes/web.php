<?php

use App\Models\User;
use App\Helpers\Answer;
use App\Helpers\Ticket;
use App\Helpers\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Support System


Route::get('/', function () {
    return view('welcome');
});

Route::get('debug', function () {

    //customer
    $customer = User::where('role', 'customer')->first();
    //agent
    $agent = User::where('role', 'support')->first();
    //create a ticket
    //$ticket = Ticket::Open("shankhan", "shankhantanoli1@gmail.com", "Technical Support");
    $ticket = Ticket::Find(1);
    //ask a question
    //$question = Question::Start($agent, $ticket, "Is there anything else you want to know?");
    //$question = Question::Find(2);
    //give an answer
    //$answer = Answer::Start($ticket,$question,$customer, "Thanks for your support.Take care bye");

    dd(Ticket::MarkAnswered($customer, $ticket));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');
