<?php

namespace Dtth\TelegramBot\Commands;

class SendMessage extends Command
{
    protected $httpMethod = 'POST';
    /**
     * Parse command result.
     *
     * @return \Dtth\TelegramBot\Bot
     */
    public function parseResult($result)
    {

    }
}