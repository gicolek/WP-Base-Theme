<?php
/*
 * 1.=Editable navigation menus
 * 2.=Widget support
 * 3.=Post Thumbnails and Post Formats
 * 4.=Automatic feed links, as suggested by codex 
 * 5.=Remove meta tag generator from the source view 
 * 6.=PIE. htc stuff COMMENTED
 * 7.=Default editor COMMENTED
 * 8.=Excerpt more   COMMENTED
 */

/* 1.=Editable navigation menus 
-------------------------------------------- */
function register_my_menus() {
    register_nav_menus(
            array( 'navigation-top' => __( 'Top Navigation Menu' ), 'navigation-foot' => __('Footer Navigation Menu') )
    );
}

add_action( 'init', 'register_my_menus' );

/* 2.=Widget support
 -------------------------------------------- */
function theme_sidebar_widgets_init() {

    register_sidebar( array(
        'name' => __( 'Sidebar', 'pglaunch_sidebar' ),
        'id' => 'sidebar-1',
        'before_widget' => '<section id="%1$s"class="sidebar-widget-menu %2$s">',
        'after_widget' => "</section>",
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );
}

add_action( 'widgets_init', 'theme_sidebar_widgets_init' );

/* 3.=Post Thumbnails 
--------------------------------------------- */
add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-formats', array( 'video' ));
/* 4.=Automatic feed links, as suggested by codex */
add_theme_support( 'automatic-feed-links' );

/* 5.=Remove meta tag generator from the source view */
remove_action( 'wp_head', 'wp_generator' );


  function css_pie ( $vars ) {
  $vars[] = 'pie';
  return $vars;
  }
  add_filter( 'query_vars' , 'css_pie'); //WordPress will now interpret the PIE variable in the url
  function load_pie() {
  if ( get_query_var( 'pie' ) == "true" ) {
  header( 'Content-type: text/x-component' );
  wp_redirect( get_bloginfo('template_url').'/_ui/js/PIE.htc' ); // adjust the url to where PIE.htc is located, in this example we are fetching in the themes includes directory
  // Stop WordPress entirely since we just want PIE.htc
  exit;
  }
  }
  add_action( 'template_redirect', 'load_pie' );


/* 7.=Default editor 
  add_filter( 'wp_default_editor', create_function('', 'return "html";'), 99999 );
 */

/* 8.=Excerpt more 
  function new_excerpt_more($more) {
  return '...';
  }
  add_filter('excerpt_more', 'new_excerpt_more');
 */
?>
