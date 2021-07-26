# Laravel Model Setting

[![Latest Version on Packagist](https://img.shields.io/packagist/v/webcp/laravel-metadata-trait.svg?style=flat-square)](https://packagist.org/packages/webcp/laravel-metadata-trait)

## Installation

You can install the package via composer:

```bash
composer require r94ever/laravel-model-setting
```

Publish config and migration

```bash
php artisan vendor:publish --provider="r94ever\LaravelModelSetting\ModelSettingServiceProvider"
```

Open `config/model-setting.php` file then set the name of table which hold the setting data to your desire.

Run migration

```bash
php artisan migrate
```

## Usage

Implement `HasSettingsContract` then add `HasSettingData` trait to your model

``` php
use Illuminate\Database\Eloquent\Model;
use r94ever\LaravelModelSetting\Interfaces\HasSettingContract;
use r94ever\LaravelModelSetting\Traits\HasSettingTrait;

class Post extends Model implements HasSettingContract
{
    use HasSettingTrait;
    
    ...
}
```

Save settings:

```php
$model->saveSetting(array $settings);
```

Check whether model has setting:

```php
$model->hasSetting(string $key);   // return true or false
```

Check whether model has multiple given settings:

```php
$model->hasSettings(array $keys, bool $any = false);   // return true or false

// When $any is FALSE, method will return TRUE only if model has all given setting keys
// Otherwise, method will return TRUE if model has any of the given setting keys 
```

Get value of the given setting key
```php
$model->getSetting(string $key, $defaultValue);
```

Or get values from multiple setting keys

```php
$model->getSettings(array $keys);
```

Query to find model which has given meta key & meta value
```php
$post = Post::whereSetting('setting_key', $settingValue)->get();
```

For nested keys:

```php
$post = Post::whereSetting('key->sub_key->sub_sub_key', $settingValue)->get();
$post = Post::whereSetting('key.sub_key.sub_sub_key', $settingValue)->get();
```

If using MySQL or PostgreSQL, you can use array for `$settingValue`

```php
$post = Post::whereSetting('key->sub_key->sub_sub_key', ['value_1', 'value_2'])->get();
$post = Post::whereSetting('key.sub_key.sub_sub_key', ['value_1', 'value_2'])->get();
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

### Security

If you discover any security related issues, please email vandt147@outlook.com instead of using the issue tracker.

## Credits

- [Dương Thành Văn](https://github.com/r94ever)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
