# Table of Contents

* [WP Base Theme Description] (https://github.com/gicolek/WP-Base-Theme#wp-base-theme-description)
* [Using config.php file] (https://github.com/gicolek/WP-Base-Theme#using-configphp-file)
* [Scripts] (https://github.com/gicolek/WP-Base-Theme#scripts)
* [Theme Options] (https://github.com/gicolek/WP-Base-Theme#theme-options)
* [Custom Post Types Creation] (https://github.com/gicolek/WP-Base-Theme#custom-post-types-creation)
* [File	inclusions] (https://github.com/gicolek/WP-Base-Theme#file-inclusions)
* [Todos List / Enhancements] (https://github.com/gicolek/WP-Base-Theme#todos-list--enhancements)

# WP Base Theme Description

WP Base Theme is being written to simplify the creation of WordPress powered Themes,
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

Currently there are automatic handlers for:

* scripts
* theme options
* custom post types creation
* file inclusions (so that it'd be easy to find out what files were loaded and easily turn them of 
to debug the code)

## Scripts

WordPress will auto load scripts based on the config array, starting with scripts key.
These should reside within _ui/js/ directory (Base Theme will throw an error in case
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

## Custom Post Types Creation

Base Theme can also handle auto posts creation, for example:

```php
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
```

Would create a slider post type supporting title, editor, author, custom-fields and a thumbnail


## File inclusions

In case any extra files were supposed to be added, with some custom functionality
this can be done via 

```php
'includes' => array(
		'shortcodes' => true,
	),
```

Base Theme would include the shortcodes.php file from the includes directory.

Full, sample config file can be found within the base-config directory.

# Todos List / Enhancements

* Add callback functions to the Theme Settings class, allowing custom callback functions 
* Extend WP_Widget class with to facilitate creation of Widgets
* Add some generic screenshot
* Add support for more features
- auto sidebar creation
- auto nav menu creation

