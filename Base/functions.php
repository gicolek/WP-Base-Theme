<?php
/**
 * Theme specific functionalities, split into separate files
 *
 * @author Rafał Gicgier <gicolek@gmail.com>
 *
 * @todo extend widget class with some default entries
 * @todo extend settings api with some default entries
 * @todo introduce config / functions array to simplify theme settings
 *       - improve script loading via config array
 */

foreach ( glob( STYLESHEETPATH . '/includes/*.php' ) as $project_include ) {
    require_once $project_include;
}

require_once STYLESHEETPATH . '/skeleton/theme_config.php';

if ( class_exists( 'Skeleton_Theme_Config' ) ) {
  $config = new Skeleton_Theme_Config();
}

$pages = array(
    'page1' => array(
        'content' => '',
    ),
    'page2' => array(
        'content' => '',
    ),
    'page3' => array(
        'content' => '',
    ),
);

// $config->generate_pages($pages, true);