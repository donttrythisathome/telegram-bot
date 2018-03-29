<?php

namespace Dtth\TelegramBot\Contracts;

interface BotManager
{
    /**
     * Get  the Telegram Bot.
     *
     * @param string $name
     * @return \Dtth\TelegramBot\Bots\Bot
     */
    public function bot(string $name = null);

    /**
     * Create a new Bot instance.
     *
     * @param string $name
     * @param   array $config
     * @return \Dtth\TelegramBot\Bot
     */
    public function createBot(string $name, array $config);

     /**
     * Create a new client instance.
     *
     * @param string $baseUrl
     * @return \Dtth\TelegramBot\Contracts\Client
     */
    public function createClient(string $baseUrl);

    /**
     * Get the default bot name.
     *
     * @return string
     */
    public function getDefaultBot();

    /**
     * Set the default bot.
     *
     * @param string $name
     * @return void
     */
    public function setDefaultBot(string $name);
}