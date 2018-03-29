<?php

namespace Dtth\TelegramBot\Commands;

use Dtth\TelegramBot\Models\Message;

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
        return new Message($result->toArray());
    }

    /**
     *
     *
     * @return
     */
    public function getOptions()
    {
        return [
            'json'=>$this->arguments
        ];
    }
}