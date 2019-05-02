<?php

namespace Webcp\LaravelMetadataTrait\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasMetadata
{
    /**
     * Get the column name of meta field
     *
     * @return string
     */
    public function metaColumn():string
    {
        return 'meta';
    }

    /**
     * Check whether model has given meta data key or not
     *
     * @param string $key
     * @return bool
     */
    public function hasMetaKey(string $key)
    {
        return array_key_exists($key, $this->{$this->metaColumn()});
    }

    /**
     * Get meta data value of given key
     *
     * @param string $key
     * @return mixed|null
     */
    public function getMetaData(string $key)
    {
        return $this->hasMetaKey($key) ? $this->{$this->metaColumn()}[$key] : null;
    }

    /**
     * Scope a query to only include models which have the given meta key & meta value
     *
     * @param  Builder  $query
     * @param  string   $metaKey
     * @param  mixed    $metaValue
     *
     * @return Builder
     */
    public function scopeWhereMeta(Builder $query, $metaKey, $metaValue)
    {
        return $query->where(["{$this->metaColumn()}->{$metaKey}" => $metaValue]);
    }
}