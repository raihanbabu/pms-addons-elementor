<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Home_Learning_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'pms-learning-slider';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'PMS Learning Slider', 'pms' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-code';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Retrieve the list of scripts the image carousel widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	// public function get_script_depends() {
	// 	return [ 'swiper' ];
	// }

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Learning Slider Content', 'pms' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'list_sub_title', [
				'label' => __( 'Slider Items', 'pms' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 20,
				'step' => 1,
				'default' => 4,
			]
		);
		

		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		// $settings = $this->get_settings_for_display();


		$args = array(
		  'post_type' => 'course',
		  'posts_per_page' => 6

		);
		$the_query = new WP_Query( $args );

	// The Loop
	if ( $the_query->have_posts() ) {

			echo '<div id="learning-slider">';
			echo '<div class="swiper-container">';
			echo '<div class="swiper-wrapper">';
	    while ( $the_query->have_posts() ) {
	        $the_query->the_post();
	        echo '<div class="swiper-slide">';
		        echo '<div class="ls-image"><a href="'.get_the_permalink( ).'"><img src="' . get_the_post_thumbnail_url( ) . '"/></a></div>';
		        echo '<div class="ls-title elementor-kit-12"><a href="'.get_the_permalink( ).'"><h3>' . get_the_title() . '</h3></a></div>';
		        echo '<div class="ls-date"><p>' . get_the_date( ) . '</p></div>';
	        echo '</div>';
	    }

			echo '</div>';
			echo '</div>';
			echo '</div>';
	} else {
	    // no posts found
	}
	/* Restore original Post Data */
	wp_reset_postdata();


	}


}
