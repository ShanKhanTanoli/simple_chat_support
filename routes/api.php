<?php

use App\Http\Controllers\Api\Customer\CustomerController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TicketController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$agent_token = "1|LTMSkN2f2MEjnDbLEOAYTj4aWmiCtry4qzW7RqaD";

$customer_token = "2|sITOQfQi9DgavdmGufISSphE40QB0PxPCs6zhnot";


//Login controller
Route::post('login', [LoginController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::apiResource('posts', PostController::class);
});



/*Begin::Support Team API*/
Route::middleware(['auth:sanctum'])->prefix('support')->group(function () {

    Route::get('users', function () {
        return "hello";
    });
});
/*End::Support Team API*/

/*Begin::Customer API*/
Route::middleware(['auth:sanctum'])->prefix('customer')->group(function () {

    //View all tickets
    Route::get('tickets/{token}', [CustomerController::class, 'Tickets'])
        ->name('CustomerViewTickets');

    //Open a new ticket
    Route::post('openticket/{token}', [CustomerController::class, 'OpenTicket'])
        ->name('CustomerViewTickets');

    //Write a thread
    Route::post('writethread/{ticket}/{token}', [CustomerController::class, 'WriteThread'])
        ->name('CustomerWriteThread');

    //View all threads
    Route::get('threads/{token}', [CustomerController::class, 'threads'])
        ->name('CustomerViewThreads');

    //View all messages
    Route::get('messages/{token}', [CustomerController::class, 'messages'])
        ->name('CustomerViewMessages');

    //Reply to a specific thread
    Route::post('threadreply/{thread}/{token}', [CustomerController::class, 'threadreply'])
        ->name('CustomerOnThread');
});
/*End::Customer API*/
