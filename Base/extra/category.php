<?php
/**
 * Skeleton Theme: Category
 */
get_header(); ?>

<p>Category: <?php single_cat_title(); ?></p>

<?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <?php the_ID(); ?>

        <a href="<?php the_permalink() ?>"><?php the_title( "", "", false ); ?></a>

        <span class="meta">Posted on: <?php the_time( 'F j, Y' ) ?> by <?php the_author_link(); ?></span>

        <p class="excerpt">
            <?php the_excerpt(); ?> ...
            <a class="link-more" href="<?php echo get_permalink(); ?>">read more</a>
        </p>

    <?php endwhile; ?>

<?php else : ?>

    <h2 class="page-title">
        <a href="#"><span class="first-word">Nothing found</span>for the selected category.</a>
    </h2>

<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>