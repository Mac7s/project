<?php

namespace App\Http\Controllers\Api\V1;

use App\Facades\TokenNumberFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckVerificationRequest;
use App\Services\TokenNumberService;
use App\Services\TokenNumberServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerificationNumberController extends Controller
{
    public function verifyNumber(Request $request){
        $message = __('messages.enter_token_code_for_full_access');
        (new TokenNumberService($request->user()))->create($message);
        return response()->json([
            'message'=>__('messages.token_sent')
        ]);
    }

    public function checkNumberVerification(CheckVerificationRequest $request){
       $result = (new TokenNumberService($request->user()))->verify($request->token);
       $message =  $result ?
                 ['message'=>__('messages.number_confirmed')]:
                 ['message'=>__('messages.invalid_token')]; 
        return response()->json([
            $message
        ]);
               
    }
}
