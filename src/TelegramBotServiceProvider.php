<?php

namespace Dtth\TelegramBot;

use Dtth\TelebramBot\BotManager;
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
        //
    }

    /**
     * Register the telegram bot service
     *
     * @return void
     */
    public function register()
    {
        $this->registerBotManager();
    }

    /**
     * Register the bot manager
     *
     * @return \Dtth\TelegramBot\Contracts\BotManager
     */
    protected function registerBotManager()
    {
        $this->app->singleton('telegram_bot',function($app){
            $config = $app->config['telegram_bot'];

            return new BotManager($config);
        });
    }
}