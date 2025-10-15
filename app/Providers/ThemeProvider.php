<?php

namespace App\Providers;

use App\Providers\AbstractProvider;

final class ThemeProvider extends AbstractProvider
{
    public function register(): void
    {
        $this->on('after_setup_theme', [self::class, 'setup']);
        $this->filter('use_block_editor_for_post', [$this, 'disable_gutenberg'], 10, 2);
        $this->filter('excerpt_length', [$this, 'custom_excerpt_length'], 10, 1);
    }

    public static function setup(): void
    {
        add_theme_support('post-thumbnails');
        add_theme_support( 'html5', [ 'script', 'style', "caption", 'search-form', 'gallery' ] );
        add_theme_support("menus");
    }

    /**
     * Désactive Gutenberg pour tous les posts.
     * @param bool $can_edit
     * @param \WP_Post|int|null $post
     */
    public function disable_gutenberg(bool $can_edit, $post): bool
    {
        return false;
    }

    /**
     * Force une longueur d’extrait à 50 mots.
     */
    public function custom_excerpt_length(int $length): int
    {
        return 50;
    }
}