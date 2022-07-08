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
    $customer = User::find(1);
    //$token = $customer->createToken('auth-token')->plainTextToken;

    $token = "1|zfbTpMh4Icz7xXMQOGVutZA93j54Zvt5f9LGisVm";

    $agent_token = "2|Y9F8sZYaEafdfNwv10TpFPVv04B9OEoRTsm1PEGN";

    dd($token);


});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');
