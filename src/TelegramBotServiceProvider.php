<?php

namespace Dtth\TelegramBot;

use GuzzleHttp\Client;
use Dtth\TelegramBot\Bots\Bot;
use Dtth\TelegramBot\BotManager;
use Illuminate\Support\ServiceProvider;

class TelegramBotServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the telegram bot service.
     *
     * @return void
     */
    public function boot()
    {
        //Here you can register your own bot commands
    }

    /**
     * Register the telegram bot service.
     *
     * @return void
     */
    public function register()
    {
        $this->registerHttpClient();
        $this->registerBotManager();
    }

    /**
     * Register the Http Client.
     *
     * @return void
     */
    protected function registerHttpClient()
    {
        $this->app->bind(Client::class,function(){
            return new Client;
        });
    }

    /**
     * Register the Bot Manager.
     *
     * @return void
     */
    protected function registerBotManager()
    {
        $this->app->singleton('telegram_bot',function($app){
            return new BotManager($app);
        });
    }
}