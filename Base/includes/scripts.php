<?php
/**
 * Function for adding scripts - the proper way, call them in the footer
 * if possible, to increase the pageload
 */

function my_scripts_method() {
    
   // wp_deregister_script( 'jquery' );
    
    // load in the footer
    //wp_register_script( 'jquery', '/wp-includes/js/jquery/jquery.js', false, '1.3.2', true );
    wp_enqueue_script( 'jquery' );

    /*    
    $url = 'http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js'; // the URL to check against  

    $test_url = @fopen( $url, 'r' ); // test parameters  
    if ( $test_url !== false ) { // test if the URL exists  
        // load external file  
        wp_register_script( 'jquery.tools.min', 'http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js', array( 'jquery' ), false, true ); // register the external file  
        wp_enqueue_script( 'jquery.tools.min' ); // enqueue the external file  
    } else {
        // load local file
        wp_register_script( 'jquery.tools.min', get_template_directory_uri() . '/_ui/js/jquery.tools.min.js', array( 'jquery' ), false, true ); // register the local file  
        wp_enqueue_script( 'jquery.tools.min' ); // enqueue the local file  
    } */

 
    //wp_deregister_script( 'jquery' );
    //wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' );
    //wp_enqueue_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', array( ), false, true );

    //wp_register_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ) );
    //wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), false, true );

    
    //wp_register_script( 'script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ) );
    //wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), false, true );
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );