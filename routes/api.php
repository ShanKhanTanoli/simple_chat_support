<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;

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


/*Begin::Login API*/
Route::post('login', [LoginController::class, 'login']);
/*Begin::Login API*/

/*Begin::Register API*/
Route::post('register', [RegisterController::class, 'register']);
/*Begin::Register API*/

/*Begin::Support API*/
include('support/support.php');
/*Begin::Support API*/

/*Begin::Customer API*/
include('customer/customer.php');
/*Begin::Customer API*/
