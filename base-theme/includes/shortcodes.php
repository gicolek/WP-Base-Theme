<?php

/**
 * Base Theme: Shortcodes
 * 
 * Contains theme specific shortcodes
 * 
 * http://codex.wordpress.org/Shortcode_API
 * 
 * @package WordPress
 * @subpackage Base Theme
 * @author Rafal Gicgier rafal@x-team.com
 */

/**
 * Sample Simple shortcode 
 * 
 * Returns Base Theme by Rafal Gicgier
 * 
 * usage [base_copyright]
 */
function base_copyright() {
	return 'Base Theme by Rafal Gicgier';
}

add_shortcode( 'base_copyright', 'base_copyright' );

/**
 * Sample Medium shortcode 
 * 
 * Returns text provided by the user with 
 * no text provided drawback
 * 
 * usage [base_custom_text foo="Base Theme by Rafal Gicgier"]
 */
function base_custom_text($atts) {
	extract( shortcode_atts( array(
				'foo' => 'Base Theme by Rafal Gicgier',
					), $atts ) );

	return $foo;
}

add_shortcode( 'base_custom_text', 'base_custom_text' );

/**
 * Sample Hard shortcode 
 * 
 * Returns text provided by the user with 
 * no text provided drawback
 * Note that $content is wrapped by do_shortocde, in case 
 * it was necessary to call another shortcode within the current shortcode
 * 
 * usage [base_advanved_text foo="title"] content [/base_advanced_text]
 */
function base_advanced_text($atts, $content = null) {
	extract( shortcode_atts( array(
				'foo' => 'Base Theme by Rafal Gicgier',
					), $atts ) );
	return "<div id='{$foo}'>" . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'base_advanced_text', 'base_advanced_text' );


