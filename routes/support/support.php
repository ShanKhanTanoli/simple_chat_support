<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Support\SupportController;

/*Begin::Support Team API*/

Route::middleware(['auth:sanctum'])->prefix('support')->group(function () {

    //View all tickets
    Route::get('tickets/{token}', [SupportController::class, 'tickets'])
        ->name('SupportViewTickets');

    //Ask a question
    Route::post('askquestion/{ticket}/{token}', [SupportController::class, 'askquestion'])
        ->name('SupportAskQuestion');

    //Give an answer to a question
    Route::post('giveanswer/{ticket}/{question}/{token}', [SupportController::class, 'giveanswer'])
        ->name('SupportGiveAnswer');

    //View all questions on a ticket
    Route::get('questions/{ticket}/{token}', [SupportController::class, 'questions'])
        ->name('SupportViewQuestions');

    //View all answers on a question
    Route::get('answers/{question}/{token}', [SupportController::class, 'answers'])
        ->name('SupportViewAnswers');

    //Mark as answered
    Route::post('markanswered/{ticket}/{token}', [SupportController::class, 'markanswered'])
        ->name('SupportMarkAnswered');

    //Mark as not answered
    Route::post('marknotanswered/{ticket}/{token}', [SupportController::class, 'marknotanswered'])
        ->name('SupportMarkNotAnswered');

    //Mark as spam
    Route::post('markspam/{ticket}/{token}', [SupportController::class, 'markspam'])
        ->name('SupportMarkSpam');

    //Mark as inprogress
    Route::post('markinprogress/{ticket}/{token}', [SupportController::class, 'markinprogress'])
        ->name('SupportMarkInProgress');

    /*Begin::Search*/

    //Search ticket
    Route::get('searchticket/{token}', [SupportController::class, 'searchticket'])
        ->name('SupportSearchTicket');

    //Search question
    Route::get('searchquestion/{token}', [SupportController::class, 'searchquestion'])
        ->name('SupportSearchQuestion');

    //Search answer
    Route::get('searchanswer/{token}', [SupportController::class, 'searchanswer'])
        ->name('SupportSearchAnswer');

    /*Begin::Search*/
});
/*End::Support Team API*/