<?php

use App\Models\Chat;
use App\Helpers\Ticket;
use App\Helpers\Message;
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

//agent token = 1|0EyvZh9HlqlV2bHyAZbyFvYcJa7wUebvGXtSS0dD

//customer token = 2|YFSDuY4VtHQyH0nR4rdh9LJubE5n4a05dk3mu79g

Route::get('debug', function () {
    //Auto update 
    dispatch(function () {
        //Auto Update
        Ticket::AutoAnswer();
    })->delay(now()->addSeconds(2));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');
