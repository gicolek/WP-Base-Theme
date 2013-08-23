<?php
/**
 * Base Theme: content-{template}
 *
 * Template file that displays content of an archive
 * 
 * @package WordPress
 * @subpackage Base Theme
 * @author Rafal Gicgier rafal@x-team.com
 */
?>


<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?> </a>

	<?php the_time( 'm/d/Y' ); ?>
	<?php // http://codex.wordpress.org/Formatting_Date_and_Time ?>

	<?php if ( has_post_thumbnail() ) the_post_thumbnail(); ?>

	<?php the_content(); ?>

</div>
<!-- / post -->
