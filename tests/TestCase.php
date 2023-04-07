<?php

namespace LearnKit\ExposeAbout\Tests;

use LearnKit\ExposeAbout\ExposeAboutServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function defineEnvironment($app): void
    {
        $app['config']->set('app.key', 'base64:yDt5+GiUDRGNCFMLd5L9L7/dIc3wg/7ZmNhNVZEL8SA=');
    }

    protected function getPackageProviders($app): array
    {
        return [
            ExposeAboutServiceProvider::class,
        ];
    }
}