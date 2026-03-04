# Bootsjet

<p algin="start">
<a href="https://packagist.org/packages/m1ge0/bootsjet"><img src="https://img.shields.io/packagist/dt/m1ge0/bootsjet" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/m1ge0/bootsjet"><img src="https://img.shields.io/packagist/v/m1ge0/bootsjet" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/m1ge0/bootsjet"><img src="https://img.shields.io/packagist/l/m1ge0/bootsjet" alt="License"></a>
</p>
  
## Description

Bootsjet is a lightweight Laravel package that focuses on the `VIEW` layer of [Jetstream](https://github.com/laravel/jetstream) (Livewire stack).  
It swaps Tailwind-based frontend assets/views to Bootstrap-oriented stubs while leaving your existing backend flow (actions, models, controllers, components) untouched.

## Compatibility

- PHP: `^8.2`
- Laravel: `^11.0 | ^12.0`
- Jetstream: `^5.0` (Livewire stack)
- Livewire: `^3.0 | ^4.0`

## Laravel 12 Support

Laravel 12 is now officially supported in this package line.
Laravel 12 projects can keep using Livewire 4. Bootsjet should not force a Livewire downgrade.

## Table of Content
  * [Installation](#installation)
    + [Installing Jetstream](#installing-jetstream)
      - [Install Jetstream With Livewire](#install-jetstream-with-livewire)
    + [Install Bootsjet](#install-bootsjet)
    + [Finalizing The Installation](#finalizing-the-installation)
  <!-- * [Testing](#testing) -->
  * [License](#license)
  
  
## Installation

### Installing Jetstream

Use Composer to install Jetstream into your Laravel project:

```
composer require laravel/jetstream
```

After installing Jetstream, run `jetstream:install` with the `livewire` stack.  
You can pass `--teams` if your project needs team features:

#### Install Jetstream With Livewire

```bash

php artisan jetstream:install livewire 

or

php artisan jetstream:install livewire --teams

```

### Install UI via Composer

Install Bootstrap scaffolding support via Composer:

```
composer require laravel/ui 
```

#### Install Bootstrap with laravel/ui

```
php artisan ui bootstrap 
```


### Install Bootsjet

Install Bootsjet as a dev dependency:

```
composer require m1ge0/bootsjet --dev
```

> Install and configure [Laravel Jetstream](https://github.com/laravel/jetstream) before running the swap command.

You may use the `--teams` option to also swap team-related assets:

```bash

php artisan bootsjet:swap 

or

php artisan bootsjet:swap  --teams

```

This will publish overrides to enable Bootstrap like the good old days!

### Finalizing The Installation

After swapping Jetstream resources:

1. Ensure Tailwind packages are removed from `package.json` if they are still present.
2. Ensure Bootstrap/Sass dependencies are available in your frontend setup.
3. Install and build frontend assets.
4. Run migrations.

`bootsjet:swap` tries to update `package.json` automatically (remove Tailwind-related packages and add Bootstrap/Sass when missing). Please still review the resulting file in case your project has custom frontend constraints.

```
npm install && npm run build

php artisan migrate
```

> In production you should use `npm run build`. During development you can use `npm run dev`.


<!-- ### Extras

#### Pagination

It is also important to point out that Laravel 8 still includes pagination views built using Bootstrap CSS. To use these views instead of the default Tailwind views, you may call the paginator's useBootstrap method within your AppServiceProvider:

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
```

## Testing

Run the tests with:

```bash
vendor/bin/phpunit
```

or 

```bash
composer tests
```
 -->

## License
Bootsjet is open-sourced software licensed under the [MIT license](https://github.com/m1ge0/bootsjet/blob/master/LICENSE).
