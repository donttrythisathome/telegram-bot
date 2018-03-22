<?php

namespace Dtth\TelegramBot;

class Result
{
    /**
     * Raw result.
     *
     * @var \GuzzleHttp\Psr7\Response
     */
    protected $raw;

    /**
     * Command.
     *
     * @var \Dtth\TelegramBot\Commands\Command
     */
    protected $command;

    /**
     * Parsed result.
     *
     * @var mixed
     */
    protected $parsed;

    /**
     * Creates a new result instance.
     *
     * @return void
     */
    public function __construct($raw, $command)
    {
        $this->raw = $raw;
        $this->command = $command;
    }

    /**
     * Parse result.
     *
     * @return mixed
     */
    public function parse()
    {
        $this->parsed = $this->command->parseResult($this);
    }

    /**
     * Get parsed result.
     *
     * @return mixed
     */
    public function parsed()
    {
        return $this->parsed;
    }

    /**
     *
     *
     * @return
     */
    public function toArray()
    {
        return json_decode($this->toString(),true)['result'];
    }

    /**
     * Convert result to string.
     *
     * @return string
     */
    public function toString()
    {
        return (string) $this->raw->getBody();
    }

    /**
     * Get command.
     *
     * @return \Dtth\TelegramBot\Commands\Command
     */
    public function command()
    {
        return $this->command;
    }

    /**
     * Dynamic handles result calls
     *
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return $this->raw->{$method}($arguments);
    }
}