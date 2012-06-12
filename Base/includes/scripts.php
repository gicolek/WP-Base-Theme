<?php

/* adding custom scripts to the theme in the footer
 */

function my_scripts_method() {
    wp_register_script( 'modernizer', get_template_directory_uri() . '/js/libs/modernizr-2.5.3.min.js' );
    wp_enqueue_script( 'modernizer', get_template_directory_uri() . '/js/libs/modernizr-2.5.3.min.js' );

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' );
    wp_enqueue_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', array( ), false, true );

    wp_register_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ) );
    wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), false, true );

    
    wp_register_script( 'script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ) );
    wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), false, true );
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
?>