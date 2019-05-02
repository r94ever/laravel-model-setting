# Laravel Metadata trait

[![Latest Version on Packagist](https://img.shields.io/packagist/v/webcp/laravel-metadata-trait.svg?style=flat-square)](https://packagist.org/packages/webcp/laravel-metadata-trait)

## Installation

You can install the package via composer:

```bash
composer require webcp/laravel-metadata-trait
```

## Usage

Implement `UseMetadataInterface` then add `HasMetaData` trait to your model

``` php
<?php

use Illuminate\Database\Eloquent\Model;
use Webcp\LaravelMetadataTrait\Interfaces\UseMetadataInterface;
use Webcp\LaravelMetadataTrait\Traits\HasMetadata;

class Post extends Model implements UseMetadataInterface
{
    use HasMetadata;
```

By default, the meta column name in database is `meta`. If your model uses another one, add `metaColumn()` method to
overwrite the default method:

```php
public function metaColumn()
{
    return 'meta_data';
}
```

Check model has meta key or not:

```php
$model->hasMetaKey($key)   // return true or false
```

Get value of the given meta key
```php
$model->getMetaData($key)
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

### Security

If you discover any security related issues, please email vandt147@outlook.com instead of using the issue tracker.

## Credits

- [Dương Thành Văn](https://github.com/webcp)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).