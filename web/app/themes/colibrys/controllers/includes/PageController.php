<?php

class PageController extends AbstractController
{
    private static $_instance; // L'attribut qui stockera l'instance unique
    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new PageController();
        }
        return self::$_instance;
    }

    public function __construct()
    {
    }
}