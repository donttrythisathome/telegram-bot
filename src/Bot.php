<?php

namespace Dtth\TelegramBot;

use Dtth\TelegramBot\Invoker;
use Dtth\TelegramBot\Contracts\BotInterface;

class Bot implements BotInterface
{
    protected $attributes = [];
    /**
     * Creates a new bot instance.
     *
     * @return void
     */
    public function __construct(string $token,string $urlTemplate)
    {
        $this->fill([
            'token'=>$token,
            'urlTemplate'=>$urlTemplate
        ]);
    }

    /**
     * Fill bot instance with given attributes.
     *
     * @return $this
     */
    public function fill($attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->$key = $value;
        }

        return $this;
    }

    /**
     * Convert bot to json.
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * Convert bot to array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->attributes;
    }

    /**
     * Get url template with filled token.
     *
     * @return string
     */
    public function getUriTemplate()
    {
        return str_replace('<token>', $this->token, $this->urlTemplate);
    }

    /**
     * Creates a new request builder.
     *
     * @return \Dtth\TelegramBot\RequestBuilder
     */
    public function newInvoker()
    {
        return new Invoker($this);
    }

    /**
     * Dynamically handles method calls.
     *
     * @return mixed.
     */
    public function __call($command, $arguments)
    {
        return $this->newInvoker()->command($command,$arguments);
    }

    /**
     * Bot dynamic getter.
     *
     * @return mixed
     */
    public function __get($key)
    {
        if (!$key){
            return;
        }

        if (array_key_exists($key, $this->attributes)){
            return $this->attributes[$key];
        }
    }

    /**
     * Bot dynamic setter.
     *
     * @return $this
     */
    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;

        return $this;
    }
}