<?php

namespace Dtth\TelegramBot\Commands;

use Dtth\TelegramBot\Models\Update;

class GetUpdates extends AbstractCommand
{

    /**
     * Parse command result.
     *
     * @return \Dtth\TelegramBot\Bot
     */
    public function parseResult($result)
    {
        return Update::hydrate($result->toArray());
    }
}