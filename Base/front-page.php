<?php
/**
 * Skeleton Theme: Front Page
 *
 * Can be used for Landing Page
 */
get_header(); ?>

<?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

       <?php get_template_part('content','single'); ?>

    <?php endwhile; ?>

<?php else : ?>

<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
