<?php
/*
 * Skeleton Theme: Search form
 */
?>

<div id="search-wrap">
    <form method="get" id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <label for="search">Search page launch</label>
        <input type="text" class="input" name="q" value="" id="search"/>
        <button type="submit" class="submit button-search">Search</button>
    </form>
</div>
<!-- / search-wrap -->
