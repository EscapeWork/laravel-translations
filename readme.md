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

### Creating the locales

First, you need to create the locales that your models will be translated.

```
EscapeWork\Translations\Locale::create(['id' => 'pt-br', 'title' => 'Português (Brasil)']);
EscapeWork\Translations\Locale::create(['id' => 'en',    'title' => 'English']);
```

Then, you need to import the `Translatable` in your models.

```
use EscapeWork\Translations\Translatable;
...

class Product extends Model
{

    use Translatable;
}
```

### Storing a translation

For storing a translation, you can do the following:

```
use EscapeWork\Translations\Translation;

$translation = new Translation;
$translation->store($model, $locale, (array) $fields); // fields can be an array with as many fields you want
```

### Deleting translations from a model

```
use EscapeWork\Translations\Translation;

$translation = new Translation;
$translation->deleteFromModel($model); // $model should be an instance of Eloquent Model
```

## License

See the [License](https://github.com/EscapeWork/laravel-asset-versioning/blob/master/LICENSE) file.
