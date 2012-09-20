<?php
/**
 * Skeleton Theme: Index
 */
get_header(); ?>

<?php if ( have_posts() ) : ?>

    <?php posts_nav_link(); ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'content', get_post_format() ); ?>

    <?php endwhile; ?>

<?php else : ?>

    <?php // print nothing found info ?>

<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>