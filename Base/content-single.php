<?php
/**
 * The template for displaying content in the single.php template
 * TODO: Add date
 * @package WordPress
 * @subpackage Skeleton
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?> </a>

    <?php
    the_time( 'm/d/Y' );
    // http://codex.wordpress.org/Formatting_Date_and_Time 
    ?> 

    <?php if ( has_post_thumbnail() )
        the_post_thumbnail(); ?>
DUPADUPADUPA
<?php the_content(); ?>
</div>
<!-- end div for post -->