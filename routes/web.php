<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\PersonalAccessToken;


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

    //$customer = User::where('role','customer')->first();
    //$customer_token = $customer->createToken('auth-token')->plainTextToken;
    // $customer_token = "1|Ob31J7D4lXZo1LEcSUrOJxxsMAjiDeCy37Om22dB";
    // $customer_find_token = PersonalAccessToken::findToken($customer_token);
    // dd($customer_find_token->tokenable);

    //$agent = User::where('role','support')->first();
    //$agent_token = $agent->createToken('auth-token')->plainTextToken;
    // $agent_token = "2|O0J3Nxew30CMKUHq7uvpWfNPmztVG8AuXoyUfdDK";
    // $agent_find_token = PersonalAccessToken::findToken($agent_token);
    // dd($agent_find_token->tokenable);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');
