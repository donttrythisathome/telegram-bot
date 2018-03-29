<?php

namespace Dtth\TelegramBot\Models;

use ArrayAccess;
use JsonSerializable;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

Abstract class AbstractModel implements ArrayAccess, Arrayable, Jsonable, JsonSerializable
{
    use Concerns\HasAttributes;

    protected $relations = [];

    /**
     * Creates a new model instance.
     *
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    /**
     * Fill the model with an array of attributes.
     *
     * @return $this
     */
    public function fill(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key,$value);
        }

        return $this;
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->attributes;
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Convert the model instance to JSON.
     *
     * @param  int  $options
     * @return string
     *
     * @throws \Dtth\TelegramBot\Excettions\JsonEncodingException
     */
    public function toJson($options = 0)
    {
        $json = json_encode($this->jsonSerialize(), $options);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new JsonEncodingException;
        }

        return $json;
    }

    /**
     * Determine if the given attribute exists.
     *
     * @param  mixed  $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }

    /**
     * Get the value for a given offset.
     *
     * @param  mixed  $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    /**
     * Set the value for a given offset.
     *
     * @param  mixed  $offset
     * @param  mixed  $value
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    /**
     * Unset the value for a given offset.
     *
     * @param  mixed  $offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * Dynamically set attributes on the model.
     *
     * @return $this
     */
    public function __set($key,$value)
    {
        $this->setAttribute($key,$value);

        return $this;
    }

    /**
     * Handle dynamic static method calls into the method.
     *
     * @return mixed
     */
    public static function __callStatic($method,$attributes)
    {
        return (new static)->{$method}(...$attributes);
    }

    /**
     *
     *
     * @return
     */
    public function __call($method, $attributes)
    {
        return $this->newBuilder()->{$method}(...$attributes);
    }

    /**
     * Get a new builder instance.
     *
     * @return \Dtth\TelegramBot\Models\Builder
     */
    public function newBuilder()
    {
        return new Builder($this);
    }

    /**
     * Create a new Collection instance.
     *
     * @param  array  $models
     * @return \Illuminate\Support\Collection
     */
    public function newCollection(array $models = [])
    {
        return new Collection($models);
    }

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return static
     */
    public function newInstance($attributes = [])
    {
        return new static($attributes);
    }
}