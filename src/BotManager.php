<?php

namespace Dtth\TelegramBot;

use Dtth\TelegramBot\Contracts\BotManager as BotManagerInterface;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Arr;

class BotManager implements BotManagerInterface
{
    /**
     * Array of bot instances
     *
     * @var \Dtth\TelegramBot\Bots\Bot
     */
    protected $bots = [];

    /**
     * Creates a new bot manager instance.
     *
     * @return void
     */
    public function __construct(array $config, Update $update = null)
    {
        $this->config = $config;
        $this->update = $update;
    }

    /**
     * Get a new bot instance.
     *
     * @return \Dtth\TelegramBot\Bots\Bot
     */
    public function bot(string $name = null)
    {
        if (!array_key_exists($name, $this->bots)){
            $this->bots[$name] = $this->resolveByName($name);
        }

        return $this->bots[$name];
    }

    /**
     * Resolve the bot instance by given bot's name.
     *
     * @return \Dtth\TelegramBots\Bots\Bot
     */
    protected function resolveByName(string $name = null)
    {
        $name = $name??$this->config['default'];
        $class = $this->getConfig('bots.'.$name.'.class');
        $token = $this->getConfig('bots.'.$name.'.token');
        $baseUrl = $this->getBaseUrl($token);
        $client = $this->getClient($baseUrl);

        try{
            return new $class($client);
        } catch (\Exception $e){
            throw BotException::invalidBot();
        }
    }

    /**
     * Get config via dot notation.
     *
     * @return string
     */
    protected function getConfig(string $key)
    {
        return array_get($this->config, $key);
    }

    /**
     * Merge url with bot's token,
     *
     * @return string
     */
    public function getBaseUrl(string $token)
    {
        return str_replace('<token>', $token, $this->getConfig('url'));
    }

    /**
     * Creates a new client instance.
     *
     * @return \Dtth\TelegramBot\Contracts\Client
     */
    protected function getClient(string $baseUrl)
    {
        return new Client(new HttpClient(['base_url'=>$baseUrl]));
    }

    /**
     * Dynamically handles bot manager methods calls.
     *
     * @return mixed
     */
    public function __call($method, $argumrnts)
    {
        $bot = $this->bot();

        return $bot->{$method}(...$arguments);
    }
}