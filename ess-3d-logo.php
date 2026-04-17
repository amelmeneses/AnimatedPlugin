<?php
/**
 * Plugin Name: ESS 3D Logo
 * Description: Interactive 3D geo-animated logo widget for Elementor
 * Version: 1.0.0
 * Requires PHP: 8.0
 * Requires at least: 6.0
 * Author: ESS
 */

defined('ABSPATH') || exit;

define('ESS_3D_LOGO_VERSION', '1.0.0');
define('ESS_3D_LOGO_PATH', plugin_dir_path(__FILE__));
define('ESS_3D_LOGO_URL', plugin_dir_url(__FILE__));

require_once ESS_3D_LOGO_PATH . 'includes/class-plugin.php';

ESS_3D_Logo\Plugin::instance();
