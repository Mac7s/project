<?php

namespace App\Http\Controllers\Api\V1;

use App\Facades\AuthenticationFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Authentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function authenticate(RegisterRequest $request){
        $token = AuthenticationFacade::register($request->all());
        // $token = (new Authentication)->register($request->all());
        return response()->json(['token'=>$token]);
    }
}
