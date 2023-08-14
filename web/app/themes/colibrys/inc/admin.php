<?php

class Admin
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    public function __construct()
    {
        add_action('admin_menu', [$this, 'remove_pages_in_admin']);
        ///add_filter('acf/settings/show_admin', [$this, 'hide_acf_menu']);
        //add_filter('rest_authentication_errors', [$this, 'disable_rest_api']);
    }

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Admin();
        }
        return self::$_instance;
    }

    public function remove_pages_in_admin()
    {
        remove_menu_page("edit.php");
        remove_menu_page("edit-comments.php");
        //remove_menu_page("backwpup");
        //remove_menu_page('complianz');
    }

    public function disable_rest_api($result)
    {
        if (true === $result || is_wp_error($result)) {
            return $result;
        }
        global $wp;
        if (!is_user_logged_in()) {
            return new WP_Error(
                'rest_not_logged_in',
                __('You are not currently logged in.'),
                array('status' => 401)
            );
        }
        return $result;
    }

    public function hide_acf_menu()
    {
        return false;
    }
}