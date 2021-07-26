<?php

namespace r94ever\LaravelModelSetting\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class SettingValueCast implements CastsAttributes
{
    public function valueIsJson($value): bool
    {
        return !is_bool($value) &&
            is_string($value) &&
            is_array(json_decode($value, true)) &&
            json_last_error() == JSON_ERROR_NONE;
    }

    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return $this->valueIsJson($value)
            ? json_decode($value, true)
            : $value;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}
