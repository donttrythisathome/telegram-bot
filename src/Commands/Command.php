<?php

namespace Dtth\TelegramBot\Commands;

use Dtth\TelegramBot\Contracts\Bot;
use Dtth\TelegramBot\Contracts\Client;

abstract class Command
{
    protected $name;
    protected $client;
    protected $contentType;
    protected $arguments;
    protected $method = "GET";

    /**
     * Cerates a new command instance.
     *
     * @return void
     */
    public function __construct(Client $client, string $token ,array $arguments = [])
    {
        $this->client = $client;
        $this->token = $token;
        $this->arguments = $arguments;
    }

    /**
     * Get command http method.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
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
     * Get request options
     *
     * @return void
     */
    public function getOptions()
    {
        return [];
    }
}