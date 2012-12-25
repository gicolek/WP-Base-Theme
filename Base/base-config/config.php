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