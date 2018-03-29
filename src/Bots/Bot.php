<?php

namespace Dtth\TelegramBot\Bots;

use Dtth\TelegramBot\Contracts\Client;

abstract class Bot
{
    /**
     * The bot api client.
     *
     * @var \Dtth\TelegramBot\Contracts\Client
     */
    protected $client;

    /**
     * Current update.
     *
     * @var \Dtth\TelegramBot\Models\Update
     */
    protected $update;

    /**
     *  The commands.
     *
     * @var array
     */
    protected $commands = [
        'getMe' => \Dtth\TelegramBot\Commands\GetMe::class,
        'getUpdates'=>\Dtth\TelegramBot\Commands\GetUpdates::class,
        'sendMessage'=>\Dtth\TelegramBot\Commands\SendMessage::class,
    ];

    /**
     * Creates a new bot instance.
     *
     * @return void
     */
    public function __construct(Client $client,Update $update = null)
    {
        $this->client = $client;
        $this->update = $update;
    }

    /**
     * The getMe command.
     *
     * @return \Dtth\TelegramBot\Models\AbstractModel
     */
    public function getMe()
    {
        return $this->resolveCommand('getMe')->execute();
    }

    /**
     * The getUpdates command.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getUpdates()
    {
        return $this->resolveCommand('getUpdates')->execute();
    }

    /**
     * Get current update.
     *
     * @return \Dtth\TelegramBot\Models\Update
     */
    public function update()
    {
        return $this->update;
    }

    /**
     *
     *
     * @return
     */
    public function test()
    {
        return "hello";
    }

    /**
     * The sendMessage command.
     *
     * @return \Dtth\TelegramBot\Models\Model
     */
    public function sendMessage(array $arguments)
    {
        return $this->resolveCommand('sendMessaage', $arguments)->execute();
    }

    /**
     * Register command.
     *
     * @return boolean
     */
    protected function registerCommand(string $name, string $class):boolean
    {
        if (!array_array_key_exists($name, $this->$commands)){
            $this->$commands[$name] = $class;

            return true;
        }

        return false;
    }

    /**
     * Resolve a new command instance.
     *
     * @throws \Dtth\TelegramBot\Exceptions\BotException  The general bot exception
     * @return \Dtth\TelegramBot\Commands\Command
     */
    public function resolveCommand(string $command, array $arguments = []):Command
    {
        try{
            $type = $this->$commands[$method];
            $command = new $type($this->client,$this->token,$arguments);
        } catch (\Exception $e){
            throw BotException::InvalidCommand($command);
        }

        return $command;
    }

    /**
     * Dynamically handles the bot method calls.
     *
     * @throws \Dtth\TelegramBot\Exceptions\BotException  The general bot exception
     * @return mixed
     */
    public function __call($command, $arguments)
    {
        return $this->resolveCommand($command, $arguments)->execute();
    }
}