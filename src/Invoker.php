<?php

namespace Dtth\TelegramBot;

use Dtth\TelegramBot\ClientInterface;
use Dtth\TelegramBot\Contracts\BotInterface;

class Invoker
{
    /**
     * Bot instance
     *
     * @var Dtth\TelegramBot\Contracts\BotInterface
     */
    protected $bot;

    /**
     * Default commands
     *
     * @var array
     */
    protected static $commands = [
        'getMe' => \Dtth\TelegramBot\Commands\GetMe::class,
        'getUpdates'=>\Dtth\TelegramBot\Commands\GetUpdates::class,
        'sendMessage'=>\Dtth\TelegramBot\Commands\SendMessage::class,
    ];

    /**
     * Creates a new invoker instance.
     *
     * @return void
     */
    public function __construct(BotInterface $bot)
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
        return $this->resolveCommand($command)
            ->setBot($this->bot)
            ->setArguments(...$arguments)
            ->execute();
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