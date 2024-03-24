<?php

namespace App\Services;

use App\Facades\SendSmsFacade;
use App\Facades\TokenNumberFacade;
use App\Models\User;
use App\Notifications\NumberVerification;
use Illuminate\Support\Facades\DB;

class TokenNumberService
{

    private string $message;

    public function __construct(private User $user)
    {
    }


    public function create($message){
        TokenNumberFacade::deleteTokenNumber($this->user->number);
        $token = TokenNumberFacade::createTokenNumber($this->user->number);
        SendSmsFacade::send($this->user->number, $message.$token);
    }

    public function verify($token){
        $record = TokenNumberFacade::getTokenNumberRecord($this->user->number,$token);
        if($record && now()->diffInSeconds($record->created_at)<300){
            TokenNumberFacade::deleteTokenNumber($this->user->number);
            $this->user->number_verified_at = now();
            $this->user->save();
            return true;
            }
        return false;
    }


    

}