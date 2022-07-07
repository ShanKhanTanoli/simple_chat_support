<?php

use App\Helpers\Ticket;
use App\Models\User;
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

    dd(Ticket::Open("shankhan", "shankhantanoli1@gmail.com", "Technical Support"));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');
