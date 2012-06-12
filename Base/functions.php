<?php
/**
 * Functions.php file for the Skeleton Theme 
 * TODO: Enable PHP Error LOG - good plugin
 * TODO: add http://codex.wordpress.org/Theme_Review#Template_Tags_and_Hooks
 * TODO: Create get_template_part for index
 * TODO: Fix Comments
 * TODO: Option to edit google analytics stuff?
 * TODO: Opt add page links for search and other pages
 * TODO: /**
 * TODO: Remove generator and stuff check wpized
 * TODO: Add functions for repeated code (like posted on fro Twenty*)
 * TODO: Edit extra files
 */
/*include_once(ABSPATH . 'wp-content/themes/skeleton/includes/setup.php');
include_once(ABSPATH . 'wp-content/themes/skeleton/includes/scripts.php');
// include_once(ABSPATH . 'wp-content/themes/skeleton/includes/menu-walkers.php');
// include_once(ABSPATH . 'wp-content/themes/skeleton/includes/widgets.php');
// include_once(ABSPATH . 'wp-content/themes/skeleton/includes/gmaps.php');
// include_once(ABSPATH . 'wp-content/themes/skeleton/includes/posttypes.php');
// include_once(ABSPATH . 'wp-content/themes/skeleton/includes/options.php');
include_once(ABSPATH . 'wp-content/themes/skeleton/includes/commentstemplate.php');
*/
foreach( glob(STYLESHEETPATH . '/includes/*.php') as $project_include ){
	require_once $project_include;
}
?>