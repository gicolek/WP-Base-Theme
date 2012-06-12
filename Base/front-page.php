<?php
/**
 * Template for Front Page
 */
get_header();
?>
<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
       <?php get_template_part('content','single'); ?>
    <?php endwhile; // end of the loop.   ?>
<?php else : ?>
<?php endif; ?>
Front Page

<?php get_sidebar(); ?>
<?php get_footer(); ?>
