<?php

namespace GpTheme\GptNewsCore\Widgets;

use Elementor\{Controls_Manager,
	Group_Control_Background,
	Group_Control_Border,
	Group_Control_Box_Shadow,
	Utils,
	Widget_Base,
	Group_Control_Typography,
	Repeater};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Class Feature
 * @package GpTheme\GptNewsCore\Widgets
 */
class FeatureBox extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve Feature widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'gpt-skill';
	}

	/**
	 * Get widget title.
	 * Retrieve Feature widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'MPT Feature Box', 'gpt-core' );
	}

	/**
	 * Get widget icon.
	 * Retrieve Feature widget icon.
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		return 'eicon-custom';
	}

	/**
	 * Get widget categories.
	 * Retrieve the list of categories the Feature widget belongs to.
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories() {
		return [ 'gpt-elements' ];
	}

	/**
	 * Get widget keywords.
	 * Retrieve the list of keywords the widget belongs to.
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'skill', 'Box' ];
	}

	/**
	 * Register widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//============================================
		// START TEAME CONTENT
		//============================================
		$this->start_controls_section( 'feature_content', [
			'label' => __( 'Skills Box', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		// Style
		$this->add_control( 'style', [
			'label'   => __( 'Style', 'gpt-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => '1',
			'options' => [
				'1' => __( 'Style 1', 'gpt-core' ),
				'2' => __( 'Style 2', 'gpt-core' ),
			],
		] );

		// Column
		$this->add_control( 'column', [
			'label'   => __( 'Column', 'gpt-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => '4',
			'options' => [
				'6' => __( '2 Column', 'gpt-core' ),
				'3' => __( '3 Column', 'gpt-core' ),
				'4' => __( '4 Column', 'gpt-core' ),
			],
		] );

		// Repeater List
		$repeater = new Repeater();

		// Title
		$repeater->add_control( 'title', [
			'label'       => __( 'Title', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Title', 'gpt-core' ),
			'default'     => __( 'Advertising and Scale', 'gpt-core' ),
			'label_block' => true,
		] );

		// percent
		$repeater->add_control( 'percent', [
			'label'       => __( 'Percent', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Percent', 'gpt-core' ),
			'default'     => __( '80%', 'gpt-core' ),
			'label_block' => true,
		] );

		// Image
		$repeater->add_control( 'image', [
			'label'   => __( 'Image', 'gpt-core' ),
			'type'    => Controls_Manager::MEDIA,
		] );


		$this->add_control( 'feature_lists',
			[
				'label'       => esc_html__( 'Feature Lists', 'gpt-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'title'       => 'HTML',
						'percent'     => '100%',
						'image'       => [
							'url' => Utils::get_placeholder_image_src(),
						],

					],
					[
						'title'       => 'CSS',
						'percent'     => '98%',
						'image'       => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
					[
						'title'       => 'JavaScript',
						'percent'     => '70%',
						'image'       => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],

				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();
		// End Feature Content
		// =====================


		// Start Name Style
		// =====================
		$this->start_controls_section( 'name_style', [
			'label' => __( 'Title', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'title_color', [
			'label'     => __( 'Text Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-skill__title' => 'color: {{VALUE}};',
			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => __( 'Typography', 'gpt-core' ),
			'selector' => '{{WRAPPER}} .gpt-skill__title',
		] );


		$this->end_controls_section();
		// End Name Style
		// =====================

		// Start Percent Style
		// =====================
		$this->start_controls_section( 'percent_style', [
			'label' => __( 'Percent', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'percent_color', [
			'label'     => __( 'Text Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-skill__percent' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'percent_typography',
			'label'    => __( 'Typography', 'gpt-core' ),
			'selector' => '{{WRAPPER}} .gpt-skill__percent',
		] );

		// Hover Percent Color
		$this->add_control( 'percent_hover_color', [
			'label'     => __( 'Hover Text Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-skill:hover .gpt-skill__percent' => 'color: {{VALUE}};',
			],
		] );

		// Hover Percent Background Color
		$this->add_control( 'percent_hover_background_color', [
			'label'     => __( 'Hover Background Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-skill:hover .gpt-skill__percent' => 'background-color: {{VALUE}};',
			],
		] );

		$this->end_controls_section();


		// Feature Container Style Section
		// ================================

		$this->start_controls_section( 'feature_container_style', [
			'label' => __( 'Feature Container', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'feature_background',
				'label'     => __( 'Background Color', 'gpt-core' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .gpt-skill',
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'feature_border',
				'label'    => __( 'Border', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-skill:not(:hover)',
			]
		);

		// Hover Border Color
		$this->add_control( 'feature_hover_border_color', [
			'label'     => __( 'Hover Border Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-skill:hover' => 'border-color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'feature_padding', [
			'label'      => __( 'Padding', 'gpt-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .gpt-skill' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );


		$this->add_responsive_control( 'feature_border-radius', [
			'label'      => __( 'Border Radius', 'gpt-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .gpt-skill' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		// Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'feature_box_shadow',
				'label'    => __( 'Box Shadow', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-skill',
			]
		);

		// Hover Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'feature_hover_box_shadow',
				'label'    => __( 'Hover Box Shadow', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-skill:hover',
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		$ant   = 0.3;
		$count = 0;

		// Wrapper attributes
		$this->add_render_attribute( 'wrapper', 'class', 'gpt-skill wow fadeInUp' );
		$this->add_render_attribute( 'wrapper', 'data-wow-delay', $ant . 's' );

		// Style
		if( $settings['style'] == '1' ) {
			$this->add_render_attribute( 'wrapper', 'class', 'gpt-skill--1' );
		} else {
			$this->add_render_attribute( 'wrapper', 'class', 'gpt-skill--2' );
		}

		echo '<div class="row justify-content-center">';
			if ( ! empty( $settings['feature_lists'] ) ) {
				foreach ( $settings['feature_lists'] as $item ) {
					require __DIR__ . '/templates/skills/skill-' . $settings['style'] . '.php';
					$ant = $ant + 0.2;
				}
			}
		echo '</div>';
	}
}