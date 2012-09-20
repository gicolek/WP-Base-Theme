<?php
/**
 * Skeleton Theme: Archive page
 */
get_header(); ?>

<?php /* print archive info here */ ?>

<?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'content', 'archive' ); ?>

    <?php endwhile;  ?>

<?php else : ?>

    <?php /* print archive empty info here */ ?>

<?php endif; ?>

<?php /* add pagination if needed here */ ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
