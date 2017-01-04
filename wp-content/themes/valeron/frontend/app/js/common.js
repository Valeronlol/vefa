$(function() {

    /**
     * Header slider
     */
	$('header .header-slick').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1
    });

    $('.main-page-item').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: true
    });

});
