<?php

/**
 * Home page brand slider
 */
add_shortcode('brand_slider', 'brand_slider');
function brand_slider() {
	$html = '';
	foreach ( get_field('brand-slider') as $arr )
	{
		$html .= "<a href='{$arr['brand-slider-anchor']}' class='header-slick-item' style='background-image:url({$arr['brand-slider-img']})'></a>";
	}
	return $html;
}


