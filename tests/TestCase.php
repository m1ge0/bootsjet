<?php

namespace M1Ge0\Bootsjet\Tests;

use M1Ge0\Bootsjet\BootsjetServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            BootsjetServiceProvider::class,
        ];
    }
}
