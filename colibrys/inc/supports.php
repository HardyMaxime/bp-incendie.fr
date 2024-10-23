<?php
// Gerer les formats d'images
require_once('supports/images.php');

class Supports
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    public function __construct()
    {
        Images::getInstance();
        add_action("after_setup_theme", [$this, 'supports']);
        add_filter('use_block_editor_for_post', [$this, 'disable_gutenberg'], 10);
        add_filter("excerpt_length", [$this, 'custom_excerpt_length']);
    }

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Supports();
        }
        return self::$_instance;
    }

    public function supports()
    {
        //add_theme_support("title-tag");
        add_theme_support("menus");
        add_theme_support( 'html5', [ 'script', 'style', "caption", 'search-form', 'gallery' ] );
        add_theme_support("post-thumbnails");
    }

    public function disable_gutenberg($current_status)
    {
        return false;
    }

    public function custom_excerpt_length($length)
    {
        return 50;
    }
}