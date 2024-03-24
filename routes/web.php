<?php

use App\Facades\AuthenticationFacade;
use App\Models\User;
use App\Notifications\NumberVerification;
use Illuminate\Support\Facades\Route;
use IPPanel\Client;

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

Route::get('/', function () {
    // $user =User::first();
    // $user->notify(new NumberVerification(2443));
});


