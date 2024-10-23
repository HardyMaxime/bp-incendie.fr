<?php

class Images
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    public function __construct()
    {
        add_action("after_setup_theme", [$this, 'custom_images_sizes']);
        add_filter('upload_mimes', [$this, 'add_svg_support']);
        add_filter( 'intermediate_image_sizes', [$this, 'remove_default_img_sizes'], 10, 1);
    }

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Images();
        }
        return self::$_instance;
    }

    // Function pour supprimer ou ajouter un nouveau format d'image
    public function custom_images_sizes()
    {
        // Supprimer les formats d'images de base
        //remove_image_size('thumbnail');       
        //remove_image_size('medium');          
        remove_image_size('medium_large');   
        remove_image_size('large'); 
        remove_image_size( '768x432' );
        remove_image_size( '1536x864' );

        // Ajout d'un nouveau format
        add_image_size('thumb', 185, 185, false);
        add_image_size('listing', 495, 300, false);
        //add_image_size('mobile', 490, 385, false);
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

new Images();