<?php

namespace Dtth\TelegramBot\Contracts;

interface BotManager
{
    /**
     * Get a new bot instance.
     *
     * @return \Dtth\TelegramBot\Bots\Bot
     */
    public function bot(string $name);
}