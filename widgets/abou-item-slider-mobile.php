<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_About_Items_Slider_Mobile_Widget extends \Elementor\Widget_Base {

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
		return 'pms-about-slider-mobile';
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
		return __( 'PMS About Slider Mobile', 'pms' );
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
				'label' => __( 'Slider Content', 'pms' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_bg_image',
			[
				'label' => __( 'Choose Background Image', 'pms' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		
		$repeater->add_control(
			'list_title', [
				'label' => __( 'Title', 'pms' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Title' , 'pms' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_sub_title', [
				'label' => __( 'Sub Title', 'pms' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'List Sub Title' , 'pms' ),
				'label_block' => true,
			]
		);


		$this->add_control(
			'list',
			[
				'label' => __( 'Repeater List', 'pms' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'Title #1', 'pms' ),
						'list_sub_title' => __( 'Item content. Click the edit button to change this text.', 'pms' ),
					]
				],
				'title_field' => '{{{ list_title }}}',
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

		// Variable
		$mobile = strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile');
		$desktop = strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android');

		$device =  ($mobile || $desktop) ? 'mobile swiper-wrapper' : 'desktop';

		if($device === "mobile swiper-wrapper"){
			$swiper_container = "swiper-container";
		}else{
			$swiper_container = "not-mobile";
		}

		if ( $settings['list'] ) {
			echo '<div id="about-slider">';
			echo '<div class="'.$swiper_container.' about-slider-container">';
				echo '<div class="'.$device.' about-slider-items">';
				foreach (  $settings['list'] as $item ) {
					echo '<div class="swiper-slide">';
						echo '<div class="slide-content">';
							echo '<div class="slide-img"><img src="'.$item['list_bg_image']['url'].'"/ alt=""></div>';
							echo '<div class="slide-title"><h3>'.$item['list_title'].'</h3></div>';
							echo '<div class="slide-sub-title">' . $item['list_sub_title'] . '</div>';
						echo '</div>';
					echo '</div>';
				}
				echo '</div>';

			echo '</div>';
			echo '</div>';
		}
	}



/*
	protected function _content_template() {
		?>
		<# if ( settings.list.length ) { #>
		<dl>
			<# _.each( settings.list, function( item ) { #>
				<dt class="elementor-repeater-item-{{ item._id }}">{{{ item.list_title }}}</dt>
				<dd>{{{ item.list_content }}}</dd>
			<# }); #>
			</dl>
		<# } #>
		<?php
	}
*/

}
