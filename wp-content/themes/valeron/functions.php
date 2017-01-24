<?php
/**
 * theme shortcodes in here!
 */
require_once ('shortcodes-functions.php');

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

/**
 * scripts
 */
add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_script( 'scripts',  get_template_directory_uri() . '/frontend/dist/js/scripts.min.js' );
} );

/**
 * styles
 */
add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_style( 'styles',  get_template_directory_uri() . '/frontend/dist/css/main.min.css' );
} );

/**
 * ajax hook url
 */
add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
function myajax_data(){

	wp_localize_script('scripts', 'myajax',
		array(
			'url' => admin_url('admin-ajax.php')
		)
	);
}