<?php

// laravel-duplo/src/DuploServiceProvider.php

namespace HopekellDev\LaravelDuplo;

use Illuminate\Support\ServiceProvider;

class DuploServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/duplo.php' => config_path('duplo.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/duplo.php', 'duplo');
    }
}

