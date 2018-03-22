<?php

namespace Dtth\TelegramBot\Commands;

class SendMessage extends AbstractCommand
{
    protected $httpMethod = 'POST';

    /**
     * Parse command result.
     *
     * @return \Dtth\TelegramBot\Bot
     */
    public function parseResult($result)
    {
        //
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