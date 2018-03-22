<?php

namespace Dtth\TelegramBot\Commands;

use Dtth\TelegramBot\Contracts\BotInterface;
use Dtth\TelegramBot\Client;
use Dtth\TelegramBot\Contracts\CommandInterface;

abstract class AbstractCommand implements CommandInterface
{
    protected $bot;
    protected $client;
    protected $contentType;
    protected $arguments = [];
    protected $telegramMethod;
    protected $httpMethod = "GET";

    /**
     * Cerates a new command instance.
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get command http method.
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * Execute command.
     *
     * @return mixed
     */
    public function execute()
    {
        return $this->client->executeCommand($this);
    }

    /**
     * Set bot instance.
     *
     * @return $this
     */
    public function setBot(BotInterface $bot)
    {
        $this->bot = $bot;

        return $this;
    }

    /**
     * Set command arguments.
     *
     * @return array
     */
    public function setArguments($arguments = [])
    {
        $this->arguments = $arguments;

        return $this;
    }

    /**
     * Get command method url.
     *
     * @return string
     */
    public function getUri()
    {
        return str_replace(
            'METHOD_NAME',
            $this->telegramMethod??class_basename($this),
            $this->bot->getUriTemplate()
        );
    }

    /**
     * Get request options
     *
     * @return void
     */
    public function getOptions()
    {
        return [];
    }
}