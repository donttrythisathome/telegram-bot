<?php

namespace Dtth\TelegramBot\Contracts;

interface ClientInterface
{
    /**
     * Execute API method
     *
     * @return mixed
     */
    public function executeCommand(CommandInterface $command);
}