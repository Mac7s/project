<?php

use App\Http\Controllers\Api\V1\ForgetPassController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\RegisterController;
use App\Http\Controllers\Api\V1\VerificationNumberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v1'],function(){
    Route::post('register',[RegisterController::class,'authenticate'])->name('register');
    Route::get('login',[LoginController::class,'create'])->name('login');
    Route::post('login',[LoginController::class,'authenticate'])->name('login.store');
    Route::get('verify-number',[VerificationNumberController::class,'verifyNumber'])->name('number.verfiy')->middleware(['auth:sanctum']);
    Route::post('verify-number',[VerificationNumberController::class,'checkNumberVerification'])->middleware(['auth:sanctum']);
    
    Route::post('forget-password',[ForgetPassController::class,'forget'])->middleware('guest');
    Route::post('reset-password',[ForgetPassController::class,'resetPassword'])->middleware('guest');

    Route::get('test',function(Request $request){
        dd('this is test');
    })->middleware(['auth:sanctum','number-verification']);
});
