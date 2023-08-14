<?php 

class Security
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    public function __construct()
    {
        add_filter('comment_class', [$this,'true_completely_remove_css_class']);
        add_filter('login_errors', [$this,'remove_default_login_errors']);
        add_filter('comment_class', [$this,'true_username_css_class']);
    }

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Security();
        }
        return self::$_instance;
    }

    public function remove_default_login_errors(){
        return "Erreur: nom d'utilisateur ou mot de passe incorrecte.";
    }

    public function true_username_css_class( $classes ) {
        foreach( $classes as $key => $class ) {
            if(strstr($class, "comment-author-superadmin")) {
                $classes[$key] = 'comment-author-admin';
            }
        }
        return $classes;
    }

    public function true_completely_remove_css_class( $classes ) {
        foreach( $classes as $key => $class ) {
            if(strstr($class, "comment-author-")) {
                unset( $classes[$key] );
            }
        }
        return $classes;
    }
}