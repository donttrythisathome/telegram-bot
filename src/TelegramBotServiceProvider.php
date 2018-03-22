<?php

namespace Dtth\TelegramBot;

use Dtth\TelegramBot\Bot;
use Dtth\TelegramBot\Client;
use Illuminate\Support\ServiceProvider;
use Dtth\TelegramBot\Contracts\ClientInterface;

class TelegramBotServiceProvider extends ServiceProvider
{
    protected $refreshInfoWhenResolving = false;

    /**
     * Bootstrap the telegram bot service.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('telegram_bot.php'),
        ]);

        $this->loadRoutesFrom(__DIR__.'/../routes/webhook.php');
    }

    /**
     * Register the telegram bot service
     *
     * @return void
     */
    public function register()
    {
        $this->registerBot();

        $this->app->resolving('telegram_bot',function($bot){
            if ($this->refreshInfoWhenResolving){
                $bot->getMe()->parse();
            }
        });
    }

    /**
     * Register bot
     *
     * @return void
     */
    protected function registerBot()
    {
        $this->app->singleton('telegram_bot',function($app){
            $token = $app->config['telegram_bot']['token'];
            $pattern = $app->config['telegram_bot']['telegram_bot_api_pattern'];

            return new Bot($token, $pattern);
        });
    }
}