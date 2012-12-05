<?php
/**
 * Base Theme: page.php
 *
 * Template file displaying a page.
 * 
 * @package WordPress
 * @subpackage Base Theme
 * @author Rafal Gicgier rafal@x-team.com
 */
get_header();
?>


<?php if ( have_posts() ): ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part('content', 'page'); ?>

    <?php endwhile; ?>

<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
