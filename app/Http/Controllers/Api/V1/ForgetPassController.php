<?php

namespace App\Http\Controllers\Api\V1;

use App\Facades\AuthenticationFacade;
use App\Facades\TokenNumberFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use App\Services\TokenNumberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ForgetPassController extends Controller
{
    public function forget(Request $request){
        $user = User::where('number',$request->number)->first();
        $message = __('messages.enter_token_code');
        if(!is_null($user)){
        (new TokenNumberService($user))->create($message);
        return response()->json([
            'message'=>__('messages.token_sent')
        ]);
        }
        return response()->json([
            'message'=> __('messages.invalid_number')
        ]);
    }

    public function resetPassword(ResetPasswordRequest $request){
        $token_number= TokenNumberFacade::getTokenNumberRecord($request->number,$request->token);
        if(!is_null($token_number)){
            $result =AuthenticationFacade::resetPassword($request->number, $request->password);
            $message =  $result ?
                 ['message'=>__('messages.success_change_password')]:
                 ['message'=>'']; 
            return response()->json($message);
        }
    }
}
