<?php
/**
 * Plugin Name: App Bootstrap
 */

use App\Helpers\ThemeHelper;

require_once dirname(__DIR__, 3) . '/vendor/autoload.php';

defined('ABSPATH') or die('');

define("MAIN_MENU", "navigation-primaire");
define("SECONDARY_MENU", "navigation-secondaire");

if(!function_exists('Theme'))
{
    function Theme(): ThemeHelper
    {
        static $instance = null;

        if($instance === null)
        {
            $instance = new ThemeHelper();
        }

        return $instance;
    }
}

add_action('plugins_loaded', function () {
    (new App\Kernel())->boot();
});