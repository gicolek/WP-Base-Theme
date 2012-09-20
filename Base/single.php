<?php
/*
 * Skeleton Theme: Single post
 */
get_header(); ?>

<?php if ( have_posts() ): ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part('content', 'single'); ?>

    <?php endwhile; ?>

<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>