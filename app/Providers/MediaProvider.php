<?php

namespace App\Providers;

use App\Providers\AbstractProvider;

final class MediaProvider extends AbstractProvider
{
    public function register(): void
    {
        $this->filter('upload_mimes', [$this, 'add_svg_support']);
        $this->filter( 'intermediate_image_sizes', [$this, 'remove_default_img_sizes'], 10, 1);
    }

    public static function add_image_size(): void
    {
        add_image_size('thumb', 200, 200, false);
    }

    public static function remove_image_size(): void
    {
        remove_image_size('medium_large');   
        remove_image_size('large'); 
        remove_image_size( '768x432' );
        remove_image_size( '1536x864' );
    }

    // Support pour les SVG
    public function add_svg_support($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }

    // Supprimer les formats d'images de base
    public function remove_default_img_sizes( $sizes ) {
        $targets = ['medium_large', 'large', '1536x1536', '2048x2048'];
        foreach($sizes as $size_index=>$size) {
            if(in_array($size, $targets)) {
                unset($sizes[$size_index]);
            }
        }
        return $sizes;
    }
}