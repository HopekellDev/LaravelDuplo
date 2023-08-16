<?php

// packages/laravel-duplo/src/DuploServiceProvider.php
/**
 * Duplo's B2B payment laravel package
 * @author Hope Chukwuemeka Ezenwa - Hopekell <hopekelltech@gmail.com>
 * @version 1.0
 **/

namespace HopekellDev\LaravelDuplo;

use Illuminate\Support\ServiceProvider;

class DuploServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Copy the configuration file
        $this->publishes([
            __DIR__ . '/../config/duplo.php' => config_path('duplo.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/duplo.php', 'duplo');
    }
}
