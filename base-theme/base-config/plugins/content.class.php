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

					// set post thumbnail
					if ( array_key_exists( 'thumbnail', $post ) ) {
						$this->set_thumbnail( $id, $post );
					}
				}
			}
		}
	}

	/**
	 * Function that set posts thumbnail and
	 * generates all intermediate image sizes 
	 */
	function set_thumbnail($id, $post) {

		// upload the file
		if ( !function_exists( 'wp_handle_upload' ) )
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		// include the neccessary image library
		include( ABSPATH . 'wp-admin/includes/image.php' );

		// get file filename
		$filename = $post['thumbnail'];

		// check the file mimetype
		$wp_filetype = wp_check_filetype( basename( $filename ), null );

		// get the uploads dir path
		$wp_upload_dir = wp_upload_dir();

		// set attachment to be added args
		$args = array(
			'guid' => $wp_upload_dir['url'] . DIRECTORY_SEPARATOR . basename( $filename ),
			'post_mime_type' => $wp_filetype['type'],
			'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
			'post_content' => '',
			'post_status' => 'inherit'
		);

		// insert attachment and get it's id
		$attachment_id = wp_insert_attachment( $args, $filename, $id );

		// get full path of that file
		$fullsizepath = get_attached_file( $attachment_id );
		
		// generate intermediate image sizes
		$attachment_data = wp_generate_attachment_metadata( $attachment_id, $fullsizepath );

		// update attachement's metadata
		$deb = wp_update_attachment_metadata( $attachment_id, $attachment_data );

		// set posts's thumbnail to the newly created attachment
		set_post_thumbnail( $id, $attachment_id );
	}

	function add_menus() {
		
	}

}

