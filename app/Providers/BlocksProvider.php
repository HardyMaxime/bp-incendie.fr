<?php

namespace App\Providers;

use App\Providers\AbstractProvider;

final class BlocksProvider extends AbstractProvider
{
    private array $blocks = [
        \App\Blocks\ThemeBlocks::class,
        // \App\Controllers\AutreController::class,
    ];

    public function register(): void
    {
        $this->on('acf/init', function()
        {
            foreach($this->blocks as $block)
            {
                $block::getInstance()->register();
            }
        });
    }
}