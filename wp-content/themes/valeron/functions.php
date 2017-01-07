<?php

/**
 * Fix wordpress BUGS!
 */
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );
remove_filter('comment_text', 'wpautop');
remove_filter('the_content', 'capital_P_dangit',11);
remove_filter('the_excerpt', 'capital_P_dangit',11);
remove_filter('comment_text', 'capital_P_dangit',31);
remove_filter('the_content', 'wptexturize');
remove_filter('the_excerpt', 'wptexturize');
remove_filter('comment_text', 'wptexturize');
function override_mce_options($initArray) {
	$opts = '*[*]';
	$initArray['valid_elements'] = $opts;
	$initArray['extended_valid_elements'] = $opts;
	return $initArray;
}
add_filter('tiny_mce_before_init', 'override_mce_options');
add_theme_support( 'post-thumbnails' );
show_admin_bar(false); // Show admin menu bar true/false

/**
 * theme shortcodes in here!
 */
include_once ('shortcodes-functions.php');