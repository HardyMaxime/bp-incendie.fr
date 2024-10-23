<?php

define("MAIN_MENU", "navigation-primaire");
define("SECONDARY_MENU", "navigation-secondaire");

class Menu
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'clbs_register_menu']);
        add_filter('nav_menu_link_attributes', [$this, 'clbs_add_class_on_link'], 10, 4);
        add_filter('nav_menu_css_class', [$this, 'clbs_add_additional_class_on_li'], 10, 4);
    }

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Menu();
        }
        return self::$_instance;
    }

    public function clbs_register_menu()
    {
        register_nav_menu(MAIN_MENU, 'Menu principal');
        register_nav_menu(SECONDARY_MENU, 'Menu pied de page');
    }

    // Ajout une class sur les liens du menu (balise a)
    public function clbs_add_class_on_link($attrs, $item, $args, $depth)
    {
        if ($args->theme_location == MAIN_MENU) {
            if (0 !== $depth) {
                $attrs['class'] = "header-navigation-submenu-item-link";
            } else {
                $attrs['class'] = "header-menu-navigation-item-link";
            }
        }

        if ($args->theme_location == SECONDARY_MENU) {
            $attrs['class'] = "footer-bottom-link";
        }

        return $attrs;
    }

    public function clbs_add_additional_class_on_li($classes, $item, $args) {
        if(isset($args->add_li_class)) {
            $classes[] = $args->add_li_class;
        }

        if( $args->theme_location == MAIN_MENU)
        {
            $classes[] = "header-menu-navigation-item";
        }

        if (in_array('current-menu-item', $classes) ){
            $classes[] = 'active ';
        }
        return $classes;
    }
}