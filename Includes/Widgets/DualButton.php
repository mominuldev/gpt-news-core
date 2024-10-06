<?php

namespace GpTheme\GptNewsCore\Widgets;

use Elementor\ {
	Icons_Manager,
	Controls_Manager,
	Group_Control_Background,
	Group_Control_Border,
	Group_Control_Box_Shadow,
	Group_Control_Text_Shadow,
	Group_Control_Typography,
	Widget_Base
};

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class DualButton extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve button widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name()
	{
		return 'gpt-dual-button';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve button widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title()
	{
		return __('MPT Dual Button', 'gpt-core');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve button widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon()
	{
		return 'eicon-button';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the icon box widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_categories()
	{
		return ['gpt-elements'];
	}


	/**
	 * The keywords for search.
	 *
	 * @return array
	 */
	public function get_keywords() {
		return [ 'button', 'call to action', 'decent element', 'btn' ];
	}


	/**
	 * Get button sizes.
	 *
	 * Retrieve an array of button sizes for the button widget.
	 *
	 * @return array An array containing button sizes.
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 */
	public static function get_button_sizes()
	{
		return [
			'btn-xs' => __('Extra Small', 'gpt-core'),
			'btn-sm' => __('Small', 'gpt-core'),
			'btn-md' => __('Medium', 'gpt-core'),
			'btn-lg' => __('Large', 'gpt-core'),
			'btn-xl' => __('Extra Large', 'gpt-core'),
		];
	}

	/**
	 * Add controls.
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'second_button_section',
			[
				'label' => __( 'General Settings', 'gpt-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'button_align',
			[
				'label' => __( 'Alignment', 'gpt-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'gpt-core' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'gpt-core' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'gpt-core' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .gpt-button-container' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'size',
			[
				'label' => esc_html__( 'Size', 'gpt-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'btn-md',
				'options' => $this->get_button_sizes(),
				'style_transfer' => true,
			]
		);

		$this->add_responsive_control( 'space_between_button', [
			'label'           => __( 'Space Between Buttons', 'gpt-core' ),
			'type'            => Controls_Manager::SLIDER,
			'range'           => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'default' => [
				'unit' => 'px',
				'size' => 15,
			],
			'selectors'       => [
				'{{WRAPPER}} .gpt-button-primary' => 'margin-right: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .gpt-block .gpt-button-primary' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
			'separator' => 'after'
		] );

		$this->end_controls_section();


		$this->start_controls_section(
			'button_section',
			[
				'label' => __( 'Dual Button', 'gpt-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->start_controls_tabs( 'tabs_dual_button' );

		$this->start_controls_tab(
			'tab_button_primary',
			[
				'label' => __('Primary', 'gpt-core'),
			]
		);

		$this->add_control(
			'button_label',
			[
				'label' => __( 'Text', 'gpt-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Click Here', 'gpt-core' ),
				'placeholder' => __( 'Type your button title here', 'gpt-core' ),
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'button_link',
			[
				'label' => __( 'Link', 'gpt-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'gpt-core' ),
				'default' => [
					'url' => '#',
				],
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'button_icon_options',
			[
				'label' => __( 'Icons', 'gpt-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'gpt-core' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'gpt-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'gpt-core' ),
					'right' => esc_html__( 'After', 'gpt-core' ),
				],
				'condition' => [
					'selected_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'gpt-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gpt-btn-one .gpt-btn__align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gpt-btn-one .gpt-btn__align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control( 'icon_size', [
			'label'           => __( 'Icon Size', 'gpt-core' ),
			'type'            => Controls_Manager::SLIDER,
			'range'           => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'default' => [
				'unit' => 'px',
				'size' => 15,
			],
			'selectors'       => [
				'{{WRAPPER}} .gpt-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .gpt-btn-one svg, {{WRAPPER}} .gpt-btn-one img,
				{{WRAPPER}} .gpt-btn-two svg, {{WRAPPER}} .gpt-btn-two img' => 'width: {{SIZE}}{{UNIT}};',
			],

		] );

		$this->add_control(
			'button_shape',
			[
				'label' => __('Shape', 'gpt-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'btn-round',
				'options' => [
					'btn-square' => __('Square', 'gpt-core'),
					'btn-round' => __('Round', 'gpt-core'),
					'btn-circle' => __('Circle', 'gpt-core'),
				],
			]
		);

		$this->add_control(
			'button_style',
			[
				'label' => __('Shape', 'gpt-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'btn-default',
				'options' => [
					'btn-default' => __('Default', 'gpt-core'),
					'btn-outline' => __('Outline', 'gpt-core'),
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_secondary',
			[
				'label' => __('Secondary', 'gpt-core'),
			]
		);

		$this->add_control(
			'button_type',
			[
				'label' => __('Shape', 'gpt-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'button',
				'options' => [
					'button' => __('Simple Button', 'gpt-core'),
					'popup_video' => __('Popup Video Button', 'gpt-core'),
				],
			]
		);

		$this->add_control(
			'sec_button_label',
			[
				'label' => __( 'Text', 'gpt-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Click Here', 'gpt-core' ),
				'placeholder' => __( 'Type your button title here', 'gpt-core' ),
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'sec_button_link',
			[
				'label' => __( 'Link', 'gpt-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'gpt-core' ),
				'default' => [
					'url' => '#',
				],
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'sec_button_icon_options',
			[
				'label' => __( 'Icons', 'gpt-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sec_selected_icon',
			[
				'label' => esc_html__( 'Icon', 'gpt-core' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'sec_icon',
				'skin' => 'inline',
				'label_block' => false,
			]
		);

		$this->add_control(
			'sec_icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'gpt-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'gpt-core' ),
					'right' => esc_html__( 'After', 'gpt-core' ),
				],
				'condition' => [
					'sec_selected_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'sec_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'gpt-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gpt-btn-two .gpt-btn__align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gpt-btn-two .gpt-btn__align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'sec_button_shape',
			[
				'label' => __('Shape', 'gpt-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'btn-round',
				'options' => [
					'btn-square' => __('Square', 'gpt-core'),
					'btn-round' => __('Round', 'gpt-core'),
					'btn-circle' => __('Circle', 'gpt-core'),
				],
			]
		);

		$this->add_control(
			'sec_button_style',
			[
				'label' => __('Shape', 'gpt-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'btn-outline',
				'options' => [
					'btn-default' => __('Default', 'gpt-core'),
					'btn-outline' => __('Outline', 'gpt-core'),
				],
			]
		);


		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'button_layout',
			[
				'label' => __( 'Layout', 'gpt-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'gpt-inline' => [
						'title' => __( 'Inline', 'gpt-core' ),
						'icon' => 'eicon-navigation-horizontal',
					],
					'gpt-block' => [
						'title' => __( 'Block', 'gpt-core' ),
						'icon' => 'eicon-navigation-vertical',
					],
				],
				'default' => 'gpt-inline',
			]
		);

		$this->end_controls_section();

		// Button Primary Style Section
		//=====================================
		$this->start_controls_section(
			'button_primary_style_section',
			[
				'label' => __( 'Button', 'gpt-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __( 'Typography', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-btn-one',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .gpt-btn-one',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'gpt-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .gpt-btn-one' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label' => esc_html__( 'Padding', 'gpt-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gpt-btn-one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'gpt-core' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Color', 'gpt-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gpt-btn-one' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'gpt-core' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .gpt-btn-one',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .gpt-btn-one',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .gpt-btn-one',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'gpt-core' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => esc_html__( 'Text Color', 'gpt-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-btn-one:hover, {{WRAPPER}} .gpt-btn-one:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gpt-btn-one:hover svg, {{WRAPPER}} .gpt-btn-one:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background_hover',
				'label' => esc_html__( 'Background', 'gpt-core' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .gpt-btn-one:hover, {{WRAPPER}} .gpt-btn-one:focus',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_hover',
				'selector' => '{{WRAPPER}} .gpt-btn-one:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .gpt-btn-one:hover',
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'gpt-core' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Secondary Button Style
		//============================
		$this->start_controls_section(
			'button_secondary_style_section',
			[
				'label' => __( 'Secondary Button', 'gpt-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'button_type' => 'button'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sec_button_typography',
				'label' => __( 'Typography', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-btn-two',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'sec_text_shadow',
				'selector' => '{{WRAPPER}} .gpt-btn-two',
			]
		);

		$this->add_control(
			'sec_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'gpt-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .gpt-btn-two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'sec_text_padding',
			[
				'label' => esc_html__( 'Padding', 'gpt-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gpt-btn-two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'sec_tabs_button_style' );

		$this->start_controls_tab(
			'sec_tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'gpt-core' ),
			]
		);

		$this->add_control(
			'sec_button_text_color',
			[
				'label' => esc_html__( 'Color', 'gpt-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gpt-btn-two' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'sec_background',
				'label' => esc_html__( 'Background', 'gpt-core' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .gpt-btn-two',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'sec_border',
				'selector' => '{{WRAPPER}} .gpt-btn-two',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'sec_button_box_shadow',
				'selector' => '{{WRAPPER}} .gpt-btn-two',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'sec_tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'gpt-core' ),
			]
		);

		$this->add_control(
			'sec_hover_color',
			[
				'label' => esc_html__( 'Color', 'gpt-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-btn-two:hover, {{WRAPPER}} .gpt-btn-two:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gpt-btn-two:hover svg, {{WRAPPER}} .gpt-btn-two:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'sec_button_background_hover',
				'label' => esc_html__( 'Background', 'gpt-core' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .gpt-btn-two:hover, {{WRAPPER}} .gpt-btn-two:focus',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'sec_border_hover',
				'selector' => '{{WRAPPER}} .gpt-btn-two:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'sec_button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .gpt-btn-two:hover',
			]
		);

		$this->add_control(
			'sec_hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'gpt-core' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

		// Video Button Style
		//=======================
		$this->start_controls_section(
			'video_button_style',
			[
				'label' => __( 'Popup Video Button', 'gpt-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'button_type' => 'popup_video'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'video_button_typography',
				'label' => __( 'Typography', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .play-button',
			]
		);

		$this->add_control(
			'video_border_radius',
			[
				'label' => esc_html__( 'Icon Border Radius', 'gpt-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .play-button i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'video_text_padding',
			[
				'label' => esc_html__( 'Icon Padding', 'gpt-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .play-button i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'tabs_video_style' );

		$this->start_controls_tab(
			'tab_button_video_normal',
			[
				'label' => esc_html__( 'Normal', 'gpt-core' ),
			]
		);

		$this->add_control(
			'video_button_color',
			[
				'label' => esc_html__( 'Color', 'gpt-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play-button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .play-button .gpt-btn__text:after' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'video_button_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'gpt-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play-button i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'play_button_background',
				'label' => esc_html__( 'Icon Background', 'gpt-core' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .play-button .gpt-btn__icon',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'play_button_border',
				'selector' => '{{WRAPPER}} .play-button .gpt-btn__icon',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'video_button_box_shadow',
				'selector' => '{{WRAPPER}} .play-button .gpt-btn__icon',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_video_button_hover',
			[
				'label' => esc_html__( 'Hover', 'gpt-core' ),
			]
		);

		$this->add_control(
			'video_button_hover_color',
			[
				'label' => esc_html__( 'Color', 'gpt-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play-button:hover, {{WRAPPER}} .play-button:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .play-button:hover .gpt-btn__text:after' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'video_button_hover_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'gpt-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play-button:hover i, {{WRAPPER}} .play-button:focus i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'play_button_background_hover',
				'label' => esc_html__( 'Icon Background', 'gpt-core' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .play-button:hover .gpt-btn__icon, {{WRAPPER}} .play-button:focus .gpt-btn__icon',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'play_button_border_hover',
				'selector' => '{{WRAPPER}} .play-button:hover i',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'video_button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .play-button:hover i',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$migration_allowed = Icons_Manager::is_migration_allowed();

		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

		if ( ! $is_new && empty( $settings['icon_align'] ) ) {
			$settings['icon_align'] = $this->get_settings( 'icon_align' );
		}

		if ( ! $is_new && empty( $settings['sec_icon_align'] ) ) {
			$settings['sec_icon_align'] = $this->get_settings( 'sec_icon_align' );
		}

		if ( ! empty( $settings['button_link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['button_link'] );
		}

		if ( ! empty( $settings['sec_button_link']['url'] ) ) {
			$this->add_link_attributes( 'buttontwo', $settings['sec_button_link'] );
		}

		// Video Button
		if ( ! empty( $settings['sec_button_link']['url'] ) ) {
			$this->add_link_attributes( 'video', $settings['sec_button_link'] );
		}

		/**
		 * Button
		 */
		$this->add_render_attribute( 'button', 'class', ['gpt-btn gpt-btn-one', $settings['button_style'] ] );
		// Button Shape
		if( ! empty( $settings['button_shape'] ) ) {
			$this->add_render_attribute( 'button', 'class',  $settings['button_shape'] );
		}
		$this->add_render_attribute( 'video', 'class', 'play-button btn-fill'  );

		/**
		 * Button Size Class
		 */
		if ( ! empty ( $settings['size'] ) ) {
			$this->add_render_attribute( 'button', 'class', $settings['size'] );
		}

		$this->add_render_attribute( 'buttontwo', 'class', ['gpt-btn gpt-btn-two', $settings['sec_button_style'] ] );

		/**
		 * Button Size Class
		 */
		if ( ! empty ( $settings['size'] ) ) {
			$this->add_render_attribute( 'buttontwo', 'class', $settings['size'] );
		}

		if( ! empty( $settings['button_shape'] ) ) {
			$this->add_render_attribute( 'buttontwo', 'class',  $settings['sec_button_shape'] );
		}


		/**
		 * Extra Css Classes
		 */
		if ( ! empty( $settings['button_class'] ) ) {
			$this->add_render_attribute( 'button', 'class', $settings['button_class'] );
		}

		if ( ! empty( $settings['button_id'] ) ) {
			$this->add_render_attribute( 'button', 'id', $settings['button_id'] );
		}
		$this->add_render_attribute( [
			'icon-align' => [
				'class' => [
					'gpt-btn__icon',
					'gpt-btn__align-icon-' . $settings['icon_align'],
				],
			],
			'text' => [
				'class' => 'gpt-btn__text',
			],
		] );

		$this->add_render_attribute( [
			'sec_icon_align' => [
				'class' => [
					'gpt-btn__icon',
					'gpt-btn__align-icon-' . $settings['sec_icon_align'],
				],
			],
			'text' => [
				'class' => 'gpt-btn__text',
			],
		] );

		$this->add_render_attribute( 'button_label', 'class', 'gpt-btn__text' );
		$this->add_inline_editing_attributes( 'button_label', 'none' );

		$this->add_render_attribute( 'sec_button_label', 'class', 'gpt-btn__text' );
		$this->add_inline_editing_attributes( 'sec_button_label', 'none' );

		?>

		<div class="gpt-button-container <?php echo esc_attr( $settings['button_layout'] ); ?>">

			<?php if ( ! empty( $settings['button_label'] ) ) : ?>
				<div class="gpt-button-wrapper gpt-button-primary">
					<a <?php $this->print_render_attribute_string( 'button' ); ?>>
						<span class="gpt-btn-content-wrapper">
							<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) : ?>
								<span <?php $this->print_render_attribute_string( 'icon-align' ); ?>>
									<?php if ( $is_new || $migrated ) :
										Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
									else : ?>
										<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
									<?php endif; ?>
								</span>
							<?php endif; ?>
							<span <?php $this->print_render_attribute_string( 'button_label' ); ?>><?php $this->print_unescaped_setting( 'button_label' ); ?></span>
						</span>
						<!-- /.gpt-btn-content-wrapper -->
					</a>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $settings['sec_button_label'] ) ) : ?>
				<div class="gpt-button-wrapper">
					<?php if ( 'button' == $settings['button_type'] ) : ?>
						<a <?php $this->print_render_attribute_string( 'buttontwo' ); ?>>
							<span class="gpt-btn-content-wrapper">
								<?php if ( ! empty( $settings['sec_icon'] ) || ! empty( $settings['sec_selected_icon']['value'] ) ) : ?>
									<span <?php $this->print_render_attribute_string( 'sec_icon_align' ); ?>>
											<?php if ( $is_new || $migrated ) :
												Icons_Manager::render_icon( $settings['sec_selected_icon'], [ 'aria-hidden' => 'true' ] );
											else : ?>
												<i class="<?php echo esc_attr( $settings['sec_icon'] ); ?>" aria-hidden="true"></i>
											<?php endif; ?>
										</span>
								<?php endif; ?>
								<span <?php $this->print_render_attribute_string( 'sec_button_label' ); ?>><?php $this->print_unescaped_setting( 'sec_button_label' ); ?></span>
							</span>
						</a>
					<?php elseif ('popup_video' == $settings['button_type']) : ?>
						<a <?php $this->print_render_attribute_string( 'video' ); ?>>
                            <span class="gpt-btn__icon">
                                <i class="fas fa-play"></i>
                            </span>
							<span class="gpt-btn__text">
                                <?php echo esc_html( $settings['sec_button_label'] ); ?>
                            </span>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
		<!-- /.gpt-btn-wrapper -->
		<?php
	}
}