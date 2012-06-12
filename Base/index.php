<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Skeleton
 */

get_header(); ?>

			<?php if ( have_posts() ) : ?>

                                <?php posts_nav_link(); // http://codex.wordpress.org/Next_and_Previous_Links ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
                                        // or add the stuff
                                        get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

			<?php else : ?>

                <h2> Nothing found, sorry </h2>

			<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>