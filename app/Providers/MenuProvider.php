<?php

namespace App\Providers;

use App\Providers\AbstractProvider;

final class MenuProvider extends AbstractProvider
{
    public function register(): void
    {
        $this->on('after_setup_theme', [$this, 'mhdy_register_nav_menu']);
    }

    public function mhdy_register_nav_menu()
    {
        register_nav_menu(MAIN_MENU, 'Menu principal');
        register_nav_menu(SECONDARY_MENU, 'Menu pied de page');
    }
}