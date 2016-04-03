# Laravel Translations

Easily translate your laravel models to as many languages you need.

## Installation

Add this line to your `composer.json` file:

```
    "escapework/laravel-translations": "0.1.*"
```

And add this service provider to your laravel providers:

```php
    EscapeWork\Translations\TranslationServiceProvider::class
```

And publish the migrations running the following command:

```bash
$ php artisan vendor:publish --provider="EscapeWork\Translations\TranslationServiceProvider"
$ php artisan migrate
```

## Usage

TODO

## License

See the [License](https://github.com/EscapeWork/laravel-asset-versioning/blob/master/LICENSE) file.