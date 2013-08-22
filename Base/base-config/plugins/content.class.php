<?php

/**
 * Facilitate creation of posts, pages and menus
 *  
 * // todo figure out if custom taxonomies are not hierarchical
 * // todo auto add a category?
 * // figure out why it adds only one post if terms are added
 * 
 * @package WordPress
 * @subpackage Base Theme
 * @author Rafal Gicgier rafal@x-team.com
 */
class Base_Content {

	private $posts = array( );

	function __construct($args = array( )) {

		$this->posts = $args;

		add_action( 'init', array( $this, 'content_init' ) );
	}

	/**
	 * Automatically add content
	 */
	function content_init() {
		$this->add_posts( $this->posts );
	}

	/**
	 * Utility to automatically add posts based on the config array 
	 * 
	 * @param array_a $posts_array
	 */
	function add_posts($posts_array) {

		foreach ( $posts_array as $key => $posts ) {
			// iterate through each post
			foreach ( $posts as $post ) {

				$post_array = ( array ) $post;

				// make sure the post doesn't exist
				$found_post = get_page_by_title( $post['post_title'], ARRAY_A, $key );

				// make sure that post type is automatically set by post's key
				$post_array['post_type'] = $key;

				$id = 0;

				// If post doesn't already exist, create it.
				if ( empty( $found_post ) ) {
					// create post
					$id = wp_insert_post( $post_array );
				}

				if ( $id !== 0 ) {

					// set post terms
					if ( array_key_exists( 'terms', $post ) )
						foreach ( $post['terms'] as $tk => $terms ) {
							// non hierarchical taxonomies
							if ( $tk == 'post_tag' ) {
								wp_set_post_terms( $id, $terms, $tk );
							} else {
								// in case the term was hierarchial 
								// get its id and add to the termstoadd array to set post terms later on
								$termstoadd = array( );
								foreach ( $terms as $term ) {
									$termtoadd = get_term_by( 'name', $term, $tk );
									$termstoadd[] = $termtoadd->term_id;
								}
								wp_set_post_terms( $id, $termstoadd, $tk );
							}
						}

					// set post page template
					if ( array_key_exists( 'page_template', $post ) )
						update_post_meta( $id, '_wp_page_template', $post['page_template'] );
				}
			}
		}
	}

	function add_pages() {
		
	}

	function add_menus() {
		
	}

}

