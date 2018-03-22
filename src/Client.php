<?php

namespace Dtth\TelegramBot;

use Dtth\TelegramBot\Bot;
use Dtth\TelegramBot\Contracts\ClientInterface;
use Dtth\TelegramBot\Contracts\CommandInterface;
use Dtth\TelegramBot\Result;
use GuzzleHttp\Client as HttpClient;

class Client implements ClientInterface
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
    public function executeCommand(CommandInterface $command)
    {
        $res = $this->httpClient->request(
            $command->getHttpMethod(),
            $command->getUri(),
            $command->getOptions()
        );
        return tap($this->newResult($res,$command), function($result){
            $result->parse();
        });
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