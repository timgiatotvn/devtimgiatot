$('.slider_home').slick({
	loop: false,
	infinite: true,
	slidesToShow: 4,
	centerPadding: '0px',
	slidesToScroll: 1,
	centerMode: false, 
	//rtl: false,
	accessibility:true,
	prevArrow: '<div class="slick-bt slick-prev-our"><i class="fas fa-caret-left"></i></div>',
	nextArrow: '<div class="slick-bt slick-next-our"><i class="fas fa-caret-right"></i></div>',
	autoplay: true,
	dots: false,
	responsive: [
	{
		breakpoint: 1024,
		settings: {
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: true,

			dots: true
		}
	},
	{
		breakpoint: 600,
		settings: {
			slidesToShow: 2,
			autoplay: false,
			variableWidth: true,
			prevArrow:false,
			nextArrow:false,
			dots: true,
			slidesToScroll: 1
		}
	},
	{
		breakpoint: 480,
		settings: {
			autoplay: false,
			variableWidth: false,
			slidesToShow: 1,
			prevArrow:false,
			nextArrow:false,
			dots: true,
			slidesToScroll: 1
		}
	}

	]
});





$('.slide_product').slick({
	loop: false,
	infinite: true,
	slidesToShow: 4,
	centerPadding: '10px',
	slidesToScroll: 1,
	accessibility:true,
	prevArrow: '<i class="click-slide icon-next"></i>',
	nextArrow: '<i class="click-slide icon-prev"></i>',
	autoplay: false,
	responsive: [
	{
		breakpoint: 1024,
		settings: {
			slidesToShow: 3,
			slidesToScroll: 3,
			infinite: true,
			dots: true
		}
	},
	{
		breakpoint: 600,
		settings: {
			slidesToShow: 2,
			autoplay: false,
			variableWidth: true,
			slidesToScroll: 1
		}
	},
	{
		breakpoint: 480,
		settings: {
			autoplay: false,
			variableWidth: false,
			slidesToShow: 2,
			slidesToScroll: 1
		}
	}

	]
});




const list = document.querySelectorAll('.list');
function accordion(e) {
	e.stopPropagation();
	if (this.classList.contains('active')) {
		this.classList.remove('active');
	} else
	if (this.parentElement.parentElement.classList.contains('active')) {
		this.classList.add('active');
	} else
	{
		for (i = 0; i < list.length; i++) {
			list[i].classList.remove('active');
		}
		this.classList.add('active');
	}
}
for (i = 0; i < list.length; i++) {
	list[i].addEventListener('click', accordion);
}




if ( $('.product__slider-main').length ) {
	var $slider = $('.product__slider-main')
	.on('init', function(slick) {
		$('.product__slider-main').fadeIn(1000);
	})
	.slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		autoplay: false,
		lazyLoad: 'ondemand',
		autoplaySpeed: 3000,
		prevArrow: false,
		nextArrow: false,
		asNavFor: '.product__slider-thmb',
		prevArrow:'.gallery-slider__thumbnails .prev-arrow',
		nextArrow:'.gallery-slider__thumbnails .next-arrow',
		responsive: [
		{
			breakpoint: 1024,
			settings: {
				slidesToShow: 1,
				dots: false,
				slidesToScroll: 1,
				prevArrow: true,
				nextArrow: true
			}
		},
		{
			breakpoint: 600,
			settings: {
				slidesToShow: 1,
				dots: false,
				slidesToScroll: 1,
				prevArrow: true,
				nextArrow: true
			}
		},
		{
			breakpoint: 480,
			settings: {
				slidesToShow: 1,
				dots: true,
				slidesToScroll: 1,
				prevArrow: true,
				nextArrow: true
			}
		}

		]
	});

	var $slider2 = $('.product__slider-thmb')
	.on('init', function(slick) {
		$('.product__slider-thmb').fadeIn(1000);
	})
	.slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		lazyLoad: 'ondemand',
		arrows: true,
		asNavFor: '.product__slider-main',
		dots: false,
		centerMode: false,
		//vertical: true,
		//verticalSwiping: true,
		focusOnSelect: true,
		prevArrow :true,
		nextArrow :true
	});

 //remove active class from all thumbnail slides
 $('.product__slider-thmb .slick-slide').removeClass('slick-active');

 //set active class to first thumbnail slides
 $('.product__slider-thmb .slick-slide').eq(0).addClass('slick-active');

 // On before slide change match active thumbnail to current slide
 $('.product__slider-main').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
 	var mySlideNumber = nextSlide;
 	$('.product__slider-thmb .slick-slide').removeClass('slick-active');
 	$('.product__slider-thmb .slick-slide').eq(mySlideNumber).addClass('slick-active');
 });

 var options = {
 	progressbarSelector    : '.bJS_progressbar'
 	, slideSelector        : '.bJS_slider'
 	, previewSlideSelector : '.bJS_previewSlider'
 	, progressInterval     : ''
        // add your own progressbar animation function to sync it i.e. with a video
        // function will be called if the current preview slider item (".b_previewItem") has the data-customprogressbar="true" property set
        , onCustomProgressbar : function($slide, $progressbar) {}
    }

    // slick slider options
    // see: https://kenwheeler.github.io/slick/
    var sliderOptions = {
    	slidesToShow   : 1,
    	slidesToScroll : 1,
    	arrows         : false,
    	fade           : true,
    	autoplay       : true
    }

    // slick slider options
    // see: https://kenwheeler.github.io/slick/
    var previewSliderOptions = {
    	slidesToShow   : 3,
    	slidesToScroll : 1,
    	dots           : false,
    	focusOnSelect  : true,

    	centerMode     : false
    }
}
















