<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Services_Slider_Widget extends \Elementor\Widget_Base {

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
		return 'pms-services-slider';
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
		return __( 'PMS Services Slider', 'pms' );
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
				'label' => __( 'Services Content', 'pms' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'service_sub_title', [
				'label' => __( 'Service Sub Title', 'pms' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Services' , 'pms' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'service_title', [
				'label' => __( 'Service Title', 'pms' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Service Title' , 'pms' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'service_description', [
				'label' => __( 'Service Description', 'pms' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Service Description' , 'pms' ),
				'label_block' => true,
			]
		);


		$this->add_control(
			'list',
			[
				'label' => __( 'Service List', 'pms' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'service_sub_title' => __( 'Service', 'pms' ),
						'service_title' => __( 'Service Title #1', 'pms' ),
						'service_description' => __( 'Service Description', 'pms' ),
					]
				],
				'title_field' => '{{{ service_title }}}',
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

		if ( $settings['list'] ) {
			echo '<div id="service-slider">';
			echo '<div class="swiper-container">';
			echo '<div class="swiper-wrapper">';

				foreach (  $settings['list'] as $item ) {
					echo '<div class="swiper-slide">';
						echo '<div class="service-slider-content">';

								echo '<div class="service-sub-title elementor-kit-12"><h5>' . $item['service_sub_title'] . '</h5></div>';
								echo '<div class="service-title elementor-kit-12"><h3>' . $item['service_title'] . '</h3></div>';
								echo '<div class="service-description">' . $item['service_description'] . '</div>';

						echo '</div>';
					echo '</div>';
				}

			echo '</div>';
			echo '</div>';
			echo '</div>';
		}

	}

}
