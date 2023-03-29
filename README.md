[![Latest Version on Packagist](https://img.shields.io/packagist/v/gigabait/laravel-sso.svg?style=flat-square)](https://packagist.org/packages/gigabait/laravel-sso)
[![Total Downloads](https://img.shields.io/packagist/dt/gigabait/laravel-sso.svg?style=flat-square)](https://packagist.org/packages/gigabait/laravel-sso)

# Laravel SSO

Laravel SSO is a PHP library for implementing single sign-on (SSO) authorizations in Laravel web applications.

## Installation

You can install the library via Composer:

```bash
composer require gigabait/laravel-sso
```

## Requirements

- PHP 7.3+ / 8.0+
- illuminate/support 8.0+

## Usage

The package provides a `SsoServiceProvider` that you can add to the providers array in your Laravel application config:

```php
// config/app.php

'providers' => [
    // ...
    Gigabait\Sso\SsoServiceProvider::class,
],
```

## Autoloading

The package follows PSR-4 autoloading standards. The namespace prefix `Gigabait\\Sso\\` maps to the `src/` directory.

## License

This project is licensed under the MIT License. See the [LICENSE](https://github.com/gigabait/laravel-sso/blob/main/LICENSE) file for details.
