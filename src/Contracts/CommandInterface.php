<?php

namespace Dtth\TelegramBot\Contracts;

use Dtth\TelegramBot\Contracts\BotInterface;

interface CommandInterface
{
    /**
     * Get command http method.
     *
     * @return string
     */
    public function getHttpMethod();

    /**
     * Execute command.
     *
     * @return mixed
     */
    public function execute();

    /**
     * Set bot instance.
     *
     * @return $this
     */
    public function setBot(BotInterface $bot);

    /**
     * Set command arguments.
     *
     * @return array
     */
    public function setArguments($arguments);

    /**
     * Get command method url.
     *
     * @return string
     */
    public function getUri();

    /**
     * Get bot token.
     *
     * @return string
     */
    public function parseResult($result);

    /**
     * Get request options.
     *
     * @return array
     */
    public function getOptions();
}