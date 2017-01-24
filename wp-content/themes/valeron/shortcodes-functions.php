<?php

/**
 * Home page brand slider
 */
add_shortcode('brand_slider', function() {
	$html = '';
	foreach ( get_field('brand-slider') as $arr )
	{
		$html .= "<a href='{$arr['brand-slider-anchor']}' class='header-slick-item' style='background-image:url({$arr['brand-slider-img']})'></a>";
	}
	return $html;
});

/**
 * Home page main slider
 */
add_shortcode('home_slider', function() {
	$html = '';
	foreach ( get_field('main_slider') as $arr )
	{
		$html .= "
			<a href='{$arr['href']}'>
				<span class='img' style='background-image: url({$arr['image']})'>
					<span class='img-filter'>
						<span class='more'>подробнее</span>
					</span>
				</span>
				<span class='cont {$arr['is_white']}'>
					<h2>{$arr['title']}</h2>
					<h4 class='info'>{$arr['text']}</h4>
				</span>
			</a>
		";
	}
	return $html;
});

/**
 * Ajax mail sender
 */
add_action('wp_ajax_email_action', 'email_callback');
add_action('wp_ajax_nopriv_email_action', 'email_callback');
function email_callback() {
	$whatever = intval( $_POST['whatever'] );

	echo $whatever + 10;

	wp_die();
}

