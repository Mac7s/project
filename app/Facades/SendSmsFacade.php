<?php

namespace App\Facades;

use App\Services\Notification\SendSms;
use Illuminate\Support\Facades\Facade;

class SendSmsFacade extends Facade
{
    public static function getFacadeAccessor(){
        return SendSms::class;
    }

}