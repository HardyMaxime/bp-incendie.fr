<?php

namespace App\Providers;

use App\Providers\AbstractProvider;

final class ControllersProvider extends AbstractProvider
{
    private array $controllers = [
        \App\Controllers\PageController::class,
        // \App\Controllers\AutreController::class,
    ];

    public function register(): void
    {
        $this->on('after_setup_theme', function()
        {
            foreach($this->controllers as $controller)
            {
                $controller::getInstance();
            }
        });
    }

}