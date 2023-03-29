[![Latest Version on Packagist](https://img.shields.io/packagist/v/gigabait/laravel-sso.svg?style=flat-square)](https://packagist.org/packages/gigabait/laravel-sso)
[![Total Downloads](https://img.shields.io/packagist/dt/gigabait/laravel-sso.svg?style=flat-square)](https://packagist.org/packages/gigabait/laravel-sso)

# Laravel SSO

Laravel SSO is a package for implementing Single Sign-On (SSO) authorizations in your Laravel project. This package allows you to authorize users on a Laravel panel from another website.

## Requirements

- PHP 7.3 or higher
- Laravel 8.0 or higher

## Installation

To install the package, use Composer:

```bash
composer require gigabait/laravel-sso
```

## Configuration
1. Publish the configuration file by running the following command:
```bash
php artisan vendor:publish --tag=sso
```
This command will publish the config/sso.php file, where you can set the secret key for SSO authorization.

2. Set the secret key in your .env file:
```env
SSO_SECRET_KEY=your_secret_key
```

## Usage

1. To authorize users on the Laravel panel from another website, first perform SSO authorization on your website.
2. Redirect the user to the /sso-login route with a GET parameter auth_marker containing the encrypted user data in JSON format. For example:

```php
$authMarkerData = [
    'email' => $user->email,
    'secret_key' => config('sso.secret_key')
];

$encryptedAuthMarker = Crypt::encrypt(json_encode($authMarkerData));

$url = url('/sso-login', ['auth_marker' => $encryptedAuthMarker]);
```
After being redirected to the /sso-login route, the user will be automatically authorized on the Laravel panel if their email address matches a record in the database.

The package provides a `SsoServiceProvider` that you can add to the providers array in your Laravel application config:

```php
// config/app.php

'providers' => [
    // ...
    Gigabait\Sso\SsoServiceProvider::class,
],
```

## Support

If you have any questions or issues, please create a new issue in the project repository on GitHub.

## Autoloading

The package follows PSR-4 autoloading standards. The namespace prefix `Gigabait\\Sso\\` maps to the `src/` directory.

## License

This project is licensed under the MIT License. See the [LICENSE](https://github.com/GIGABAIT93/LaravelSso/blob/main/LICENSE) file for details.
