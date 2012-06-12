<?php
/**
 * The template for displaying content in the archive.php template
 *
 * @package WordPress
 * @subpackage Skeleton
 */
?>
<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?> </a>

<a href="<?php echo get_permalink(); ?>" class="entry-date"><?php the_time( 'm/d/Y' ); ?></a>

<?php comments_popup_link( 'No Comments', '1 Comment', '% Comments', 'entry-utility' ); ?>

<?php echo get_the_excerpt(); ?>

<a href="<?php echo get_permalink(); ?>" class="button2">Read More</a>
