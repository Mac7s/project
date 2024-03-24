<?php

namespace App\Facades\BaseClass;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class TokenNumber
{
    public function createTokenNumber($number){
        $token = rand(24432,95843);
        DB::table('token_number')->insert([
                'number'=>$number,
                'token'=>$token,
                'created_at'=>now()
            ]);
        return $token;
    }

    public function deleteTokenNumber($number){
        DB::table('token_number')
                    ->where('number',$number)
                    ->delete();
    }

    public function getTokenNumberRecord($number, $token){
        return DB::table('token_number')
                    ->where('number',$number)
                    ->where('token',$token)
                    ->first();
    }

}