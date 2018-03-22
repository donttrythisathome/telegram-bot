<?php

namespace Dtth\TelegramBot;

use Dtth\TelegramBot\Invoker;
use Dtth\TelegramBot\Models\Update;
use Dtth\TelegramBot\Models\AbstractModel;
use Dtth\TelegramBot\Contracts\BotInterface;

class Bot extends AbstractModel implements BotInterface
{
    protected $relations = [
        'update'=>Update::class
    ];
    /**
     * Creates a new bot instance.
     *
     * @return void
     */
    public function __construct(string $token,string $urlTemplate)
    {
        parent::__construct([
            'token'=>$token,
            'urlTemplate'=>$urlTemplate
        ]);
    }

    /**
     *
     *
     * @return
     */
    public function update()
    {
        return $this->update;
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
}