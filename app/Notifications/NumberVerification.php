<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use IPPanel\Client;

class NumberVerification extends Notification
{
    use Queueable;

    private $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $code, private string $number)
    {
        $this->message = "لطفا برای تایید کد زیر را در باکس وارد کنید".$code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(object $notifiable): string
    {
        return SmsNotification::class;
    }

    public function toSms($notifiable)  
        {
        $apiKey = config('services.sms.api_key');
        $client = new Client($apiKey);
        $messageid = $client->send( config('services.sms.originator'),          // originator
        [$this->number],    // recipients
        $this->message,// message
        config('services.sms.description')        // is logged);
    );
    }
}
