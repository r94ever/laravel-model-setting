<?php

namespace Webcp\LaravelMetadataTrait\Interfaces;

interface UseMetadataInterface
{
    /**
     * Get the column name of meta field
     *
     * @return string
     */
    public function metaColumn(): string;
}