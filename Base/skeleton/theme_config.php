<?php

/**
 * Loads configuration options based on the config.php file
 * 
 * Each function should be ran from within the functions.php
 * 
 * @todo enable child themes functionality
 * @todo add errors
 * @todo make everything static?
 */

class Skeleton_Theme_Config {
	
    private $include_path;
	static public $array = array( );
	// used via each method
	private $config = array( );

	/**
	 * Runs all functions based on the config array provided inside the skeleton/config.php
	 * 
	 * @return {array} reference to the config array
	 * 
	 * @todo add WP default auto page loader
	 * @todo change to __construct	
	 */
	public function init($args = array( )) {

		$args = array_merge(
				array(
			'config_file' => TEMPLATEPATH . DIRECTORY_SEPARATOR . 'skeleton/config.php',
				), $args
		);
		extract( $args );

		if ( is_array( $args ) ) {

			if ( array_key_exists( 'config_file', $args ) ) {
				$config = require($config_file);
			}


			if ( is_array( $config ) ) {

				// enqueue scripts
				if ( array_key_exists( 'scripts', $config ) ) {
					$this->config['scripts'] = $config['scripts'];
					// @todo how to call add_action in a static context or how to call a private load_scripts function
					add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );
				}

				// generate pages @todo make it default?
//				if ( array_key_exists( 'pages', $config ) ) {
//					$this->config['pages'] = $config['pages'];
//					$this->generate_pages();
//				}
			} else {
				throw new Exception( 'No config values found or config is not an associative array' );
			}
		}
	}

	// init widgets
	// 
	// @todo if sidebars are defined foreach widgets add_action	based on the class name
	// @todo add path 
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
	 * Utility to load front end scripts based on the config.php scripts array 
	 * 
	 * @run at init via add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) ); 
	 * 
	 * Auto appends the version number (arg set to false http://codex.wordpress.org/Function_Reference/wp_enqueue_script)
	 * 
	 * @param {array} $scripts 
	 * 
	 * @todo @param {bool} $autoload scripts
	 * @todo check the code foreach
	 * @todo add functionality to deregister automatical scripts
	 * @todo change foreach to $handle => $script
	 */
	public function load_scripts() {

		// load all config values in footer by default
		$in_footer = true;

		$autoload = $this->config['scripts']['autoload'];
		$scripts = $this->config['scripts'];


		if ( $autoload ) {
			$this->autoload_scripts();
			return;
		}

		foreach ( $scripts as $script ) {
			if ( is_array( $script ) ) {
				// WP included scripts won't be affected by wp_register_script
				if ( isset( $script['handle'] ) ) {
					wp_register_script( $script['handle'], get_template_directory_uri() . $script['path'], isset( $script['deps'] ) ? $script['deps'] : false, false, isset( $script['in_footer'] ) ? $script['in_footer'] : $in_footer  );
				} else if ( !isset( $script['default'] ) ) {
					throw new Exception( '$script handle or path undefined ' . $script . ' please check config.php.' );
				}
				if ( $script['enqueue'] ) {
					wp_enqueue_script( $script['handle'] );
				}
			}
		}
	}

	/**
	 *  Lazy way of loading scripts - do that automatically in footer, using the default jQuery
	 */
	private function autoload_scripts() {
		
	}

	/**
	 * @todo extend the settings api with some default values 
	 */
	private function load_settings() {
		
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

			// @todo debug info echo 'adding ' . $key . ' content ' . $page['content'] . '<br />';
			wp_insert_post( $my_post );
		}
	}

	static function debug() {
		if ( $autoload ) {
			echo 'Waring the scripts are auto loaded';
			
		}
	}
	// init settings api
	// load scripts
}