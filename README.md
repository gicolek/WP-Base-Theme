# Table of Contents

* [License] (https://github.com/gicolek/WP-Base-Theme#license)
* [WP Base Theme Description] (https://github.com/gicolek/WP-Base-Theme#wp-base-theme-description)
* [Using config.php file] (https://github.com/gicolek/WP-Base-Theme#using-configphp-file)
* [Scripts] (https://github.com/gicolek/WP-Base-Theme#scripts)
* [Theme Options] (https://github.com/gicolek/WP-Base-Theme#theme-options)
* [Custom Post Types Creation] (https://github.com/gicolek/WP-Base-Theme#custom-post-types-creation)
* [Custom Taxonomies Creation] (https://github.com/gicolek/WP-Base-Theme#custom-taxonomies-creation)
* [Auto Sidebar Registration] (https://github.com/gicolek/WP-Base-Theme#auto-sidebar-registration)
* [Navigation Menus Registration] (https://github.com/gicolek/WP-Base-Theme#navigation-menus-registration)
* [File	inclusions] (https://github.com/gicolek/WP-Base-Theme#file-inclusions)
* [Shortcodes] (https://github.com/gicolek/WP-Base-Theme#shortcodes)
* [Todos List / Enhancements] (https://github.com/gicolek/WP-Base-Theme#todos-list--enhancements)

# License

WP Base Theme Framework is licensed under the GPL v2 or later.

> This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

> This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

> You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

# WP Base Theme Framework Description

WP Base Theme Framework is being written to simplify the creation of WordPress powered Themes,
handling some functionality semi-automatically.

Unlike other themes WP Base Theme doesn't include any kind of HTML or CSS. This is solely
a PHP project. I wanted to provide a good bese, reducing the amount of markup removal.

The main idea is to run everything from a single destination, provided a config array.

> (actually this is Weston Ruter's idea, see https://github.com/westonruter)
> but I incorporated it in my own way, having seen the same among different 
> repos here and there :))

Moreover the theme contains most common files that are usually included
in most projects involving WP.

The main thing is the base-config directory in which there are two important files:

* base_theme_config.php
* config.php

The former is a PHP class responsible for automatic handling of provided configuration
The latter is the configuration array of config files, which has the following form:

```php
<?php

return array(
	'key1' => array(
	),
	'key2' => array(
	),
	'key3' => array(
	),
	// etc.
);

```

# Using config.php file

*__Full, sample config file can be found within the base-config directory.__*

Currently there are automatic handlers for:

* scripts
* theme options
* custom post types creation
* auto sidebar registration
* navigation menus registration
* file inclusions (so that it'd be easy to find out what files were loaded and easily turn them of 
to debug the code)

## Scripts

WordPress will auto load scripts based on the config array, starting with scripts key.
**These should reside within _ui/js/ directory** (Base Theme will throw an error in case
the file didn't exist)

```php
'scripts' => array(
		'main' => array(
			'handle' => 'main',
			'file' => 'main.js',
			'enqueue' => true,
			'deps' => array(
				'jquery',
			),
 		),
	),
```
The above would include and enqueue main.js, giving it main handle.

Since no in_footer parameter was specified it would get loaded in the footer by default
Why? http://stackoverflow.com/questions/5329807/benefits-of-loading-js-at-the-bottom-as-opposed-to-the-top-of-the-document

## Theme Options

Base Theme supports semi-automatic of Appearance -> Theme Options page, for example

```php
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
```
Would create 4 options:

* 2 input text fields
* 1 dropdown pages field
* 1 wp editor field

In case custom Theme Options were to be added Base Theme Supports custom callback functionality, for example:

```php
'settings' => array(
		'custom' => array(
			'generate_field_callback' => 'custom_generate_field',
			'validate_field_callback' => 'custom_validate_field',
			'name' => 'custom',
			'desc' => 'Custom Field with callback functions',
		),
),
```
Where custom callback functions could be of the following form:

```php 
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
```
They could be placed in an included file or at the bottom of the config.php.

## Custom Post Types Creation

Base Theme can also handle auto posts creation, for example:

```php
'post_types' => array(
		'base_slider' => array(
			'labels' => array(
				'singular' => 'Slider',
				'plural' => 'Slider entries',
			),
			'args' => array(
				'supports' => array( 'title', 'editor', 'author', 'custom-fields', 'thumbnail', 'excerpt' ),
			),
		),
	),
```

Would create a slider post type supporting title, editor, author, custom-fields and a thumbnail

Note: This shortcut makes usage of http://codex.wordpress.org/Function_Reference/register_post_type

Note: it is wise to always prefix CPT with some word, like base above

## Custom Taxonomies Creation

Base Theme facilitates creation of custom taxonomies

```php
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
			'posts' => array( 'base_slider' ),
			'hierarchical' => false,
		),
	),
```
Would create two new taxonomies: one hierarhical like category and the other one non hierarchical
like tag, both of these would be assigned to the base_slider post type:

Note: This shortcut makes usage of: http://codex.wordpress.org/Function_Reference/register_taxonomy

## Auto Sidebar Registration

Provided config values of the following form:

```php
'sidebars' => array(
		'sidebar-1' => array( ),
		'sidebar-2' => array(
			'name' =>  __( "Sidebar Rafal", WP_BASE_DOMAIN ),
			'id' => "sidebar-rafal",
		),
	),
```
Two sidebars will be created:

- sidebar-1 with default values, that is:

```php
		'name' => __( 'Sidebar', 'wpized_light' ),
		'id' => 'sidebar-1',
		'before_widget' => '<section id="%1$s"class="sidebar-widget-menu %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h3>',
		'after_title' => '</h3>',
```

- sidebar-2 with custom name and id arguments.

This approach provides some flexibility and allows simple sidebar creation, without
the need of code repetition.

## Navigation Menus Registration

Example:

```php
'nav-menus' => array(
		'navigation-top' => __( 'Top Navigation Menu' ),
		'navigation-foot' => __( 'Footer Navigation Menu' ),
	)
```

In the same way as above navigation menus can be created. WP Base Theme is making 
usage of WP built in register_nav_menus() method. It's just here to provide functionality
from one place

## File inclusions

In case any extra files were supposed to be added, with some custom functionality
this can be done via 

```php
'includes' => array(
		'shortcodes' => true,
	),
```

Base Theme would include the shortcodes.php file from the **includes** directory.

## Shortcodes

For sake of popularity of shortcodes I've added sample shortcodes.php
file to the /includes directory, which gets loaded by default. 

See its contents to find the working examples.

# Todos List / Enhancements

* Add more features:

* Extend Settings class with more default functions
* Extend WP_Widget class to provide functionality similar to the Settings class
* Test, debug etc.

