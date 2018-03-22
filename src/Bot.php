<?php

namespace Dtth\TelegramBot;

class Bot
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
     *
     *
     * @return
     */
    public function fill($attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->$key = $value;
        }

        return $this;
    }

    /**
     *
     *
     * @return
     */
    public function toJson()
    {
        return json_encode($this->attributes);
    }

    /**
     *
     *
     * @return
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
    public function getUrlTemplate()
    {
        return str_replace('<token>', $this->token, $this->urlTemplate);
    }

    /**
     * Creates a new request builder.
     *
     * @return \Dtth\TelegramBot\RequestBuilder
     */
    public function newRequestBuilder()
    {
        return new RequestBuilder($this);
    }

    /**
     * Dynamically handles method calls.
     *
     * @return mixed.
     */
    public function __call($command, $arguments)
    {
        return $this->newRequestBuilder()->command($command,$arguments);
    }

    /**
     *
     *
     * @return
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
     *
     *
     * @return
     */
    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }
}