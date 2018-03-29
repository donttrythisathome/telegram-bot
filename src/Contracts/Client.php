<?php

namespace Dtth\TelegramBot\Contracts;

use Dtth\TelegramBot\Commands\Command;

interface Client
{
    /**
     * Execute API method
     *
     * @return mixed
     */
    public function executeCommand(Command $command);
}