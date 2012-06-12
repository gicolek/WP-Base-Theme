<?php
/**
 * The template for displaying Search Pages.
 * Todo: fix style
 * Works like for Twenty Eleven
 * 
 * @package WordPress
 * @subpackage Skeleton
 */

get_header();
?>

    <?php if ( have_posts() ) : ?>

        <?php get_search_query(); ?>

        <?php while ( have_posts() ) : the_post(); ?>
            
        <?php get_template_part( 'content', get_post_format() ); ?>

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
