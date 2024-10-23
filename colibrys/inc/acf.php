<?php

class ACF_CONFIG
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    public function __construct()
    {
        add_action('acf/init', [$this,'acf_wysiwyg_remove_wpautop']);
        add_filter( 'site_transient_update_plugins', [$this, 'disable_acf_plugin_updates']);
        // Configuration des fichiers JSON pour les champs ACF
        add_filter('acf/settings/save_json', [$this, 'clbs_acf_change_json_save_point']);
        add_filter('acf/settings/load_json', [$this, 'clbs_acf_change_json_load_point']);
    }

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new ACF_CONFIG();
        }
        return self::$_instance;
    }

    public function acf_wysiwyg_remove_wpautop() {
        // remove p tags //
        remove_filter('acf_the_content', 'wpautop' );
        // add line breaks before all newlines //
        add_filter( 'acf_the_content', 'nl2br' );
    }

    public function disable_acf_plugin_updates( $value ) {

        $pluginsToDisable = [
            'advanced-custom-fields-pro/acf.php',
        ];

        if ( isset($value) && is_object($value) ) {
            foreach ($pluginsToDisable as $plugin) {
                if ( isset( $value->response[$plugin] ) ) {
                    unset( $value->response[$plugin] );
                }
            }
        }
        return $value;
    }

    /**
     * Enregistrer la config de ses metaboxes & champs ACF dans un dossier de son plugin/thème
     * Filtre : acf/settings/save_json
     */

    public function clbs_acf_change_json_save_point($path) {
        $path = CLBS_ACF_PATH . 'acf-fields';
        return $path;
    }

    /**
     * Charger la config de ses metaboxes & champs ACF dans un dossier de son plugin/
     * Filtre : acf/settings/load_json
    */
    public function clbs_acf_change_json_load_point($path) {
        $path[] = CLBS_ACF_PATH . 'acf-fields';
        return $path;
    }
}