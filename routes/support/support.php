<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Support\SupportChatController;
use App\Http\Controllers\Api\Support\SupportTicketController;

/*Begin::Support Team API*/

Route::middleware(['auth:sanctum'])->prefix('support')->group(function () {

    /*Begin::Ticket*/
    //View all tickets
    Route::get('tickets/{token}', [SupportTicketController::class, 'Tickets'])
        ->name('SupportViewTickets');

    //Open a ticket
    Route::post('openticket/{token}', [SupportTicketController::class, 'OpenTicket'])
        ->name('SupportOpenTicket');

    //Mark as spam
    Route::post('markspam/{ticket}/{token}', [SupportTicketController::class, 'MarkSpam'])
        ->name('SupportMarkSpam');

    //Mark as answered
    Route::post('markanswered/{ticket}/{token}', [SupportTicketController::class, 'MarkAnswered'])
        ->name('SupportMarkAnswered');

    //Mark as not answered
    Route::post('marknotanswered/{ticket}/{token}', [SupportTicketController::class, 'MarkNotAnswered'])
        ->name('SupportMarkNotAnswered');

    //Mark as in progress
    Route::post('markinprogress/{ticket}/{token}', [SupportTicketController::class, 'MarkInProgress'])
        ->name('SupportMarkInProgress');

    /*Begin::Ticket Search*/
    Route::get('ticketsearch/{token}', [SupportTicketController::class, 'TicketSearch'])
        ->name('SupportTicketSearch');
    /*End::Ticket Search*/

    /*End::Ticket*/

    /*Begin::Chat*/
    //View chat on a ticket
    Route::get('chat/{ticket}/{token}', [SupportChatController::class, 'Chat'])
        ->name('SupportChat');

    //Send message on a ticket
    Route::post('message/{ticket}/{token}', [SupportChatController::class, 'Message'])
        ->name('SupportMessage');

    //Reply to message on a ticket
    Route::post('reply/{message}/{ticket}/{token}', [SupportChatController::class, 'Reply'])
        ->name('SupportReply');

    /*Begin::Chat Search*/
    Route::get('chatsearch/{token}', [SupportChatController::class, 'ChatSearch'])
        ->name('SupportChatSearch');
    /*End::Chat Search*/

    /*End::Chat*/
});
/*End::Support Team API*/