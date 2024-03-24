<?php

namespace App\Services\Notification;

use IPPanel\Client;

class SendSms
{
    public function send($number, $message){
        $apiKey = config('services.sms.api_key');
        $client = new Client($apiKey);
        $messageid = $client->send( config('services.sms.originator'),          // originator
        [$number],    // recipients
        $message,// message
        config('services.sms.description')        // is logged);
    );
    }
}