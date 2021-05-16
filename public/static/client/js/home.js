

// $('.grid').masonry({
// 	itemSelector : '.item',
// 	percentPosition : 'true',
// 	fitWidth: false,
// 	percentPosition: false,
// 	masonry: {
// 		columnWidth: '.grid-sizer'
// 	}

// });

// $(".search_icon").click(function(){
// 	$(".box_search_mobile").fadeToggle();
// });
// $(window).load(function() {
// 	$('#slider').nivoSlider();
// });


$('.scroll-down-message').click(function() {
    $('html, body').animate({
        scrollTop: $("#page-body").offset().top
    }, 1000)
}),

    $('nav#menu').mmenu();

// window.onscroll = function() {myFunction()};
// var header = document.getElementById("header");
// var sticky = header.offsetTop;


// function myFunction() {
// 	if (window.pageYOffset > sticky) {
// 		header.classList.add("header_fix");
// 		$("#social_top").fadeOut('200');
// 	} else {
// 		header.classList.remove("header_fix");
// 		$("social_top").show(200);
// 		$("#social_top").fadeIn('slow');
// 	}
// }


// var stickyTop = $('.sticky');
// if (stickyTop.length) {
// 	var stickyTop = $('.sticky').offset().top;
// 	$(window).scroll(function() {
// 		var windowTop = $(window).scrollTop();
// 		if (stickyTop < windowTop && $(".left_fix").height() + $(".left_fix").offset().top - $(".sticky").height() > windowTop) {
// 			$('.sticky').addClass('box_fixed');
// 		} else {
// 			$('.sticky').removeClass('box_fixed');
// 		}
// 	});
// }

function success_notify(title, desc, type) {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        // "positionClass": "toast-top-full-width",
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "500",
        "hideDuration": "500",
        "timeOut": "3369",
        "extendedTimeOut": "200",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    toastr.success(desc, title);
}

function errors_notify(title = 'Failed to load resource',desc= 'Please try again.') {
    // var title = 'Failed to load resource !';
    // var desc = '';

    toastr.options = {
        "closeButton": true,
        "debug": false,
        // "positionClass": "toast-top-full-width",
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "500",
        "hideDuration": "500",
        "timeOut": "3369",
        "extendedTimeOut": "200",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    toastr.error(desc, title);
}
