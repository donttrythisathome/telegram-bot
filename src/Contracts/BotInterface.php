<?php

namespace Dtth\TelegramBot\Contracts;

interface BotInterface
{
    /**
     * Fill bot instance with given attributes.
     *
     * @return $this
     */
    public function fill($attributes = []);

    /**
     * Convert bot to json.
     *
     * @return string
     */
    public function toJson();

    /**
     * Convert bot to array.
     *
     * @return array
     */
    public function toArray();

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