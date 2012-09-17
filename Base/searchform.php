<?php
/**
 * SearchForm Template - uses some dummy HTML
 */
?>

<div id="search-wrap">
    <form method="get" id="commentform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <label for="name-txt">Search page launch</label> <input type="text" class="field" name="s" id="s" value="" id="search"/>
        <input type="submit" class="submit button-search" name="submit" id="searchsubmit" value="Search" />
    </form>
</div>