if ( $('.home__slider-main').length ) {
	var $slider = $('.home__slider-main')
	.on('init', function(slick) {
		$('.home__slider-main').fadeIn(1000);
	})
	.slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		autoplay: false,
		lazyLoad: 'ondemand',
		autoplaySpeed: 3000,
		prevArrow: false,
		nextArrow: false,
		asNavFor: '.home__slider-thmb'
	});

	var $slider2 = $('.home__slider-thmb')
	.on('init', function(slick) {
		$('.home__slider-thmb').fadeIn(1000);
	})
	.slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		lazyLoad: 'ondemand',
		asNavFor: '.home__slider-main',
		dots: false,
		centerMode: false,
		//vertical: true,
		//verticalSwiping: false,
		focusOnSelect: true,
		prevArrow :false,
		nextArrow :false
	});

 //remove active class from all thumbnail slides
 $('.home__slider-thmb .slick-slide').removeClass('slick-active');

 //set active class to first thumbnail slides
 $('.home__slider-thmb .slick-slide').eq(0).addClass('slick-active');

 // On before slide change match active thumbnail to current slide
 $('.home__slider-main').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
 	var mySlideNumber = nextSlide;
 	$('.home__slider-thmb .slick-slide').removeClass('slick-active');
 	$('.home__slider-thmb .slick-slide').eq(mySlideNumber).addClass('slick-active');
 });

  // init slider
  require(['js-sliderWithProgressbar'], function(slider) {

  	$('.home__slider-main').each(function() {

  		me.slider = new slider($(this), options, sliderOptions, previewSliderOptions);


  	});
  });
  var options = {
  	progressbarSelector    : '.bJS_progressbar'
  	, slideSelector        : '.bJS_slider'
  	, previewSlideSelector : '.bJS_previewSlider'
  	, progressInterval     : ''
        // add your own progressbar animation function to sync it i.e. with a video
        // function will be called if the current preview slider item (".b_previewItem") has the data-customprogressbar="true" property set
        , onCustomProgressbar : function($slide, $progressbar) {}
    }

    // slick slider options
    // see: https://kenwheeler.github.io/slick/
    var sliderOptions = {
    	slidesToShow   : 1,
    	slidesToScroll : 1,
    	arrows         : false,
    	fade           : true,
    	autoplay       : true
    }

    // slick slider options
    // see: https://kenwheeler.github.io/slick/
    var previewSliderOptions = {
    	slidesToShow   : 3,
    	slidesToScroll : 1,
    	dots           : false,
    	focusOnSelect  : true,
    	centerMode     : false
    }
}