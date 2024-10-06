<?php

namespace GpTheme\GptNewsCore\Widgets;

use Elementor\{Group_Control_Border,
	Group_Control_Box_Shadow,
	Widget_Base,
	Controls_Manager,
	Group_Control_Typography,
	Group_Control_Background,
	Utils,
	Repeater
};

use GpTheme\GptNewsCore\Traits\TextAnimation;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PinVideo extends Widget_Base {

	use TextAnimation;

	/**
	 * Get widget name.
	 * Retrieve Hero widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'gpt-pin-video';
	}


	/**
	 * Get widget title.
	 * Retrieve Hero widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'MPT Pin Video', 'gpt-core' );
	}

	/**
	 * Get widget icon.
	 * Retrieve Hero widget icon.
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-photo-library';
	}

	/**
	 * Get widget categories.
	 * Retrieve the widget categories.
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories() {
		return [ 'gpt-elements' ];
	}

	/**
	 * Get widget keywords.
	 * Retrieve the widget keywords.
	 * @return array Widget keywords.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_keywords() {
		return [ 'hero', 'hero static', 'hero static image' ];
	}

	/**
	 * @return string[]
	 */
//	public function get_script_depends() {
//		return [ 'marque' ];
//	}

	/**
	 * Register Hero widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @since 1.0.0
	 * @access protected
	 */

	protected function register_controls() {

		$this->start_controls_section( 'section_hero', [
			'label' => __( 'Content', 'gpt-core' ),
		] );

		$this->add_control( 'top_title', [
			'label'       => __( 'Top Title', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'WordPress, Laravel', 'gpt-core' ),
			'label_block' => true,
			'description' => __( "Type your top title here.", 'gpt-core' ),
		] );

		$this->add_control( 'left_title', [
			'label'       => __( 'Left Title', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'Business', 'gpt-core' ),
			'label_block' => true,
			'description' => __( "Type your left title here.", 'gpt-core' ),
		] );

		$this->add_control( 'bottom_title', [
			'label'       => __( 'Bottom Title', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'Experiences...', 'gpt-core' ),
			'label_block' => true,
			'description' => __( "Type your bottom title here.", 'gpt-core' ),
		] );

		$this->add_control( 'right_title', [
			'label'       => __( 'Right Title', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'Redefining', 'gpt-core' ),
			'label_block' => true,
			'description' => __( "Type your right title here.", 'gpt-core' ),
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'Video_section', [
			'label'     => esc_html__( 'Video', 'gpt-core' ),
		] );

		// Video Section
//		$this->add_control( 'video', [
//			'label'       => __( 'Video', 'gpt-core' ),
//			'type'        => Controls_Manager::MEDIA,
//			'default'     => [
//				'url' => plugin_dir_url( __FILE__ ) . 'images/banner/video.mp4'
//			],
//			'label_block' => true,
//		] );

		// Video URL
		$this->add_control( 'video', [
			'label'       => __( 'Video URL', 'gpt-core' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => __( 'https://your-link.com', 'gpt-core' ),
			'label_block' => true,
		] );

		$this->add_control( 'video_poster', [
			'label'       => __( 'Video Poster', 'gpt-core' ),
			'type'        => Controls_Manager::MEDIA,
			'default'     => [
				'url' => plugin_dir_url( __FILE__ ) . 'images/banner/video-poster.jpg'
			],
			'label_block' => true,
		] );

		$this->end_controls_section();

	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		require __DIR__ . '/templates/video/video.php';

	}
}