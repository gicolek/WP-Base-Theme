<?php
/**
 * Base Theme: front-page.php
 *
 * Template file that's used for the Front Page display
 * affected by Settings -> Reading
 *
 * @package WordPress
 * @subpackage Base Theme
 * @author Rafal Gicgier rafal@x-team.com
 */
get_header();
?>

<?php /* print some info here */ ?>

<?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'content', 'loop' ); ?>

    <?php endwhile;  ?>

<?php else : ?>

    <?php /* print empty info here */ ?>

<?php endif; ?>

<?php /* add pagination if needed here */ ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
