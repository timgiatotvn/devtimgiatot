

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

function showNewsCate() {
	var x = document.getElementById("news_category");
	if (x.style.display === "none") {
		x.style.display = "block";
	} else {
		x.style.display = "none";
	}
}


$('input[type="radio"]').click(function(){
	if($(this).attr("value")=="COD"){
		$(".Box").hide('slow');
	}
	if($(this).attr("value")=="BANK"){
		$(".Box").show('slow');

	}        
});

$('nav#menu').mmenu();

$(document).ready(function(){
	$('.login').click(function(event){
		event.stopPropagation();
		$("#dropdown-menu").slideToggle("fast");
	});
	$("#dropdown-menu").on("click", function (event) {
		event.stopPropagation();
	});
});

$(document).on("click", function () {
	$("#dropdown-menu").hide();
});


// $(function(){
// 	var clientHeight = document.getElementById('megamenu').clientHeight;
// 	$("#item_category").hover(function(){
// 		$("#megamenu").show(300);  
// 	});

// });

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