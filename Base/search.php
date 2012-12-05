<?php
/**
 * Base Theme: Search
 * 
 * Contains some dummy HTML with sample content
 * http://codex.wordpress.org/Creating_an_Error_404_Page
 * 
 * @package WordPress
 * @subpackage Base Theme
 * @author Rafal Gicgier rafal@x-team.com
 */
get_header(); ?>

<?php if ( have_posts() ) : ?>

    <?php get_search_query(); ?>

    <?php while ( have_posts() ) : the_post(); ?>


        <?php get_template_part( 'content', 'loop' ); ?>

    <?php endwhile; // end of the loop.  ?>

<?php else : ?>

    <?php get_search_form(); ?>

    <div class="not-found">
        <p> Perhaps checking one of these categories could help you? </p>
        <ul>
            <?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
        </ul>
    </div>

<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
