<?php

namespace App\Providers;

use App\Providers\AbstractProvider;

final class AcfProvider extends AbstractProvider
{
    public function register(): void
    {
        $this->on('acf/init', [$this, "acf_wysiwyg_remove_wpautop"]);
        $this->on('acf/init', function () {
            $dir = plugin_dir_path(__FILE__) . '../Config/Acf-fields';
            $this->filter('acf/settings/save_json', fn($path) => $dir);
            $this->filter('acf/settings/load_json', fn($paths) => array_merge($paths, [$dir]));
        });
        $this->filter( 'site_transient_update_plugins', [$this, 'disable_acf_plugin_updates']);
    }

    public function acf_wysiwyg_remove_wpautop()
    {
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
}