<?php 

defined('ABSPATH') or die('');
define('CLBS_ACF_PATH', plugin_dir_path(__FILE__));
define('CLBS_DIR_PATH', plugin_dir_path(__FILE__));

// Lib
require_once('lib/helpers.php');
require_once('lib/post-type/PostType.php');
require_once('lib/post-type/Taxonomy.php');

// Config
require_once('site.php');

// Config Files
require_once('config/index.php');

// Controllers
require_once('controllers/index.php');