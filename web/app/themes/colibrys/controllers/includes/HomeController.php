<?php

class HomeController
{
    private static $_instance; // L'attribut qui stockera l'instance unique
    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new HomeController();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        //add_filter('acf/fields/flexible_content/layout_title/name=header', array( $this, 'adminTitleHeader' ), 10, 4);
    }

    /*
    public static function adminTitleHeader($title, $field, $layout, $i)
    {
        $text = (get_sub_field('content') ? (get_sub_field('content')) : false);
        $title = "Slide of the header";
        if( $text ) {
            $title = '<b>' . esc_html(substr($text['label_pagination'], 0,100)) . '</b>';
        }
        return $title;
    }
    */

}