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
				<span class='img' style='background-image: url({$arr['image']['sizes']['large']})'>
					<span class='img-filter'>
						<span class='more'>подробнее</span>
					</span>
				</span>
				<span class='cont'>
					<h2>{$arr['title']}</h2>
					<h4 class='info'>{$arr['text']}</h4>
				</span>
			</a>
		";
	}
	return $html;
});


