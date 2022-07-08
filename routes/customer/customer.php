<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Customer\CustomerController;

/*Begin::Authenticated Customer API*/

Route::middleware(['auth:sanctum'])->prefix('customer')->group(function () {

    //View all tickets
    Route::get('tickets/{token}', [CustomerController::class, 'tickets'])
        ->name('CustomerViewTickets');

    //Open a ticket
    Route::post('openticket/{token}', [CustomerController::class, 'openticket'])
        ->name('CustomerOpenTicket');

    //Ask a question
    Route::post('askquestion/{ticket}/{token}', [CustomerController::class, 'askquestion'])
        ->name('CustomerAskQuestion');

    //Give an answer to a question
    Route::post('giveanswer/{ticket}/{question}/{token}', [CustomerController::class, 'giveanswer'])
        ->name('CustomerGiveAnswer');

    //View all questions on a ticket
    Route::get('questions/{ticket}/{token}', [CustomerController::class, 'questions'])
        ->name('CustomerViewQuestions');

    //View all answers on a question
    Route::get('answers/{question}/{token}', [CustomerController::class, 'answers'])
        ->name('CustomerViewAnswers');
});
/*End::Authenticated Customer API*/

/*Begin::Unauthenticated Customer API*/
Route::prefix('customer')->group(function () {

    //Open a new ticket while unauthenticated
    Route::post('newticket', [CustomerController::class, 'newticket'])
        ->name('CustomerNewTicket');
});
    /*End::Unauthenticated Customer API*/