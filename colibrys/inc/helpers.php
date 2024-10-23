<?php
/*
* Class avec des fonctions d'aides
*/
class Helpers
{

    const CONTACTSLUG = 'contact';
    const MENTIONS = 'mentions-legales';
    const RGPD = 'charte-rgpd';

    static function get_configurateur_id()
    {
        return 252;
    }

    static function get_contact_slug() {
        return  self::CONTACTSLUG;
    }

    static function get_mentions_slug() {
        return  self::MENTIONS;
    }

    static function get_rgpd_slug() {
        return  self::RGPD;
    }

    static function get_id_by_slug($page_slug) {
        $page = get_page_by_path($page_slug);
        if ($page) {
            return $page->ID;
        } else {
            return null;
        }
    } 

    static function str_starts_with ( $haystack, $needle ) {
        return strpos( $haystack , $needle ) === 0;
    }

    static function add_admin_column($column_title, $post_type, $cb){

        // Column Header
        add_filter( 'manage_' . $post_type . '_posts_columns', function($columns) use ($column_title) {
            $columns[ sanitize_title($column_title) ] = $column_title;
            return $columns;
        } );
    
        // Column Content
        add_action( 'manage_' . $post_type . '_posts_custom_column' , function( $column, $post_id ) use ($column_title, $cb) {
    
            if(sanitize_title($column_title) === $column){
                $cb($post_id);
            }
    
        }, 10, 2 );
    }

    static function getWebp(string $url)
    {
        $url = str_replace('.jpg', '.webp', $url);
        $url = str_replace('.png', '.webp', $url);
        return $url;
    }

    public static function truncate($text, $max = 10) {

        //specify number fo characters to shorten by
        if (strlen($text) <= $max) {
            return $text;
        }
        $text = strip_tags($text)." ";
        $text = substr($text,0,$max);
        $text = substr($text,0,strrpos($text,' '));
        $text = $text;
        
        return $text."...";
    }
}

/*
* Class pour gerer les informations sur les utilisateurs (rôles, etc.)
*/
class User_Info
{
    function __construct()
    {
        $this->user = wp_get_current_user();
    }

    function check_roles(string $role): bool
    {
        $result = false;
        if ( in_array( $role, (array) $this->user->roles ) ) {
            $result = true;
        }

        return $result;
    }

}
