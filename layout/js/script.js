$(document).ready(function () {

	new WOW().init();


})
jQuery(document).ready(function () {
	jQuery("#owl-banner").owlCarousel({
		lazyLoad: true,
		loop: true,
		dots: false,
		nav: true,
		autoplay: true,
		autoplayTimeout: 5000,
		autoplayHoverPause: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			}, 319: {
				items: 1
			}, 479: {
				items: 1
			}, 600: {
				items: 1
			}, 767: {
				items: 1
			}, 991: {
				items: 1
			}, 1199: {
				items: 1
			}
		}
	});
	jQuery("#doingu_slide").owlCarousel({
		lazyLoad: true,
		loop: true,
		dots: true,
		nav: false,
		autoplay: true,
		autoplayTimeout: 5000,
		autoplayHoverPause: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			}, 319: {
				items: 1
			}, 479: {
				items: 1
			}, 600: {
				items: 2
			}, 767: {
				items: 2
			}, 991: {
				items: 3
			}, 1199: {
				items: 3
			}
		}
	});
	jQuery("#tintuc_slide").owlCarousel({
		lazyLoad: true,
		loop: true,
		dots: false,
		margin: 20,
		nav: true,
		autoplay: true,
		autoplayTimeout: 5000,
		autoplayHoverPause: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			}, 319: {
				items: 1
			}, 479: {
				items: 1
			}, 600: {
				items: 2
			}, 767: {
				items: 2
			}, 991: {
				items: 4
			}, 1199: {
				items: 4
			}
		}
	});
});