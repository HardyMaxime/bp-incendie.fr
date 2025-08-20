<?php

class Assets
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    public function __construct()
    {
        add_action("wp_enqueue_scripts", [$this,'add_assets_scripts']);
        add_action( 'wp_default_scripts', [$this,'remove_jquery_migrate']);
        add_filter('script_loader_tag', [$this,'add_defer_attribute'], 10, 2);
        add_action( 'wp_enqueue_scripts', [$this,'clb_custom_jquery']);
        add_action('admin_enqueue_scripts', [$this,'clb_admin_style'], 11);
        add_action('wp_enqueue_scripts', [$this,'clb_remove_jquery']);
    }

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Assets();
        }
        return self::$_instance;
    }

    public function add_assets_scripts()
    {
        foreach(site::getCheminStylesAssets() as $key => $sourceStyle)
            wp_enqueue_style($key, $sourceStyle, array(), Site::getVersion());
        foreach(site::getCheminScriptsAssets() as $key => $sourceScript)
            wp_enqueue_script($key, $sourceScript, array(), Site::getVersion());

        // Ajout du nonce pour les appels ajax
        wp_localize_script('index', 'ajax_var', array(
            'url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ajax-nonce')
        ));
    }

    // Supprimer JQUERY MIGRATE sur le front
    public function remove_jquery_migrate( $scripts ) {
        if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
            $script = $scripts->registered['jquery'];
            if ( $script->deps ) { 
                $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
            }
        }
    }

    // Ajout l'attribut Defer sur les scripts js
    public function add_defer_attribute($tag, $handle) {
        // ajouter les handles de mes scripts au array ci-dessous. Ici 3 scripts par exemple.
        $scripts_to_defer = array('index' );
        foreach($scripts_to_defer as $defer_script) {
          if ($defer_script === $handle) {
            return str_replace(' src', ' type="module" defer="defer" src', $tag);
          }
        }
        return $tag;
    }

    public function clb_custom_jquery() { 
        if ( !is_admin() ) { 
            wp_deregister_script( 'jquery' ); 
            //La fonction supprime l'utilisation du fichier original de JQuery sur votre serveur     
            wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
            //La fonction charge JQuery     
            wp_enqueue_script( 'jquery' );    
        }
    }

    // Css pour la partie admin
    public function clb_admin_style() {
        wp_enqueue_style('admin-styles', get_template_directory_uri().'/assets/admin/admin.css');
        wp_enqueue_script('admin-scripts', get_template_directory_uri().'/assets/admin/admin.js');
    }

    // Supprime completement Jquery
    function clb_remove_jquery() {
        if ( ! is_admin() ) {
           wp_deregister_script('jquery');
           wp_register_script('jquery', false);
        }
    }
}