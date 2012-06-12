<?php
/**
 * Template for archive pages
 * 
 */
get_header();
?>

<h1>Archives</h1>
<p><strong> <?php if ( is_day() ) : ?>
            <?php printf( __( 'Daily Archives: %s' ), '<span>' . get_the_date() . '</span>' ); ?>
        <?php elseif ( is_month() ) : ?>
            <?php printf( __( 'Monthly Archives: %s' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format' ) ) . '</span>' ); ?>
        <?php elseif ( is_year() ) : ?>
            <?php printf( __( 'Yearly Archives: %s' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format' ) ) . '</span>' ); ?>
        <?php else : ?>
            <?php _e( 'Blog Archives' ); ?>
        <?php endif; ?></strong></p>


<?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'content', 'archive' ); ?>

    <?php endwhile; // end of the loop.   ?>

<?php else : ?>

    <h2>Archives Empty</h2>

<?php endif; ?>

<?php
// or use <?php posts_nav_link(); // http://codex.wordpress.org/Next_and_Previous_Links 
if ( function_exists( 'wp_paginate' ) ) {
    wp_paginate();
}
?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
