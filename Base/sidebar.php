<?php
/*
 * Skeleton Theme: Sidebar
 */
?>

<aside class="sidebar" role="complementary">
    <?php if ( !dynamic_sidebar( 'Sidebar' ) ) : ?>
    <section class="widget">
        <h3 class="widget-title">Test</h3>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Work</a></li>
            <li><a href="#">Why Social Media</a></li>
            <li><a href="#">Local Search</a></li>
            <li><a href="#">Social Media Sites</a></li>
            <li><a href="#">SEO</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </section>
    <?php endif; ?>
</aside>
<!-- / sidebar -->