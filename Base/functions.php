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

$config = require_once STYLESHEETPATH . '/includes/array_test.php';

var_dump( $config );

function test_filter() {
    $text = 'stolcowa dupa';
    return apply_filters( 'test_filter', $text );
}

function dupa_bez_stolca($text) {
    return 'dupa';
}

add_filter( 'test_filter', 'dupa_bez_stolca' );

foreach ( glob( STYLESHEETPATH . '/includes/*.php' ) as $project_include ) {
    require_once $project_include;
}

require_once STYLESHEETPATH . '/skeleton/theme_config_dwa.php';

//if ( class_exists( 'Skeleton_Theme_Config' ) ) {
//  $config = new Skeleton_Theme_Config();
//  $config->init();
//}
if( class_exists( 'Skeleton_Theme_Config' ) ) {
    Skeleton_Theme_Config::init();
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



/**
 * Function to display the number of post views
 *
 * @param {id} $postID
 * @return string
 */
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

/**
 * Function to set post views
 * @param {int} $postID
 */
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        echo 'count';
        var_dump($count);
        //var_dump(++$count);
        update_post_meta($postID, $count_key, ++$count);
    }
}

/* Stop adding <p> in excerpt */
remove_filter( 'the_excerpt', 'wpautop' );