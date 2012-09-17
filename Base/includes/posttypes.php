<?php
/*
 * Custom Post Type and Taxonomies functiona
 * actions are commented by default 
 * 
 * 1.=Custom Post Types
 * 2.=Custom Taxonomies
 */

/*
 * 1.=Custom Post Types
 */
// =Photos Post
// add_action('init', 'custom_photos_init');

function custom_photos_init() {
    $testimonials_labels = array(
        'name' => _x('Testimonials', 'post type general name'),
        'singular_name' => _x('Testimonial', 'post type singular name'),
        'all_items' => __('All Testimonials'),
        'add_new' => _x('Add new Testimonial', 'Testimonials'),
        'add_new_item' => __('Add new Testimonials'),
        'edit_item' => __('Edit Testimonial'),
        'new_item' => __('New Testimonial'),
        'view_item' => __('View Testimonial'),
        'search_items' => __('Search in Testimonials'),
        'not_found' => __('No Testimonials found'),
        'not_found_in_trash' => __('No Testimonials found in trash'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $testimonials_labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'author', 'custom-fields'),
        'has_archive' => 'testimonials'
    );
    register_post_type('testimonials', $args);
}

/* 
 * 2.=Custom Taxonomies
 * http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

//hook into the init action and call create_book_taxonomies when it fires
//add_action( 'init', 'create_theme_taxonomies', 0 );

//create two taxonomies, genres and writers for the post type "book"
function create_theme_taxonomies() 
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'Genres', 'taxonomy general name' ),
    'singular_name' => _x( 'Genre', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Genres' ),
    'all_items' => __( 'All Genres' ),
    'parent_item' => __( 'Parent Genre' ),
    'parent_item_colon' => __( 'Parent Genre:' ),
    'edit_item' => __( 'Edit Genre' ), 
    'update_item' => __( 'Update Genre' ),
    'add_new_item' => __( 'Add New Genre' ),
    'new_item_name' => __( 'New Genre Name' ),
    'menu_name' => __( 'Genre' ),
  ); 	

  register_taxonomy('genre',array('book'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'genre' ),
  ));

  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Writers', 'taxonomy general name' ),
    'singular_name' => _x( 'Writer', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Writers' ),
    'popular_items' => __( 'Popular Writers' ),
    'all_items' => __( 'All Writers' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Writer' ), 
    'update_item' => __( 'Update Writer' ),
    'add_new_item' => __( 'Add New Writer' ),
    'new_item_name' => __( 'New Writer Name' ),
    'separate_items_with_commas' => __( 'Separate writers with commas' ),
    'add_or_remove_items' => __( 'Add or remove writers' ),
    'choose_from_most_used' => __( 'Choose from the most used writers' ),
    'menu_name' => __( 'Writers' ),
  ); 

  register_taxonomy('writer','book',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count', // make sure it behaves like tags
    'query_var' => true,
    'rewrite' => array( 'slug' => 'writer' ),
  ));
}