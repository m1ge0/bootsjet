# Bootsjet

[![Latest Stable Version](https://img.shields.io/packagist/v/m1ge0/bootsjet)](//packagist.org/packages/m1ge0/bootsjet)
[![Total Downloads](https://poser.pugx.org/m1ge0/bootsjet/downloads)](//packagist.org/packages/m1ge0/bootsjet)
[![License](https://poser.pugx.org/m1ge0/bootsjet/license)](//packagist.org/packages/m1ge0/bootsjet)

  
## Description

Bootsjet is a lightweight laravel 10 package that focuses on the `VIEW` side of [Jetstream](https://github.com/laravel/jetstream) package installed in your Laravel application, so when a swap is performed, the `Action`, `MODEL`, `CONTROLLER`, `Component` and `Action` classes of your project is still 100% handled by Laravel development team with no added layer of complexity.

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

You may use Composer to install Jetstream into your new Laravel project:

```
composer require laravel/jetstream
```

If you choose to install Jetstream through Composer, you should run the jetstream:install Artisan command. This command accepts the name of the stack you prefer (livewire or inertia). You are highly encouraged to read through the entire documentation of Livewire or Inertia before beginning your Jetstream project. In addition, you may use the --teams switch to enable team support:

#### Install Jetstream With Livewire

```bash

php artisan jetstream:install livewire 

or

php artisan jetstream:install livewire --teams

```

### Install ui via composer
You need to install the bootstrap scaffolding via comopser. 

```
composer require laravel/ui 
```

#### Install bootsrap with laravel/ui

```
php artisan ui bootstrap 
```


### Install Bootsjet

Use Composer to install Bootsjet into your new Laravel project as dev dependency:

```
composer require m1ge0/bootsjet --dev
```

> It is important you install and configure [Laravel Jetstream](https://github.com/laravel/jetstream) before performing a swap.

You are highly encouraged to read through the entire documentation of [Jetstream](https://jetstream.laravel.com/1.x/introduction.html)
before beginning your Bootsjet project. In addition, you may use the `--teams` switch to swap team assets just like you would in Jetstream:

```bash

php artisan bootsjet:swap 

or

php artisan bootsjet:swap  --teams

```

This will publish overrides to enable Bootstrap like the good old days!

### Finalizing The Installation

After installing Bootsjet and swapping Jetstream resources, remove tailwindCSS and its dependencies if any from your package.json and then install and build your NPM dependencies and migrate your database:

```
npm install && npm run build

php artisan migrate
```


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
