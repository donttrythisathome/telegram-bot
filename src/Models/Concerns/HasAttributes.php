<?php

namespace Dtth\TelegramBot\Models\Concerns;

trait HasAttributes
{
    protected $attributes = [];

    /**
     *
     *
     * @return
     */
    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     *
     *
     * @return
     */
    public function getAttribute($key)
    {
        if (!$key){
            return;
        }

        $attribute = array_get($this->attributes,$key);
        $relation = array_get($this->relations,$key);

        //Determine if model has relation named by given key
        if (is_array($attribute) && $relation) {
            return new $relation($attribute);
        }

        return $attribute;
    }
}