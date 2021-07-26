<?php

namespace r94ever\LaravelModelSetting\Interfaces;

interface HasSettingContract
{
    public function saveSettings(array $settings): self;

    public function hasSetting(string $key): bool;

    public function hasSettings(array $keys, $any = false): bool;

    public function getSetting(string $key, $default = null);

    public function getSettings(array $keys): ?array;
}
