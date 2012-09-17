<?php
/*
 * Bare Bones for the Sidebar
 * Dummy content added 4 fun.
 */
?>

<aside id="sidebar">
    <?php if ( !dynamic_sidebar( 'Sidebar' ) ) : ?>
        <section class="widget">
            <h3>Test</h3>
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