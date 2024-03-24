<?php

namespace App\Facades;

use App\Facades\BaseClass\TokenNumber;
use Illuminate\Support\Facades\Facade;

class TokenNumberFacade extends Facade
{
    public static function getFacadeAccessor(){
        return TokenNumber::class;
    }
}