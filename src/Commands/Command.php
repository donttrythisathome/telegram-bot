<?php

namespace Dtth\TelegramBot\Commands;

use Dtth\TelegramBot\Client;
use Dtth\TelegramBot\RequestBuilder;

abstract class Command
{
    protected $client;
    protected $httpMethod = 'GET';
    protected $contentType = 'application/json';
    protected $arguments = [];

    /**
     *
     *
     * @return
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     *
     *
     * @return
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * Execute command
     *
     * @return mixed
     */
    public function execute($arguments)
    {
        $this->setArguments($arguments);

        return $this->client->executeCommand($this);
    }

    /**
     *
     *
     * @return
     */
    public function getArg()
    {
        if (!array_key_exists(1, $this->arguments)){
            return;
        }

        return $this->arguments[1];
    }

    /**
     *
     *
     * @return
     */
    public function getBot()
    {
        return $this->arguments[0];
    }

    /**
     * Get command method url.
     *
     * @return string
     */
    public function getUrl()
    {
        $template = $this->getBot()->getUrlTemplate();
        $method = RequestBuilder::getCommandName(get_class($this));

        return str_replace('METHOD_NAME', $method, $template);
    }

    /**
     *
     *
     * @return
     */
    public function setArguments($arguments)
    {
        $this->arguments = $arguments;
    }

    /**
     *
     *
     * @return
     */
    public function getBody(){return;}
}