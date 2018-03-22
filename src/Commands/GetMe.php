<?php

namespace Dtth\TelegramBot\Commands;

class GetMe extends Command
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

        return $this->getBot()->fill($data['result']);
    }
}