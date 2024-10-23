<?php 
/*
* Class pour gérer les assets (styles et scripts)
*/
define("NUMVER", "0.0.1");
define("nomTheme", "colibrys");

class Site
{
    function __construct ()
    {

    }

    static function getPreloadAssets()
    {
       $preloads = array(
            "style" => array(
                "links" => array(
                    get_template_directory_uri().'/assets/ressources/css/index.css'. '?ver=' . NUMVER,
                ),
                "type" => "text/css"
            ),
            "script" => array(
                "links" => array(
                    get_template_directory_uri().'/assets/ressources/scripts/index.js'. '?ver=' . NUMVER
                ),
                "type" => "text/script"
            ),
            "font" => array(
                "links" => array(
                    #get_template_directory_uri().'/assets/ressources/fonts/IBMPlexSans-Regular.woff2',
                    #get_template_directory_uri().'/assets/ressources/fonts/IBMPlexSans-Light.woff2',
                    #get_template_directory_uri().'/assets/ressources/fonts/IBMPlexSans-Bold.woff2'
                ),
                "type" => "font/woff2"
            ),
            "image" => array(

            )
       );

       return $preloads;
    }

    static function getCheminStylesAssets()
    {
        $assetsCss = array(
            "style" => get_template_directory_uri() . "/assets/ressources/css/index.css"
        );

        return $assetsCss;
    }

    static function getCheminScriptsAssets()
    {
        $assetsScripts = array(
            "index" => get_template_directory_uri() . '/assets/ressources/scripts/index.js'
        );

        return $assetsScripts;
    }

    static function generatePreload()
    {
        foreach (site::getPreloadAssets() as $as => $links)
        {
            if(isset($links["type"]) && isset($links["links"]))
            {
                $type = $links["type"];
                $sources = $links["links"];
                if (is_array($sources) || is_object($sources))
                {
                    foreach($sources as $link){
                        if($as == "font")
                        {
                            echo "<link rel='preload' href='$link' as='$as' type='$type' crossorigin='anonymous' >";
                        }
                        else
                        {
                            echo "<link rel='preload' href='$link' as='$as' >";
                        }
                    }
                }
            }
        }
    }
}