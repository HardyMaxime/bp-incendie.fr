<?php

namespace App;

final class Kernel
{
    private array $providers = [
        Providers\ThemeProvider::class,
        Providers\SecurityProvider::class,
        Providers\MediaProvider::class,
        Providers\MenuProvider::class,
        Providers\AdminProvider::class,
        Providers\AssetsProvider::class,
        Providers\EditorProvider::class,
        Providers\ControllersProvider::class,
    ];

    public function boot(): void
    {
        foreach ($this->providers as $provider) {
            (new $provider())->register();
        }
    }
}