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
		)
	),
	'post_types' => array(
		'post1' => array(
			'name' => 'Slider',
			'labels' => array(
				'singular' => 'Slider',
				'plural' => 'Slider entries',
			),
			'args' => array(
				'supports' => array( 'title', 'editor', 'author', 'custom-fields', 'thumbnail', 'excerpt' ),
			),
		),
	),
	'includes' => array(
		'shortcodes' => true,
	),
	'sidebars' => array(
		'sidebar-1' => array( ),
	),
	'nav-menus' => array(
		'navigation-top' => __( 'Top Navigation Menu' ),
		'navigation-foot' => __( 'Footer Navigation Menu' ),
	)
);
