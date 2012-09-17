<?php
/**
 * Bare Bones of archives content
 * Contains some basic links, permalinks and base HTML, that can be easily adjusted
 */
?>
<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?> </a>

<a href="<?php echo get_permalink(); ?>" class="entry-date"><?php the_time( 'm/d/Y' ); ?></a>

<?php comments_popup_link( 'No Comments', '1 Comment', '% Comments', 'entry-utility' ); ?>

<?php /* the_exceprt() uses wp_autop and I don't want that to happen */ ?>
<?php echo get_the_excerpt(); ?>

<a href="<?php echo get_permalink(); ?>" class="button2">Read More</a>
