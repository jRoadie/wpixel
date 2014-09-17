<?php
/**
 * Plugin Name:       	WPixel
 * Plugin URI:        	http://arraysoftlab.com
 * Description:       	Best image editor plugin for WordPress
 * Version:          	1.0.0
 * Author:            	Array Soft Lab
 * Author URI:        	http://www.arraysoftlab.com
 * License:           	GPLv2 or later
 * License URI: 		http://www.gnu.org/licenses/gpl-2.0.html
 */
use wpixel\Plugin_Core;
define('WPIXEL_VERSION', '1.0.0');
define('WPIXEL_BASE_DIR', plugin_dir_path(__FILE__));
define('WPIXEL_BASE_URL', plugin_dir_url(__FILE__));
define('WPIXEL_SLUG', 'wpixel');
require_once WPIXEL_BASE_DIR . 'includes/plugin-core.class.php';
function wpixel_init() {
    Plugin_Core::init();
}
add_action("init", "wpixel_init");