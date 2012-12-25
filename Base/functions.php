<?php

/**
 * Base Theme: functions.php file
 *
 * Loads Base Theme Class
 * which analyzes config.php file contents
 * - adding certain functionalities automatically
 * - loading and setting base theme plugins
 * - allowing faster development 
 * - assuring consistency
 *
 * @package WordPress
 * @subpackage Base Theme
 * @author Rafal Gicgier rafal@x-team.com
 */
define( 'WP_BASE_DOMAIN', 'wp_base_domain' );

require_once trailingslashit( get_template_directory() ) . '/base-config/base_theme_config.php';

// instantiate config values, based on the config files
if ( class_exists( 'Base_Theme_Config' ) ) {
	$config = new Base_Theme_Config();
}
