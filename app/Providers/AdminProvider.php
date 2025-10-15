<?php

namespace App\Providers;

use App\Providers\AbstractProvider;

final class AdminProvider extends AbstractProvider
{
    public function register(): void
    {
        $this->on('admin_menu', [$this, 'remove_pages_in_admin']);
        $this->on('admin_bar_menu', [$this, "remove_customize_button"], 999);
        $this->on('admin_enqueue_scripts', [$this,'mhdy_register_admin_styles_and_scripts'], 11);
    }

    public function remove_pages_in_admin()
    {
        remove_menu_page("edit.php");
        remove_menu_page("edit-comments.php");
        remove_submenu_page('themes.php', 'site-editor.php?path=/patterns');
        remove_submenu_page('themes.php', 'customize.php?return=%2Fwp%2Fwp-admin%2F');
    }

    public function disable_rest_api($result)
    {
        if (true === $result || is_wp_error($result)) {
            return $result;
        }
        global $wp;
        if (!is_user_logged_in()) {
            return new \WP_Error(
                'rest_not_logged_in',
                __('You are not currently logged in.'),
                array('status' => 401)
            );
        }
        return $result;
    }

    public function remove_customize_button($wp_admin_bar)
    {
        $wp_admin_bar->remove_node('comments');
        $wp_admin_bar->remove_node('customize');
        $wp_admin_bar->remove_node('new-content');
        $wp_admin_bar->remove_node('updates');
    }

    public function mhdy_register_admin_styles_and_scripts() {
        wp_enqueue_style('admin-styles', get_template_directory_uri().'/assets/admin/admin.css');
        wp_enqueue_script('admin-scripts', get_template_directory_uri().'/assets/admin/admin.js');
    }
}