<?php
/**
 * The template for displaying content after all other content-{template}
 * Contains some basic HTML and WordPress functions that are quite common across
 * all projects
 * 
 * For the moment equal to content-single
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?> </a>

    <?php
    the_time( 'm/d/Y' );
    // http://codex.wordpress.org/Formatting_Date_and_Time 
    ?> 

    <?php if ( has_post_thumbnail() )
        the_post_thumbnail();
    ?>
<?php the_content(); ?>
</div>
<!-- end div for post -->