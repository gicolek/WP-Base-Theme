<?php

return array(
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
	'tax' => array(
		// taxonomy like category
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
	'includes' => array(
		'shortcodes' => true,
	),
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
	'nav-menus' => array(
		'navigation-top' => __( 'Top Navigation Menu' ),
		'navigation-foot' => __( 'Footer Navigation Menu' ),
	),
	'posts' => array(
		'post' => array(
			array(
				"post_title" => "Base Theme Post One",
				"post_content" => "<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>",
				"post_status" => "publish",
				"post_excerpt" => "Lorem ipsum dolor sit amet",
				"slug" => "bt-po",
				'terms' => array(
					"category" =>  array( 'Uncategorized', 'Lorem' ),
					"post_tag" => "tag1, tag2, tag3",
				),
				"post_status" => 'publish',
				'page_template' => 'page-template.tpl.php'
			),
			array(
				"post_title" => "Base Theme Post Two",
				"post_content" => "<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>",
				"post_status" => "publish",
				"post_excerpt" => "Lorem ipsum dolor sit amet",
				"slug" => "bt-pt",
				'terms' => array(
					"category" => array( 'Uncategorized', 'Lorem' ),
					"post_tag" => "tag1, tag2, tag3",
				),
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

function custom_generate_field() {
	$options = get_option( 'base_options' );
	if ( !empty( $options['custom'] ) ) {
		echo "<input id='custom' name='base_options[custom]' size='80' type='text' value='{$options['custom']}' />";
	}
	else
		echo "<input id='custom' name='base_options[custom]' size='80' type='text' value='' />";
}

function custom_validate_field($input) {
	$valid = $input['custom'];
	return $valid;
}