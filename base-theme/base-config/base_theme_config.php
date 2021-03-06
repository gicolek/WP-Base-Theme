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

		$include_path = trailingslashit( get_template_directory() );

		$config_file = $include_path . '/config.php';

		$config = require($config_file);

		// check if it's assoc array
		if ( self::is_assoc_array( $config ) && !empty( $config_file ) ) {

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

			// add post types (see Base_Tax class for details)
			if ( array_key_exists( 'tax', $config ) ) {
				require_once STYLESHEETPATH . '/base-config/plugins/tax.class';
				$args = $config['tax'];
				if ( class_exists( 'Base_Tax' ) ) {
					$posts = new Base_Tax( $args );
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

			// register sidebars with default callback values
			if ( array_key_exists( 'sidebars', $config ) ) {
				$count_sidebars = 0;
				
				foreach ( $config['sidebars'] as $key => $sidebar ) {
					++$count_sidebars;

					if ( $key == 'base' )
						continue;

					register_sidebar( array(
						'name' => isset( $sidebar['name'] ) ? $sidebar['name'] : __( "Sidebar-{$count_sidebars}", WP_BASE_DOMAIN ),
						'id' => isset( $sidebar['id'] ) ? $sidebar['id'] : "sidebar-{$count_sidebars}",
						'before_widget' => isset( $sidebar['before_widget'] ) ? $sidebar['before_widget'] : '<section id="%1$s"class="sidebar-widget-menu %2$s">',
						'after_widget' => isset( $sidebar['after_widget'] ) ? $sidebar['before_widget'] : '</section>',
						'before_title' => isset( $sidebar['before_title'] ) ? $sidebar['before_title'] : '</h3>',
						'after_title' => isset( $sidebar['after_title'] ) ? $sidebar['after_title'] : '</h3>',
					) );
				}
			}

			// register nav menus
			if ( array_key_exists( 'nav-menus', $config ) ) {
				register_nav_menus( $config['nav-menus'] );
			}

			// add custom image sizes
			if ( array_key_exists( 'images', $config ) ) {
				
				// enable post thumbnails 
				add_theme_support( 'post-thumbnails' );
				
				// iterate through the images array and enable specific image sizes
				foreach ( $config['images'] as $key => $image ) {
					add_image_size( $key, $image['width'], $image['height'], $image['crop'] );
				}
			}

			// add content 
			if ( array_key_exists( 'posts', $config ) ) {
				require_once STYLESHEETPATH . '/base-config/plugins/content.class.php';
				$args = $config['posts'];
				if ( class_exists( 'Base_Content' ) ) {
					$posts = new Base_Content( $args );
				}
			}

		} else {
			throw new Exception( 'No config values found or config is not an associative array' );
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

				// unusual way of checking if the file exists provided a full url
				if ( false === fopen( $scripts_dir . $script['file'], 'r' ) ) {
					throw new Exception( "The {$script['file']} doesn't not exist, check the _ui/js directory!" );
				}

				// WP included scripts won't be affected by wp_register_script	
				if ( isset( $script['handle'] ) ) {
					wp_register_script( $script['handle'], $scripts_dir . $script['file'], isset( $script['deps'] ) ? $script['deps'] : array( ), false, isset( $script['in_footer'] ) ? $script['in_footer'] : $in_footer  );
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