<?php

namespace LearnKit\ExposeAbout;

use Illuminate\Support\ServiceProvider;

class ExposeAboutServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'expose-about');
        $this->loadRoutesFrom(__DIR__.'/../routes/about.php');
    }

    public function boot(): void
    {
        $this->publish();
    }

    protected function publish(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('expose-about.php'),
        ], 'expose-about-config');
    }
}