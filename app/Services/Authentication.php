<?php

namespace App\Services;

use App\Facades\TokenNumberFacade;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Authentication {
    public function login(array $params){
        $loginAttempt =Auth::attempt([
                    'number'=>$params['number'],
                    'password'=>$params['password']
                ]);
        if($loginAttempt){
            Auth::user()->tokens()->delete();
            return $this->createAuthenticationToken(Auth::user(),'login');
        }
    }


    public function register(array $params){
        $user = User::create(
            [
                'name'=>$params['name'],
                'number'=>$params['number'],
                'password'=>Hash::make($params['password'])
            ]
            );
        return $this->createAuthenticationToken($user, 'register');
    }

    public function resetPassword($number , $password){
        TokenNumberFacade::deleteTokenNumber($number);
        $user = User::where('number',$number)->first();
        $user->password = Hash::make($password);
        $user->save();
        return true;
    }


    private function createAuthenticationToken($user,$authenitcationKey){
        $token = $user->createToken($authenitcationKey);
        return $token->plainTextToken;
    }

    
}