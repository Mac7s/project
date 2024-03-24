<?php

namespace App\Facades;

use App\Services\Authentication;
use App\Services\AuthTest;
use Illuminate\Support\Facades\Facade;

class AuthenticationFacade extends Facade{

    protected static function getFacadeAccessor(){
        return Authentication::class;
    }
}