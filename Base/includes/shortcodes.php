<?php
/**
 * Skeleton default shortcodes used for Content Editing
 */

function br_shortcode( $atts = null ) {
    return '<br />';
}

add_shortcode( 'br', 'br_shortcode' );

function p_shortcode( $atts = null, $content = null ) {
    return '<p>' . do_shortcode( $content ) . '</p>';
}

add_shortcode( 'p', 'p_shortcode' );