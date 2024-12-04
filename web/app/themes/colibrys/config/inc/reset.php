<?php

class Reset
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    public function __construct()
    {
        remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
        remove_action('wp_head', 'wp_generator'); // remove wordpress version
        remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
        remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
        remove_action('wp_head', 'index_rel_link'); // remove link to index page
        remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
        remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
        remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
        remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); // Remove shortlink
        remove_action( 'wp_head', 'wp_resource_hints', 2 ); // Remove dns-prefetch Link

        // action
        add_action( 'after_setup_theme', [$this,'clbs_remove_json_api']);
        add_action( 'after_setup_theme', [$this,'clbs_disable_json_api']);
        add_action( 'wp_enqueue_scripts', [$this,'clbs_remove_wp_block_library_css'], 100);
    }

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Reset();
        }
        return self::$_instance;
    }

    /*
    * Remove JSON API links in header html
    */
    public function clbs_remove_json_api () {

        // Remove the REST API lines from the HTML Header
        remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
    
        // Remove the REST API endpoint.
        remove_action( 'rest_api_init', 'wp_oembed_register_route' );
    
        // Turn off oEmbed auto discovery.
        add_filter( 'embed_oembed_discover', '__return_false' );
    
        // Don't filter oEmbed results.
        remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
    
        // Remove oEmbed discovery links.
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    
        // Remove oEmbed-specific JavaScript from the front-end and back-end.
        remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    }

    /*
	Snippet completely disable the REST API and shows {"code":"rest_disabled","message":"The REST API is disabled on this site."} 
	when visiting http://yoursite.com/wp-json/
    */
    public function clbs_disable_json_api () {
        // Filters for WP-API version 1.x
        add_filter('json_enabled', '__return_false');
        add_filter('json_jsonp_enabled', '__return_false');
        // Filters for WP-API version 2.x
        add_filter('rest_enabled', '__return_false');
        add_filter('rest_jsonp_enabled', '__return_false');
    }

    // Supprime les block guthemberg côté front
    public function clbs_remove_wp_block_library_css(){
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wc-block-style' ); // REMOVE WOOCOMMERCE BLOCK CSS
        wp_dequeue_style( 'global-styles' ); // REMOVE THEME.JSON
    }
}