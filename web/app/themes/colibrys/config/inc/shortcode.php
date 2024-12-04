<?php

class Custom_Shortcode
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    public function __construct()
    {
        //add_shortcode('nbBoutique', [$this, 'shortcode_nbBoutique']);
    }

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Custom_Shortcode();
        }
        return self::$_instance;
    }

    /*
     public function shortcode_slider_keyword($params)
    {
        $key =
        shortcode_atts(
            array(
                'value' => '',
                ),
                $params
        );
        return "<strong class='decode_text' >".$key['value']."</strong>";
    }
    
    public function shortcode_nbBoutique()
    {
        $count = wp_count_posts('shop');
        return $count->publish;
    }
    */
}
