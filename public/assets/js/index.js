$(document).ready(function(){
    $('#clickOpenMenu').click(function () {
        $('#menu_mobile').addClass('navbar--show')
        $('.menu-layout').addClass('menu-layout--show')
    })

    $('#closeMenu').on('click', function() {
        $('#menu_mobile').removeClass('navbar--show')
        $('.menu-layout').removeClass('menu-layout--show')
    })

    $('#clickMenuLayout').on('click', function() {
        $('#menu_mobile').removeClass('navbar--show')
        $(this).removeClass('menu-layout--show')
    })

    $('#inputSearch').on('click', function() {
        $('#box_result').addClass('box-ressult-search-open')
        $('#btn_back').addClass('open-back')
    })
    $('#btn_back').on('click', function() {
        $('#box_result').removeClass('box-ressult-search-open')
        $('#btn_back').removeClass('open-back')
    })

    $('.sub-menu').hide();
    $(".sub-btn").click(function () {
        $(this).parent(".item-category").parent('.list-group-item').children('.sub-menu').slideToggle("100");
        $(this).children().find(".dropdown").toggleClass("fa-chevron-right fa-chevron-down");
    });
    $('.sub-sub-menu-primary').hide();
    $(".sub-sub-btn-primary").click(function () {
        $(this).parent(".item-sub-category").parent().children('.sub-sub-menu-primary').slideToggle("100");
        $(this).find(".sub-dropdown").toggleClass("fa-chevron-right fa-chevron-down");
    });


    $('.sub-menu-primary').hide();
    $(".sub-btn").click(function () {
        $(this).parent(".nav-item").parent().children('.sub-menu-primary').slideToggle("100");
        $(this).find(".dropdown").toggleClass("fa-chevron-right fa-chevron-down");
    });
    $('.sub-sub-nav-item').hide();
    $(".sub-sub-btn").click(function () {
        $(this).parent(".sub-nav-item").parent().children('.sub-sub-nav-item').slideToggle("100");
        $(this).find(".dropdown").toggleClass("fa-chevron-right fa-chevron-down");
    });

    $('.nav-footer-mobile').hide();
    $(".btn-sub-footer").click(function () {
        $(this).parent(".footer-header").parent().children('.nav-footer-mobile').slideToggle("100");
        $(this).find(".dropdown").toggleClass("fa-chevron-right fa-chevron-down");
    });
    $('.owl-product').owlCarousel({
        loop:true,
        margin:24,
        nav:true,
        dots: false,
        responsive:{
            0:{
                items:2
            },
            600:{
                items:3
            },
            1000:{
                items:6
            }
        }
    })
    $('.owl-promotion').owlCarousel({
        loop:true,
        margin:24,
        nav:false,
        dots: true,
        responsive:{
            0:{
                items:2
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    })
    $('.owl-knowledge').owlCarousel({
        loop:true,
        margin:24,
        nav:false,
        dots: true,
        responsive:{
            0:{
                items:2
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    })
});