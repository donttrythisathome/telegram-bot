<?php

namespace Dtth\TelegramBot\Facades;

use Illuminate\Support\Facades\Facade;

class TelegramBot extends Facade
{
    /**
     * Get bot abstract name
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'telegram_bot';
    }
}