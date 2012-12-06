<?php

/**
 * Base Theme Config Class which handles certain confiuration
 * values semi-automatically taking values from the config.php file
 * 
 * @package WordPress
 * @subpackage Base Theme
 * @author Rafal Gicgier rafal@x-team.com
 */
class Base_Theme_Config {

	static public $array = array( );
	private $config = array( );

	/**
	 * Load the config file from the base-config directory
	 * iterate through all config entries
	 * 
	 * @return {array} reference to the config array	
	 */
	function __construct($args = array( )) {

		$include_path = TEMPLATEPATH . DIRECTORY_SEPARATOR;

		$args = array_merge(
				array(
			'config_file' => TEMPLATEPATH . DIRECTORY_SEPARATOR . 'base-config/config.php',
				), $args
		);
		extract( $args );

		if ( is_array( $args ) ) {
			if ( array_key_exists( 'config_file', $args ) ) {
				$config = require($config_file);
			}
			// check if it's assoc array
			if ( self::is_assoc_array( $config ) ) {

				// enqueue scripts
				if ( array_key_exists( 'scripts', $config ) ) {
					$this->config['scripts'] = $config['scripts'];
					add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );
				}

				// add theme settings (see Base_Settings class for details)
				if ( array_key_exists( 'settings', $config ) ) {
					require_once $include_path . '/base-config/plugins/settings.class';
					$args = $config['settings'];
					if ( class_exists( 'Base_Settings' ) ) {
						$settings = new Base_Settings( $args );
					}
				}
				// add post types (see Base_Post_Types class for details)
				if ( array_key_exists( 'post_types', $config ) ) {
					require_once STYLESHEETPATH . '/base-config/plugins/post_types.class';
					$args = $config['post_types'];
					if ( class_exists( 'Base_Post_Types' ) ) {
						$posts = new Base_Post_Types( $args );
					}
				}

				// load eny extra files, provided in the config from the includes directory 
				if ( array_key_exists( 'includes', $config ) ) {
					foreach ( $config['includes'] as $key => $value ) {
						if ( true === $value ) {
							include_once $include_path . 'includes/' . $key . '.php';
						}
					}
				}
				//@todo run debug (force files to be included from includes)
			} else {
				throw new Exception( 'No config values found or config is not an associative array' );
			}
		}
	}

	/**
	 * Test to see if a value is an associative array
	 * @param {mixed} $value
	 * @return {bool}
	 * 
	 * Kudos Weston Ruter weston@x-team.com http://weston.ruter.net/ 
	 */
	static function is_assoc_array($value) {
		if ( !is_array( $value ) ) {
			return false;
		}
		$has_index_key = in_array( true, array_map( 'is_int', array_keys( $value ) ) );
		return !$has_index_key;
	}

	/**
	 * Automatically generate pages based on the argument supplied
	 * 
	 * @todo @param {bool} $auto auto generate randomly named number of pages with Lorem Ipsum as content
	 * @todo add WP default page
	 * 
	 * @param {array} $pages - array of pages
	 * 
	 * @return {bool}
	 */
	static function generate_pages($pages = array( ), $auto = false) {

		foreach ( $pages as $key => $page ) {

			$my_post = array(
				'post_title' => $key,
				'post_content' => isset( $page['content'] ) ? $page['content'] : '',
				'post_status' => 'publish',
				'post_type' => 'page'
			);

			wp_insert_post( $my_post );
		}
	}

	/**
	 * Utility to load front end scripts based on the config.php scripts array 
	 * 
	 * @run at init via add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) ); 
	 * 
	 * Auto appends the version number (arg set to false http://codex.wordpress.org/Function_Reference/wp_enqueue_script)
	 * 
	 * @param {array} $scripts 
	 * 
	 * @todo @param {bool} $autoload scripts
	 * @todo add functionality to deregister default scripts
	 */
	public function load_scripts() {

		// by default load all scripts values in the footer 
		$in_footer = true;

		$scripts = $this->config['scripts'];

		// contains trailing slash
		$scripts_dir = get_template_directory_uri() . '/_ui/js/';

		// iterate through each script, register it and enqueu if needed
		foreach ( $scripts as $script ) {
			if ( self::is_assoc_array( $script ) ) {
				
				// WP included scripts won't be affected by wp_register_script
				if ( isset( $script['handle'] ) ) {
					wp_register_script( $script['handle'], $scripts_dir . $script['file'], isset( $script['deps'] ) ? $script['deps'] : array(), false, isset( $script['in_footer'] ) ? $script['in_footer'] : $in_footer  );
				} else {
					throw new Exception( 'Script handle undefined ' . $script . ' please check config.php.' );
				}
				if ( $script['enqueue'] ) {
					wp_enqueue_script( $script['handle'] );
				}
			}
		}
	}

	/**
	 * These below can be omitted - unimplemented
	  ------------------------------------------------------------------------ */

	/**
	 * TODO feel free to omit the code now
	 * 
	 * @param type $widgets 
	 */
	static function widgets($widgets = array( )) {
		$path = '';
		if ( !empty( $widgets ) ) {
			foreach ( $widgets as $widget ) {
				// 1. include the class based on $widget, throw an error if not exists
				// any other way than via create_function?
				add_action( 'widgets_init', create_function( '', 'register_widget( "' . $widget . '" );' ) );
			}
		}
	}

	/**
	 *  TODO feel free to omit the code now
	 *  Lazy way of loading scripts - do that automatically in footer, using the default jQuery
	 */
	private function autoload_scripts() {
		
	}

	/**
	 * TODO feel free to omit the code now - extend the settings api with some default values 
	 */
	private function load_settings() {
		
	}

	/**
	 * Add debug options for inexperienced users 
	 */
	static function debug() {
		if ( $autoload ) {
			echo 'Warning the scripts are auto loaded';
		}
	}

}