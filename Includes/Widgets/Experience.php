<?php

namespace GpTheme\GptNewsCore\Widgets;

use Elementor\{Controls_Manager,
	Group_Control_Background,
	Group_Control_Border,
	Group_Control_Box_Shadow,
	Widget_Base,
	Group_Control_Typography,
	Repeater
};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Class Service
 * @package GpTheme\GptNewsCore\Widgets
 */
class Experience extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve Service widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'gpt-exprience';
	}

	/**
	 * Get widget title.
	 * Retrieve Service widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'MPT Experience', 'gpt-core' );
	}

	/**
	 * Get widget icon.
	 * Retrieve Service widget icon.
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		return 'eicon-custom';
	}

	/**
	 * Get widget categories.
	 * Retrieve the list of categories the Service widget belongs to.
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
		return [ 'Service', 'gpt member' ];
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
		$this->start_controls_section( 'service_content', [
			'label' => __( 'Service Member', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Style', 'gpt-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'one',
				'options' => [
					'one'   => esc_html__( 'Style One', 'gpt-core' ),
					'two'   => esc_html__( 'Style Two', 'gpt-core' ),
				]
			]
		);

		// Icon Type
		$this->add_control( 'icon_type', [
			'label'   => __( 'Icon Type', 'gpt-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'image',
			'options' => [
				'icon'  => __( 'Icon', 'gpt-core' ),
				'image' => __( 'Image', 'gpt-core' ),
			],
		] );

//		 Icon
		$this->add_control( 'icon', [
			'label'     => __( 'Icon', 'gpt-core' ),
			'type'      => Controls_Manager::ICONS,
			'condition' => [
				'icon_type' => 'icon'
			]
		] );

//		 Image
		$this->add_control( 'image', [
			'label'     => __( 'Choose Image', 'gpt-core' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => plugin_dir_url( __FILE__ ) . 'images/service.png'
			],
			'condition' => [
				'icon_type' => 'image'
			]
		] );

		// Count
		$this->add_control( 'year', [
			'label'       => __( 'Year', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Count', 'gpt-core' ),
			'default'     => __( '2023 - PRESENT', 'gpt-core' ),
		] );

		$this->add_control( 'designation', [
			'label'       => __( 'Designation', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Title', 'gpt-core' ),
			'default'     => __( 'Brand Identity Design', 'gpt-core' ),
			'label_block' => true,
		] );

		// Description
		$this->add_control( 'company_name', [
			'label'       => __( 'Company Name', 'gpt-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'placeholder' => __( 'Enter Description', 'gpt-core' ),
			'default'     => __( 'Design Monks', 'gpt-core' ),
		] );


		$this->end_controls_section();
		// End Service Content
		// =====================


		// Start Name Style
		// =====================
		$this->start_controls_section( 'name_style', [
			'label' => __( 'Designation', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'title_color', [
			'label'     => __( 'Text Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-experience__title' => 'color: {{VALUE}};',
			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => __( 'Typography', 'gpt-core' ),
			'selector' => '{{WRAPPER}} .gpt-experience__title',
		] );


		$this->end_controls_section();
		// End Name Style
		// =====================

		// Start Position Style
		// =====================
		$this->start_controls_section( 'btn_arrow_style', [
			'label'     => __( 'Button', 'gpt-core' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'layout' => 'two'
			]
		] );

		$this->add_control( 'btn_arrow_color', [
			'label'     => __( 'Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-experience__arrow svg path' => 'fill: {{VALUE}};',
			],
		] );

		$this->end_controls_section();

		// Start Position Style
		// =====================
		$this->start_controls_section( 'position_style', [
			'label'     => __( 'Button', 'gpt-core' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'layout' => 'one'
			]
		] );

		$this->add_control( 'btn_color', [
			'label'     => __( 'Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-experience__btn' => 'color: {{VALUE}};',
			],
		] );

		// Hover Color
		$this->add_control( 'btn_hover_color', [
			'label'     => __( 'Hover Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-experience__btn:hover' => 'color: {{VALUE}};',
			],
		] );

		// Background Color
		$this->add_control( 'btn_bg_color', [
			'label'     => __( 'Background Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-experience__btn' => 'background-color: {{VALUE}};',
			],
		] );

		// Hover Background Color
		$this->add_control( 'btn_hover_bg_color', [
			'label'     => __( 'Hover Background Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-experience__btn:hover' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'position_typography',
			'label'    => __( 'Typography', 'gpt-core' ),
			'selector' => '{{WRAPPER}} .gpt-experience__btn',
		] );

		// Height and Width
		$this->add_responsive_control( 'btn_height_width', [
			'label'      => __( 'Height & Width', 'gpt-core' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 300,
				],
				'em' => [
					'min' => 0,
					'max' => 20,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .gpt-experience__btn' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();


		// Icon Style
		// =====================
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Icon ', 'gpt-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Background Color
		$this->add_control(
			'background_color',
			[
				'label'     => __( 'Background Color', 'gpt-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-experience__icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		// Icon Color
		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Icon Color', 'gpt-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-experience__icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gpt-experience__icon svg path' => 'fill: {{VALUE}};',
				],
			]
		);

		//Size
		$this->add_control(
			'icon_size',
			[
				'label'     => __( 'Icon Size', 'gpt-core' ),
				'type'      => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'     => [
					'px' => [
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					],
					'em' => [
						'min'  => 1,
						'max'  => 10,
						'step' => 0.1,
					],
					'rem' => [
						'min'  => 1,
						'max'  => 10,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gpt-experience__icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gpt-experience__icon svg' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Padding Slider Control
		$this->add_control(
			'icon_padding',
			[
				'label'     => __( 'Padding', 'gpt-core' ),
				'type'      => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'     => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					],
					'em' => [
						'min'  => 0.5,
						'max'  => 10,
						'step' => 0.1,
					],
					'rem' => [
						'min'  => 0.5,
						'max'  => 10,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gpt-experience__icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'gpt-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .gpt-experience__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();



		// Service Container Style Section
		// ================================

		$this->start_controls_section( 'service_container_style', [
			'label' => __( 'Service Container', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'service_background',
				'label'    => __( 'Background Color', 'gpt-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .gpt-experience',
			]
		);

		// Hover Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'service_hover_background',
				'label'    => __( 'Hover Background Color', 'gpt-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .gpt-experience:hover',
			]
		);

		// Overlay Background
		$this->add_control( 'service_overlay_bg', [
			'label'     => __( 'Overlay BG Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-experience:after' => 'background-color: {{VALUE}};',
			],
			'condition' => [
				'layout' => 'one'
			]
		] );

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'service_border',
				'label'    => __( 'Border', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-experience:not(:hover)',
			]
		);

		// Hover Border Color
		$this->add_control( 'service_hover_border_color', [
			'label'     => __( 'Hover Border Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-experience:hover' => 'border-color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'service_padding', [
			'label'      => __( 'Padding', 'gpt-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .gpt-experience' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );


		$this->add_responsive_control( 'service_border-radius', [
			'label'      => __( 'Border Radius', 'gpt-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .gpt-experience' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		// Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'service_box_shadow',
				'label'    => __( 'Box Shadow', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-experience',
			]
		);

		// Hover Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'service_hover_box_shadow',
				'label'    => __( 'Hover Box Shadow', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-experience:hover',
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		// Wrapper attributes
		$this->add_render_attribute( 'wrapper', 'class', 'gpt-experience' );

		// Button Class
		$this->add_render_attribute( 'btn_link', 'class', 'gpt-experience__btn' );

		require __DIR__ . '/templates/experience/experience.php';
	}

}