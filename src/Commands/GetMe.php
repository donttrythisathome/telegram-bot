<?php

namespace Dtth\TelegramBot\Commands;

class GetMe extends Command
{
    /**
     * Parse command result.
     *
     * @return \Dtth\TelegramBot\Models\User
     */
    public function parse($result)
    {
        return new User($result->toArray());
    }
}