<?php

namespace Dtth\TelegramBot\Commands;

class GetMe extends AbstractCommand
{
    /**
     * Parse command result.
     *
     * @return \Dtth\TelegramBot\Bot
     */
    public function parseResult($result)
    {
        $json = $result->toString();
        $data = json_decode($json,true);

        return $this->bot->fill($data['result']);
    }
}