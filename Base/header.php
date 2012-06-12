<?php
/*
 * Header file for the skeleton
 */
?>
<!DOCTYPE html>
<!--[if IE 7]> <html class="ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]> <html class="ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>
            <?php
            /*
             * Print the <title> tag based on what is being viewed.
             */
            global $page, $paged;

            wp_title( '|', true, 'right' );

            // Add the blog name.
            bloginfo( 'name' );

            // Add the blog description for the home/front page.
            $site_description = get_bloginfo( 'description', 'display' );
            if ( $site_description && ( is_home() || is_front_page() ) )
                echo " | $site_description";

            // Add a page number if necessary:
            if ( $paged >= 2 || $page >= 2 )
                echo ' | ' . 'Page: ', max( $paged, $page );
            ?>
        </title>

        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
        <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/theme/favicon.ico" />  
        <!--<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />-->
        <!--[if lt IE 9]>
                <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <?php
        
        if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
        
        wp_head(); ?> 
    </head>
    <body  <?php body_class( "no-js" ); ?> ><!--class="no-js page-home" -->
        <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
        <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
        <!-- header and nav go here -->

        <?php
        $walker = new MINIFY_Clean_Walker_Nav();
        wp_nav_menu( array(
            'theme_location' => 'navigation-top',
            'container' => 'false',
            'items_wrap'      => '<ul id="%1$s" class="%2$s clearfix">%3$s</ul>',
            'walker' => $walker
        ) );
        ?> 

