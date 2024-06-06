# Laravel
Laravel implementatie van de SoftRules Userinterfaces

## Installation

You can install the package via composer:

```bash
composer require softrules/laravel
```

### Composer repositories
Installation via composer may not work until you add the following repositories to your composer.json file:

```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/my-tp-vergelijken/softrules-laravel.git"
    },
    {
        "type": "vcs",
        "url": "git@github.com:SoftRules/PHP.git"
    }
],
```

### Publish the assets and config
To publish the assets and config file run the following command:

```bash
php artisan vendor:publish --tag=softrules-assets
```

This will publish the assets to the `public/vendor/softrules` directory and the config file to the `config/softrules.php` directory.

In the config file can place your SoftRules credentials for the forms you want to start using in your application.

## Setting up the config
You can add as many forms as you like by adding entries to the `forms` array in the `config/softrules.php` file.
```php
<?php declare(strict_types=1);

return [
    'forms' => [
        [
            'product' => 'testpagina',
            'uri' => env('SOFTRULES_MYTP_TESTPAGINA_URI'),
            'username' => env('SOFTRULES_MYTP_TESTPAGINA_USERNAME'),
            'password' => env('SOFTRULES_MYTP_TESTPAGINA_PASSWORD'),
        ],
        [
            'product' => 'volmachtproducten',
            'uri' => env('SOFTRULES_VOLMACHTPRODUCTEN_URI'),
            'username' => env('SOFTRULES_VOLMACHTPRODUCTEN_USERNAME'),
            'password' => env('SOFTRULES_VOLMACHTPRODUCTEN_PASSWORD'),
        ],
    ],
];
```

### Keep the assets up-to-date
Add the following to the composer scripts:

```
"@php artisan vendor:publish --force --tag=softrules-assets --ansi"
```

For example:

```
"scripts": {
    "post-install-cmd": [
        //... default scripts
        "@php artisan vendor:publish --force --tag=softrules-assets --ansi"
    ]
},
```

## Usage

After setting up the config in the `config/softrules.php` file you can start using the SoftRules forms in your application.

Simply add a form to the blade file where you want to use the SoftRules form:
```bladehtml
{{ \SoftRules\Laravel\Facades\SoftRules::form('softrules-form-name', '<SR></SR>') }}
```

## Customisation

### Overriding SoftRules component classes
Every component in SoftRules can be customised by overriding the classes or by adding inline styles by adding the following to a `ServiceProvider`:

```php
use SoftRules\PHP\UI\Components\Button;
use SoftRules\PHP\UI\Style\ButtonComponentStyle;
use SoftRules\PHP\UI\Style\StyleData;

Button::setStyle(new ButtonComponentStyle(
    default: new StyleData(class: 'btn btn-default'),
    primary: new StyleData(class: 'btn btn-primary'),
    success: new StyleData(class: 'btn btn-success'),
    danger: new StyleData(class: 'btn btn-danger'),
));
```

For example:
```php
<?php declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SoftRules\PHP\UI\Components\Button;
use SoftRules\PHP\UI\Style\ButtonComponentStyle;
use SoftRules\PHP\UI\Style\StyleData;

final class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Button::setStyle(new ButtonComponentStyle(
            default: new StyleData(class: 'btn btn-default'),
            primary: new StyleData(class: 'btn btn-primary'),
            success: new StyleData(class: 'btn btn-success'),
            danger: new StyleData(class: 'btn btn-danger'),
        ));
    }
}
```

### Adding inline styles:

```php
use SoftRules\PHP\UI\Components\Button;
use SoftRules\PHP\UI\Style\ButtonComponentStyle;
use SoftRules\PHP\UI\Style\StyleData;

Button::setStyle(new ButtonComponentStyle(
    default: new StyleData(inlineStyle: 'background-color: #f00; color: #fff;'),
    primary: new StyleData(inlineStyle: 'background-color: blue; color: #fff;'),
    success: new StyleData(inlineStyle: 'background-color: green; color: #fff;'),
    danger: new StyleData(inlineStyle: 'background-color: red; color: #fff;'),
));
```

### Using TailWind CSS:

```php
use SoftRules\PHP\UI\Components\Button;
use SoftRules\PHP\UI\Style\ButtonComponentStyle;
use SoftRules\PHP\UI\Style\StyleData;

Button::setStyle(new ButtonComponentStyle(
    default: new StyleData(class: 'bg-gray-300 text-gray-800'),
    primary: new StyleData(class: 'bg-blue-500 text-white'),
    success: new StyleData(class: 'bg-green-500 text-white'),
    danger: new StyleData(class: 'bg-red-500 text-white'),
));
```

### Customising global colors
You can use CSS variables to customise the global colors of the SoftRules form.

```css
    #softrules-form {
        --sr-primary-color: var(--primary-color);
        --sr-secondary-color: var(--secondary-color);
    }
```
