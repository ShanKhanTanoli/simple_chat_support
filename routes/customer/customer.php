<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Customer\CustomerChatController;
use App\Http\Controllers\Api\Customer\CustomerTicketController;

/*Begin::Authenticated Customer API*/

Route::middleware(['auth:sanctum'])->prefix('customer')->group(function () {

    /*Begin::Ticket*/
    //View all tickets
    Route::get('tickets/{token}', [CustomerTicketController::class, 'Tickets'])
        ->name('CustomerViewTickets');

    //Open a ticket
    Route::post('openticket/{token}', [CustomerTicketController::class, 'OpenTicket'])
        ->name('CustomerOpenTicket');
    /*End::Ticket*/

    /*Begin::Chat*/
    //View chat on a ticket
    Route::get('chat/{ticket}/{token}', [CustomerChatController::class, 'Chat'])
        ->name('CustomerChat');

    //Send message on a ticket
    Route::post('message/{ticket}/{token}', [CustomerChatController::class, 'Message'])
        ->name('CustomerMessage');

    //Reply to message on a ticket
    Route::post('reply/{message}/{ticket}/{token}', [CustomerChatController::class, 'Reply'])
        ->name('CustomerReply');
    /*End::Chat*/
});
/*End::Authenticated Customer API*/

/*Begin::Unauthenticated Customer API*/
Route::prefix('customer')->group(function () {

    //Open a new ticket while unauthenticated
    Route::post('newticket', [CustomerTicketController::class, 'newticket'])
        ->name('CustomerNewTicket');
});
    /*End::Unauthenticated Customer API*/