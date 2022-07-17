<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Hero_Widget extends \Elementor\Widget_Base {

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
		return 'pms-hero-slider';
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
		return __( 'PMS Hero Slider', 'pms' );
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
			'list_sub_title', [
				'label' => __( 'Sub Title', 'pms' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Sub Title' , 'pms' ),
				'label_block' => true,
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
			'list_content', [
				'label' => __( 'Content', 'pms' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'List Content' , 'pms' ),
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'list_link_content', [
				'label' => __( 'Learn More', 'pms' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Learn More' , 'pms' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_link',
			[
				'label' => __( 'Learn More Link', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'pms' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

		$repeater->add_control(
			'list_left_image',
			[
				'label' => __( 'Choose Left Image', 'pms' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
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
						'list_sub_title' => __( 'Sub Title #1', 'pms' ),
						'list_title' => __( 'Title #1', 'pms' ),
						'list_content' => __( 'Item content. Click the edit button to change this text.', 'pms' ),
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

		if ( $settings['list'] ) {
			echo '<div id="hero-slider">';
			echo '<div class="swiper-container">';
				echo '<div class="swiper-wrapper">';
				foreach (  $settings['list'] as $item ) {
					$style_option = ( ! empty( $item['list_left_image']['id'] )) ? "style-2" : "style-1";
					echo '<div class="swiper-slide '.$style_option.'" style="background-image:url('.$item['list_bg_image']['url'].')">';

						echo '<div class="hero-slider-row">';

							if ( ! empty( $item['list_left_image']['id'] ) ) {
								echo '<div class="slide-img">';
									echo '<img src="'.$item['list_left_image']['url'].'"/ alt="">';
								echo '</div>';
							}

							// Content add Span
							 $slide_title = explode(" ",$item['list_title']);

							echo '<div class="slide-content">';
								echo '<div class="slide-sub-title">' . $item['list_sub_title'] . '</div>';
								echo '<div class="slide-title">'; 
									foreach($slide_title as $title_item){
										echo ' <span> ' . $title_item . ' </span> ';
									} 
								echo '</div>';

								echo '<div class="slide-description">' . $item['list_content'] . '</div>';
								
								if ( ! empty($item['list_link']['url']	)) {
									echo '<div class="slide-learn-more"><a href="'.$item['list_link']['url'].'" class="elementor-button">' . $item['list_link_content'] . '</a></div>';
								}
							echo '</div>';


							echo '</div>';
						echo '</div>';
				}
				echo '</div>';
				echo '<div class="swiper-button-prev"></div>';
				echo '<div class="swiper-button-next"></div>';


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
