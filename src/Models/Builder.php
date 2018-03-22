<?php

namespace Dtth\TelegramBot\Models;

class Builder
{
    protected $model;

    /**
     *
     *
     * @return void
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Create a new model and return the instance.
     *
     * @param  array  $attributes
     */
    public function create(array $attributes = [])
    {
        return $this->newModelInstance($attributes);
    }

    /**
     * Create a new instance of the model being queried.
     *
     */
    public function newModelInstance($attributes = [])
    {
        return $this->model->newInstance($attributes);
    }

    /**
     * Create a collection of models from plain arrays.
     *
     * @param  array  $items
     * @return \Illuminate\Support\Collection
     */
    public function hydrate(array $items)
    {
        $instance = $this->newModelInstance();

        return $instance->newCollection(array_map(function ($item) use ($instance) {
            return $instance->newInstance($item);
        }, $items));
    }
}