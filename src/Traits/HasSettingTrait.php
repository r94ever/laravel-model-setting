<?php

namespace r94ever\LaravelModelSetting\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use r94ever\LaravelModelSetting\Models\ModelSetting;

/**
 * Trait HasSettingTrait
 * @package r94ever\LaravelModelSetting\Traits
 *
 * @property \r94ever\LaravelModelSetting\Models\ModelSetting setting
 * @method static Builder|self whereSetting(string $key, $value)
 */
trait HasSettingTrait
{
    public function setting()
    {
        return $this->morphOne(ModelSetting::class, 'model');
    }

    public function saveSettings(array $settings): self
    {
        $newData = array_merge($this->setting->settings ?? [], $settings);

        $this->setting()->save(new ModelSetting(['settings' => $newData]));

        return $this;
    }

    public function hasSetting(string $key): bool
    {
        return Arr::has($this->setting->settings, $key);
    }

    public function hasSettings(array $keys, $any = false): bool
    {
        return $any
            ? Arr::hasAny($this->setting->settings, $keys)
            : Arr::has($this->setting->settings, $keys);
    }

    public function getSetting(string $key, $default = null)
    {
        return Arr::get($this->setting->settings, $key, $default);
    }

    public function getSettings(array $keys): ?array
    {
        if (! $this->hasSettings($keys, true)) {
            return null;
        }

        return collect($keys)
            ->filter(function ($key) {
                return $this->hasSetting($key);
            })
            ->mapWithKeys(function ($key) {
                return [$key => $this->getSetting($key)];
            })->toArray();
    }

    public function scopeWhereSetting(Builder $builder, string $key, $value): Builder
    {
        return $builder->whereJsonContains(
            str_replace('.', '->', $key),
            $value
        );
    }
}
