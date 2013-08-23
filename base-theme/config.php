<?php

/**
 * Configuration array which stores all of the Base Theme functionality
 * all code should be introduced from within this place
 * 
 */
return array(
	/*
	 * Handle semi-auto script enqueuing
	 * The function looks for each script within 
	 * the _ui/js directory optionally enqueing it right away
	 */
	'scripts' => array(
		'main' => array(
			'handle' => 'main',
			'file' => 'main.js',
			'deps' => array(
				'jquery',
			),
			'enqueue' => true,
		),
	),
	/*
	 * Register Theme Options (visible under Appearance -> Theme Options)
	 * Each key serves as option field name. The options get added and 
	 * validated automatically. In situation where custom option was needed 
	 * custom callback methods can be defined.
	 */
	'settings' => array(
		'opt1' => array(
			'type' => 'text',
			'name' => 'input-text-1',
			'desc' => 'Input type text test',
		),
		'opt2' => array(
			'type' => 'text',
			'name' => 'input-text-2',
			'desc' => 'Input type text test 2',
		),
		'opt3' => array(
			'type' => 'dropdown_pages',
			'name' => 'dropdown-pages',
			'desc' => 'Testing dropdown pages',
		),
		'opt4' => array(
			'type' => 'wp_editor',
			'name' => 'wp-editor',
			'desc' => 'Testing WP Editor',
		),
		'custom' => array(
			'generate_field_callback' => 'custom_generate_field',
			'validate_field_callback' => 'custom_validate_field',
			'name' => 'custom',
			'desc' => 'Custom Field with callback functions',
		),
	),
	/*
	 * Register Custom Post Types
	 * The arguments are equal to those of:
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	'post_types' => array(
		'slider' => array(
			'labels' => array(
				'singular' => 'Slider',
				'plural' => 'Slider entries',
			),
			'args' => array(
				'supports' => array( 'title', 'editor', 'author', 'custom-fields', 'thumbnail', 'excerpt' ),
			),
		),
	),
	/*
	 * Register Custom Taxonomies
	 * The arguments are equal to those of:
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	'tax' => array(
		// hierarchical taxonomy like category
		'wp-base-tax' => array(
			'singular' => 'WP Base Tax',
			'plural' => 'WP Base Taxes',
			'rewrite' => array( 'slug' => 'wp-base-tax', 'with_front' => false ),
			'posts' => array( 'slider' ),
		),
		// taxonomy like tag
		'wp-base-tag' => array(
			'singular' => 'WP Base Tag',
			'plural' => 'WP Base Tags',
			'rewrite' => array( 'slug' => 'wp-base-tag', 'with_front' => false ),
			'posts' => array( 'slider' ),
			'hierarchical' => false,
		),
	),
	/*
	 * Include any file from the includes subdirectory
	 */
	'includes' => array(
		'shortcodes' => true,
	),
	/*
	 * Add theme sidebars that will show up in the backend,
	 * uses: http://codex.wordpress.org/Function_Reference/register_sidebar 
	 */
	'sidebars' => array(
		'base' => array(
			'name' => __( "Sidebar-{counter}", WP_BASE_DOMAIN ),
			'id' => "sidebar-{counter}",
			'before_widget' => '<section id="%1$s"class="sidebar-widget-menu %2$s">',
			'after_widget' => '</section>',
			'before_title' => '</h3>',
			'after_title' => '</h3>',
		),
		'sidebar-1' => array( ),
		'sidebar-2' => array(
			'name' => __( "Sidebar Rafal", WP_BASE_DOMAIN ),
			'id' => "sidebar-rafal",
		),
	),
	/*
	 * Add navigation menus (they will show up in the Backend)
	 * uses: http://codex.wordpress.org/Function_Reference/register_nav_menus
	 */
	'nav-menus' => array(
		'navigation-top' => __( 'Top Navigation Menu' ),
		'navigation-foot' => __( 'Footer Navigation Menu' ),
	),
	/*
	 * Add specific image sizes.
	 * Being set, automatically adds theme supporfor post thumbnails.
	 */
	'images' => array(
		'400x500' => array(
			'width' => '400',
			'height' => '500',
			'crop' => true,
		),
	),
	/*
	 * Fill in the content, each key is the name of registered
	 * post type (post, page or any custom registered post).
	 * Uses: http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	'posts' => array(
		'post' => array(
			array(
				'post_title' => "Base Theme Post One Featured",
				'post_content' => "<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>",
				'post_status' => "publish",
				'post_excerpt' => "Lorem ipsum dolor sit amet",
				'slug' => "bt-po",
				// set post terms categories need to extist up front
				// or this will have no effect
				'terms' => array(
					'category' => array( 'Uncategorized', 'Lorem' ),
					'post_tag' => "tag1, tag2, tag3",
				),
				'post_status' => 'publish',
				// the below will have no effect if the file wasn't present
				'page_template' => 'page-template.tpl.php',
				// needs to reside within the wp-content/uploads/dir
				// will set post thumbnail and create all intermediate image sizes for that specific picture
				'thumbnail' => 'screenshot.png'
			),
			array(
				"post_title" => "Base Theme Post Two",
				"post_content" => "<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>",
				"post_status" => "publish",
				"post_excerpt" => "Lorem ipsum dolor sit amet",
				"slug" => "bt-pt",
				"post_status" => 'publish',
				'page_template' => 'page-template.tpl.php'
			),
		),
		'cpt' => array(
		),
		'page' => array(
		),
	)
);

/**
 * Custom Theme Options Callback function
 */
function custom_generate_field() {
	$options = get_option( 'base_options' );
	if ( !empty( $options['custom'] ) ) {
		echo "<input id='custom' name='base_options[custom]' size='80' type='text' value='{$options['custom']}' />";
	}
	else
		echo "<input id='custom' name='base_options[custom]' size='80' type='text' value='' />";
}

/**
 * Custom Theme Options validate function
 * 
 * @param array $input
 * @return array 
 */
function custom_validate_field($input) {
	$valid = esc_attr( $input['custom'] );
	return $valid;
}