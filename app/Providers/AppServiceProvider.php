<?php

namespace App\Providers;

use App\Facades\AuthenticationFacade;
use App\Facades\SendSmsFacade;
use App\Facades\TokenNumberFacade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind('token_number',function(){
            return new TokenNumberFacade;
        });
        app()->bind('send_sms_facade',function(){
            return new SendSmsFacade;
        });
        
        app()->bind('authen',function(){
            return new AuthenticationFacade;
        }); 
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
