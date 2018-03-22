<?php

namespace Dtth\TelegramBot;

use Dtth\TelegramBot\Bot;
use Dtth\TelegramBot\ClientInterface;

class RequestBuilder
{
    protected $bot;
    protected static $commands = [
        'getMe' => \Dtth\TelegramBot\Commands\GetMe::class,
        'getUpdates'=>\Dtth\TelegramBot\Commands\GetUpdates::class,
        'sendMessage'=>\Dtth\TelegramBot\Commands\SendMessage::class,
    ];

    /**
     *
     *
     * @return void
     */
    public function __construct(Bot $bot)
    {
        $this->bot = $bot;
    }

    /**
     * Call telegran bot API.
     *
     * @return mixed
     */
    public function command($command, $arguments)
    {
        array_unshift($arguments, $this->bot);

        return $this->resolveCommand($command)->execute($arguments);
    }

    /**
     * Resolve command instance
     *
     * @return mixed
     */
    public static function resolveCommand($method)
    {
        $class = static::$commands[$method];

        return app()->make($class);
    }

    /**
     * Get registered command name thru command class name.
     *
     * @return string
     */
    public static function getCommandName($class)
    {
        return array_search($class, static::$commands);
    }

    /**
     * Register command.
     *
     * @return $this
     */
    protected static function registerCommand($name, $class)
    {
        if (!array_array_key_exists($name, static::$commands)){
            static::$commands[$name] = $class;

            return true;
        }

        return;
    }
}