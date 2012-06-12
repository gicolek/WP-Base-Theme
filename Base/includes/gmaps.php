<?php

/*
 * Embed Maps getting all the data from the query string and adding it to an iframe 
 * Credit goes to http://wordpress.org/extend/plugins/google-maps-embed/
 * Author: Deanna Schneider
 * Version: 1.5
 * Author URI: http://deannaschneider.wordpress.com/
 * Big part of the code was used thanks to these guys
 *  That one's better - more security, validity checking, but requires more input from the user 
 *  Link to the map select from googlmaps service has to be given as an argument for src attribute
 */


add_shortcode( 'custom_embedgmap', 'custom_embed_google_map' );

function custom_embed_google_map( $atts ) {

    global $xpf_embedgmap;

    $args = shortcode_atts( array(
        'src' => 'http://maps.google.com/?ie=UTF8&ll=37.0625,-95.677068&spn=55.586984,107.138672&t=h&z=4',
        'height' => 400,
        'width' => 400,
        'frameborder' => 0,
        'marginheight' => 0,
        'marginwidth' => 0,
        'scrolling' => 'no'
            ), $atts );

    // clean up the url
    $args['src'] = str_replace( "'", "\\'", esc_url( $args['src'] ) );

    //if it's not a link to maps.google.com, don't allow it
    if ( substr_count( $args['src'], 'http://maps.google', 0 ) == 0 )
        return;

    // makes sure all the other attributes are valid
    if ( !is_numeric( $args['height'] ) )
        $height = 400;
    if ( !is_numeric( $args['width'] ) )
        $width = 400;
    if ( !is_numeric( $args['frameborder'] ) )
        $frameborder = 0;
    if ( !is_numeric( $args['marginheight'] ) )
        $marginheight = 0;
    if ( !is_numeric( $args['marginwidth'] ) )
        $marginwidth = 0;
    if ( $args['scrolling'] != 'auto' && $args['scrolling'] != 'yes' )
        $scrolling = 'no';

    // take the link and make the iframe embed stuff.
    $return = '<div class="map-holder"><iframe width="' . $args['width'] . '" height="' . $args['height'] . '" frameborder="' . $args['frameborder'] . '" scrolling="' . $args['scrolling'] . '" marginheight="' . $args['marginheight'] . '" marginwidth="' . $args['marginwidth'] . '" src="' . $args['src'] . '&amp;output=embed"></iframe><br /><small><a href="' . $args['src'] . '&amp;source=embed" target="_new" style="color:#0000FF;text-align:left">View larger map</a> </small></div>';

    return $return;
}
?>
