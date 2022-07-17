<?php
/*This file is part of monkeysatwork, hello-elementor child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/

if ( ! function_exists( 'suffice_child_enqueue_child_styles' ) ) {
	function monkeysatwork_enqueue_child_styles() {
	    // loading parent style
	    wp_register_style(
	      'parente2-style',
	      get_template_directory_uri() . '/style.css'
	    );

	    wp_enqueue_style( 'parente2-style' );
	    // loading child style
	    wp_register_style(
	      'childe2-style',
	      get_stylesheet_directory_uri() . '/style.css'
	    );
	    wp_enqueue_style( 'childe2-style');
		
		wp_enqueue_script( 'mainjs', get_stylesheet_directory_uri() . '/assets/js/main.js', array ( 'jquery' ), 1.1, true);
	    

	 }
}
add_action( 'wp_enqueue_scripts', 'monkeysatwork_enqueue_child_styles' );


/*Write here your own functions */


/**
 * Declare explicit theme support for LifterLMS course and lesson sidebars
 * @return   void
 */
function my_llms_theme_support(){
	add_theme_support( 'lifterlms-sidebars' );
}
add_action( 'after_setup_theme', 'my_llms_theme_support' );



// Hero Slider
add_action('wp_footer',  function(){
	if ( ! is_admin() ) {
		echo "<script>
			jQuery(document).ready(function ($) {
			 
			 	// Hero Slider
				const heroSlider = new Swiper('#hero-slider .swiper-container', {
				  speed: 400,
				  navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				  },
				});

				// Learning Slider
				const learningSlider = new Swiper('#learning-slider .swiper-container', {
				  slidesPerView: 1,
				  speed: 400,
				  spaceBetween: 20,
				  autoplay: {
					  delay: 3500,
					  disableOnInteraction: false,
				   },
				   breakpoints: {
					  736: {
						slidesPerView: 1
					  },
					  1023: {
						slidesPerView: 2
					  },
					  1200: {
						slidesPerView: 3
					  },
					  1300: {
						slidesPerView: 4
					  },
					},
				});

				var pmsWidth = $(window).width();

				if(pmsWidth <737){
					console.log('Mobile');

					// Services Slider
					const serviceSlider = new Swiper('#service-slider .swiper-container', {
					  slidesPerView: 1,
					  autoplay: {
						 delay: 2500,
						 disableOnInteraction: false,
					  },
					  loop: true,
	        		  centeredSlides: true,
					  speed: 2500,
					  spaceBetween: 15,
					   breakpoints: {
						  736: {
							slidesPerView: 1,
							centeredSlides: true,
						  },
						  1023: {
							slidesPerView: 2,
							centeredSlides: true,
						  }
					  },
					});
				}else{
					console.log('Not Mobile');
				}
				
				// About Items Slider
					const aboutItemSlider = new Swiper('#about-slider .swiper-container', {
					  slidesPerView: 1,
					  autoplay: {
						 delay: 2500,
						 disableOnInteraction: false,
					  },
					  loop: true,
					  speed: 2500
					});
			});
	</script>";
	}
}, 99);

// Dashboard
add_action('wp_footer', function(){
	echo "<script>
	var currentURL = window.location.pathname;
	</script>";
});


