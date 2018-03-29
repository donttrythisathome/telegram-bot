<?php

namespace Dtth\TelegramBot;

use Dtth\TelegramBot\Client;
use GuzzleHttp\Client as HttpClient;
use Dtth\TelegramBot\Exceptions\BotException;
use Illuminate\Contracts\Foundation\Application;
use Dtth\TelegramBot\Contracts\BotManager as BotManagerInterface;

class BotManager implements BotManagerInterface
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * The array of the created Bots
     *
     * @var array
     */
    protected $bots = [];

    /**
     * Create a new Bot manager instance.
     *
     * @param Illuminate\Contracts\Foundation\Application $app
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Get  the Telegram Bot.
     *
     * @param string $name
     * @return \Dtth\TelegramBot\Bots\Bot
     */
    public function bot(string $name = null)
    {
        $name = $name ?: $this->config('default');
        return isset($this->bots[$name])
            ? $this->bots[$name]
            : $this->bots[$name] = $this->resolve($name);
    }

    /**
     * Resolve the Bot.
     *
     * @param  string $name
     * @return \Dtth\TelegramBot\Bot
     *
     * @throws \Dtth\Bot\Exceptions\BotException
     */
    protected function resolve(string $name)
    {
        $config = $this->config("bots.{$name}");

        if (is_null($config)) {
            throw BotException::invalidBotName("Telegram bot [{$name}] is not defined.");
        }

        return $this->createBot($name,$config);
    }

    /**
     * Create a new Bot instance.
     *
     * @param string $name
     * @param   array $config
     * @return \Dtth\TelegramBot\Bot
     */
    public function createBot(string $name, array $config)
    {
        $client = $this->createClient($this->tokenizeUrl($config['token']));
        return new $config['class']($client);
    }

    /**
     * Create a new client instance.
     *
     * @param string $baseUrl
     * @return \Dtth\TelegramBot\Contracts\Client
     */
    public function createClient(string $baseUrl)
    {
        return new Client($this->app->makeWith(HttpClient::class,['config'=>['base_uri'=>$baseUrl]]));
    }

    /**
     * Get the Telegram Bot config.
     *
     * @return array
     */
    protected function config(string $offset = null)
    {
        return $this->app['config']["telegram_bot.{$offset}"];
    }

    /**
     * Get the default bot name.
     *
     * @return string
     */
    public function getDefaultBot()
    {
        return $this->config('default');
    }

    /**
     * Set the default bot.
     *
     * @param string $name
     * @return void
     */
    public function setDefaultBot(string $name)
    {
        $this->app['config']['telegram_bot.default'] = $name;
    }

    /**
     * Merge url with bot's token,
     *
     * @param string $token
     * @return string
     */
    protected function tokenizeUrl(string $token)
    {
        return str_replace('<token>', $token, $this->config('url'));
    }

    /**
     * Dynamically call the default bot instance.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->bot()->{$method}(...$parameters);
    }
}