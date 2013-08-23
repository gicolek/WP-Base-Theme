<?php
/**
 * Base Theme: Sample footer File
 *
 * @package WordPress
 * @subpackage Base Theme
 * @author Rafal Gicgier rafal@x-team.com
 */
?>

<footer id="footer">
	<p id="copyrights">
		&copy; <?php echo date('Y') . " " . get_bloginfo('name'); ?>
	</p>
</footer>

<?php wp_footer(); ?>
</body>
</html>