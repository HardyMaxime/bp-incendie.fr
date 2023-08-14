<?php 

defined('ABSPATH') or die('');
define('CLBS_ACF_PATH', plugin_dir_path(__FILE__));
define('CLBS_DIR_PATH', plugin_dir_path(__FILE__));

// Lib
require_once('inc/helpers.php');
require_once('lib/post-type/PostType.php');
require_once('lib/post-type/Taxonomy.php');

// Config
require_once('site.php');

// Files
require_once('inc/supports.php');
require_once('inc/admin.php');
require_once('inc/security.php');
require_once('inc/reset.php');
require_once('inc/assets.php');
require_once('inc/acf.php');
require_once('inc/menu.php');
require_once('inc/form.php');
require_once('inc/editor.php');
require_once('inc/shortcode.php');

Supports::getInstance();
Admin::getInstance();
Security::getInstance();
Reset::getInstance();
Assets::getInstance();
ACF_CONFIG::getInstance();
Menu::getInstance();
Form::getInstance();
Editor::getInstance();
Custom_Shortcode::getInstance();

// Controllers
require_once('controllers/index.php');