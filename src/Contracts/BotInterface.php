<?php

namespace Dtth\TelegramBot\Contracts;

interface BotInterface
{
    /**
     * Get url template with filled token.
     *
     * @return string
     */
    public function getUriTemplate();

    /**
     * Creates a new request builder.
     *
     * @return \Dtth\TelegramBot\RequestBuilder
     */
    public function newInvoker();
}