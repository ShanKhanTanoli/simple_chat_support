<?php

use App\Models\User;
use App\Helpers\Answer;
use App\Helpers\Ticket;
use App\Helpers\Question;
use App\Models\Chat;
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

    $customer_token = "1|VmRa12cB6BmCnqkCnZfMUYCBzJ2Kbx7rORezSfjx";

    $customer_7_token = "2|b7J5hqthamah3wdtaWuZaBcyWD0jtohKDvM0ZgXh";

    $agent_token = "3|2uX1Txz2ps0JVTzkMS5CLZ42qx4tpqdVvflYLKRA";

    //agent
    $agent = User::find(1);

    //customer
    $customer = User::find(4);

    //chat
    $chat = Chat::find(1);

    //$ticket = Ticket::Open($customer->name, $customer->email, "Technical Support");

    // $ticket = Ticket::Find(1);

    // $chat = Chat::create([
    //     'user_id' => $agent->id,
    //     'support_ticket_id' => $ticket->id,
    //     'body' => "Hi , how may i help you",
    //     'parent_id' => 1,
    // ]);

    dd($chat->chats);

    // dispatch(function () {

    //     $ticket = Ticket::Find(1);

    //     $ticket->update([
    //         'status' => 'answered',
    //     ]);
    // })->delay(now()->addSeconds(2));

    return "success";

    //$token = $customer->createToken('auth-token')->plainTextToken;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');
