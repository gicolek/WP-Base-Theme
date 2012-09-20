<?php
/**
 * Skeleton Theme: Archive content
 *
 * Contains some basic links, permalinks and base HTML, that can be easily adjusted
 */
?>
<a href="<?php echo get_permalink(); ?>" class="entry-title"><?php the_title(); ?> </a>

<a href="<?php echo get_permalink(); ?>" class="entry-date"><?php the_time( 'm/d/Y' ); ?></a>

<?php comments_popup_link( 'No Comments', '1 Comment', '% Comments', 'entry-utility' ); ?>

<?php the_excerpt(); ?>

<a href="<?php echo get_permalink(); ?>" class="readmore">Read More</a>
