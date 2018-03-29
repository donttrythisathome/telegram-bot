<?php

namespace Dtth\TelegramBot\Exceptions;

class BotException extends \Exception
{
    /**
     * Creates a new Bot exception instance.
     *
     * @return void
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Invalid Telegram Bot name.
     *
     * @param string $message
     * @return $this
     */
    public static function invalidBotName(string $message)
    {
        return new self($message);
    }
}