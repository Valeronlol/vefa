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
    window.onresize = function() {postPageCont();};

    if ( window.innerWidth > 992 ) {
        /**
         * floors button handler
         */
        var floorButtons = $('.floors-button');
        floorButtons.on('click', function () {
            $('.floors-cont').css({display: 'none'});
            floorButtons.removeClass('active');
            $(this).addClass('active');

            var href = $(this).attr("data-href");
            floorLift(href);
            changeLiftInfo(href);
        });

        /**
         * Changing info about current floor on lift panel
         *
         * @param href string // data-href attr
         */
        function changeLiftInfo(href) {
            $('.floors .info_cont').removeClass('active');
            $('.floors .info_cont[data-href="' + href +'"]').addClass('active');
        }
        /**
         * left handler
         *
         * @param floor string
         */
        function floorLift(floor) {
            var difference = 158;
            var destination = $('#floor_map').height()/4;
            switch(floor)
            {
                case 'f1':
                    $('body, html').animate( { scrollTop: difference }, 1000 );
                    break;
                case 'f2':
                    $('body, html').animate( { scrollTop: destination + difference }, 1000 );
                    break;
                case 'f3':
                    $('body, html').animate( { scrollTop: (destination * 2) + difference }, 1000 );
                    break;
                case 'g1':
                    $('body, html').animate( { scrollTop: (destination * 3) + difference }, 1000 );
                    break;
            }
        }

        /**
         * left autoscroller
         */
        $(window).on( 'scroll', function(){
            var scrollres = $(window).scrollTop() -180;
            if (scrollres < 0) scrollres = 0;
            $('#text').stop().animate({'top': scrollres}, 200);
        });
    }

    /**
     * Tooltipster area
     */
    $('area').tooltipster({
        theme: 'tooltipster-borderless'
    });

    /**
     * modal button handler
     */
    $('.modal_button, .modal-close').on('click', function (e) {
        e.preventDefault();
       $('.modal-wrap').toggleClass('active');
    });


});

/**
 * Google maps API
 */
function initMap() {
    var customMapType = new google.maps.StyledMapType([
        {
            "featureType": "administrative",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#444444"
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "all",
            "stylers": [
                {
                    "color": "#f2f2f2"
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "all",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "road",
            "elementType": "all",
            "stylers": [
                {
                    "saturation": -100
                },
                {
                    "lightness": 45
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "all",
            "stylers": [
                {
                    "visibility": "simplified"
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "labels.icon",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "transit",
            "elementType": "all",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "all",
            "stylers": [
                {
                    "color": "#46bcec"
                },
                {
                    "visibility": "on"
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#f3f3f3"
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "labels",
            "stylers": [
                {
                    "saturation": "0"
                },
                {
                    "color": "#f3f3f3"
                }
            ]
        }
    ], {
        name: 'Map'
    });
    var customMapTypeId = 'custom_style';
    var myLatLng = { lat: 42.857208, lng: 74.609635 }; // Координаты .
    var image = '../wp-content/themes/valeron/frontend/dist/img/icon_map.png'; // Marker Icon
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        scrollwheel: false,
        center: myLatLng,
        mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, customMapTypeId]
        }
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: image
    });

    map.mapTypes.set(customMapTypeId, customMapType);
    map.setMapTypeId(customMapTypeId);
}

