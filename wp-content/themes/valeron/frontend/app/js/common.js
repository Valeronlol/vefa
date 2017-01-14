$(function() {

    /**
     * Header slider
     */
	$('.filter_cont .header-slick').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 320,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    /**
     * Main page slider
     */
    $('.main-page-item').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 5000,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    /**
     * post background slider
     */
    $('#post-main .post-slider').slick({
        arrow: false,
        infinite: true,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000
    });

    /**
     * Search button handler
     */
    $('header .search').on('click', function () {
        $( this ).toggleClass('active');
        $( this ).find('.text').focus();
    });

    /**
     * burger button handler
     */
    $('#burger').on('click', function () {
        var menu = $('.nav .menu');
        if ( !$(this).hasClass('active') ){
            $(this).addClass('active');
            menu.css('display', 'block');
        }else{
            $(this).removeClass('active');
            menu.css('display', '');
        }
    });

    /**
     * burger close btn
     */
    $("header .menu").append('<i class="fa burger_close_btn fa-times" aria-hidden="true"></i>');
    $('.burger_close_btn').on('click', function () {
        $('#burger').removeClass('active');
        $('.nav .menu').css('display', '');
    });

    /**
     * Flex menu
     */
    $('#flex-menu').flexMenu();
    
    $('#shop-more').on('click', function () {
        console.log('asd')
    });

    /**
     * post page cont responsive
     */
    function postPageCont() {
        var post_cont = $('#post_page_content');
        if (window.innerWidth <= 768) {
            post_cont.detach();
            $('#post-main').after(post_cont);
        }else{
            $('#post-main .row.cont').prepend(post_cont);
        }
    }
    postPageCont();
    window.onresize = function() { postPageCont(); };

    /**
     * floors button handler
     */
    var floorButton = $('.floors-button');
    floorButton.on('click', function () {
        $('.floors-cont').css({display: 'none'});
        floorButton.removeClass('active');
        $(this).addClass('active');
        $('#' + $(this).attr("data-href")).show(200);
    });

});
