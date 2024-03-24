<?php

namespace App\Http\Controllers\Api\V1;

use App\Facades\AuthenticationFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Authentication;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function create(){
        return response()->json([
            'data'=>[
                'message'=>__('messages.login'),
                'url'=>route('login.store')
            ]
            ]);
    }

    
    public function authenticate(LoginRequest $request){
        $token = AuthenticationFacade::login($request->all());
        // $token = (new Authentication)->login($request->all());
        $response = is_null($token)?
                    ['message'=>__('messages.invalid_number_or_password')]:
                    ['token'=>$token];
        return response()->json($response);
    }

}
