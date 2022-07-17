<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Learning_Course_List_Widget extends \Elementor\Widget_Base {

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
		return 'pms-learning-course-list';
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
		return __( 'PMS Learning Course List', 'pms' );
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
				'label' => __( 'PMS Learning Course', 'pms' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'lc_title', [
				'label' => __( 'Course Title', 'pms' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Course Title', 'pms' ),
				'placeholder' => __( 'Course Title Here', 'pms' ),
			]
		);

		$terms_save = [];
		$terms = get_terms( [
		    'taxonomy' => 'course_cat',
		    'hide_empty' => false,
		]);
		foreach ( $terms as $term ) {
			$terms_save[$term->slug] = $term->name;
		}

		// var_dump($terms_save);

		$this->add_control(
			'course_category',
			[
				'label' => __( 'Course Category', 'pms' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => $terms_save,
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
		$settings = $this->get_settings_for_display();

		$args = [
		  'post_type' => 'course',
		  'posts_per_page' => 4,
		  'tax_query' => [
		  	[
		  		'taxonomy'  => 'course_cat',
		  		'field' => 'slug',
		  		'terms' => $settings['course_category']
		  	]
		  ]
		];
		$the_query = new WP_Query( $args );

	// The Loop
			echo '<div id="learning-course" class="'.$settings['course_category'].'">';
			echo '<h3 id="lc-title">'.$settings['lc_title'].'</h3>';
				if ( $the_query->have_posts() ) {
						echo '<div class="learning-course-items">';
				    while ( $the_query->have_posts() ) {
				        $the_query->the_post();
				        echo '<div class="lc-item"><figure>';
					        echo '<div class="lc-image"><a href="'.get_the_permalink( ).'"><img src="' . get_the_post_thumbnail_url( ) . '"/></a></div>';
					        echo '<figcaption><div class="lc-title elementor-kit-12"><a href="'.get_the_permalink( ).'"><h4>' . get_the_title() . '</h4></a></div>';
					        echo '<div class="lc-author"><div class="lc-author-image">'. get_avatar( get_the_author_meta( 'ID' ), 32 ).'</div><div class="lc-author-name">'.get_the_author().'</div></div>';
						$course_hours = get_field('course_hours');
						$course_hours = $course_hours ? $course_hours .' hours ' : '';
					        echo '<div class="lc-duration"><p>'. $course_hours .'</p></div></figcaption>';
				        echo '</div></figure>';
				    }
						echo '</div>';
				} else {
				    // no posts found
				}
			echo '</div>';
	/* Restore original Post Data */
	wp_reset_postdata();
	}


}
