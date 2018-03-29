<?php

namespace Dtth\TelegramBot;

use Dtth\TelegramBot\Commands\Command;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use Dtth\TelegramBot\Contracts\Client as ClientInterface;

class Client implements ClientInterface
{
    protected $httpClient;

    /**
     * Creates a new client instance.
     *
     * @return void
     */
    public function __construct(HttpClientInterface $httpClient)
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
        $result = $this->httpClient->request(
            $command->getHttpMethod(),
            $command->getUrl($command->getToken()),
            $command->getOptions()
        );

        return $command->parse($result);
    }

    /**
     *
     *
     * @return string
     */
    protected function getUrl(string $token):string
    {
        return str_replace($this->url,'<token>', $token);
    }
}