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
add_filter('tiny_mce_before_init', function($initArray) {
	$opts = '*[*]';
	$initArray['valid_elements'] = $opts;
	$initArray['extended_valid_elements'] = $opts;
	return $initArray;
});
add_theme_support( 'post-thumbnails' );
show_admin_bar(false); // Show admin menu bar true/false

function the_content_filter($content) {
	$block = join("|",array("one_third", "team_member"));
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
	return $rep;
}
add_filter("the_content", "the_content_filter");
/**
 * theme shortcodes in here!
 */
include_once ('shortcodes-functions.php');