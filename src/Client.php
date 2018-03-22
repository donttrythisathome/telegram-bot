<?php

namespace Dtth\TelegramBot;

use Dtth\TelegramBot\Bot;
use Dtth\TelegramBot\Result;
use GuzzleHttp\Client as HttpClient;
use Dtth\TelegramBot\Commands\Command;

class Client
{
    protected $httpClient;

    /**
     * Creates a new client instance.
     *
     * @return void
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Execute API method
     *
     * @return mixed
     */
    public function executeCommand(Command $command)
    {
        $url = $command->getUrl();
        $method = $command->getHttpMethod();
        $body = $command->getArg();
        $res = $this->httpClient->request($method, $url,[
            'json' => $body
        ]);

        return $this->newResult($res,$command);
    }

    /**
     * Creates a new result instance
     *
     * @return Dtth\TelegramBot\Result
     */
    protected function newResult()
    {
        return new Result(...func_get_args());
    }
}