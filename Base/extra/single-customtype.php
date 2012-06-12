<?php
/*
 * Template for displaying single custom post type
 * of the form single-posttypename
 */
get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

    <?php if ( has_post_thumbnail() )
        the_post_thumbnail( 'full' ); ?>

    <?php the_content(); ?>

<?php endwhile; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>