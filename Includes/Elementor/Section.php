<?php

namespace GpTheme\GptNewsCore\Elementor;

use Elementor\{Widget_Base,
	Controls_Manager,
	Group_Control_Border,
	Group_Control_Typography,
	Group_Control_Text_Shadow,
	Group_Control_Background,
	Frontend,
	Repeater,
	Plugin,
	Shapes
};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Elementor Section
 *
 * @class        Section
 * @version      1.0
 * @category Class
 * @author       CodeBoxr
 */
class Section {


	public $sections = [];

	public function __construct() {
		add_action( 'elementor/init', [ $this, 'add_hooks' ] );
	}

	public function add_hooks() {

		// Add TT extension control section to Section panel
		add_action( 'elementor/element/section/section_typo/after_section_end', [ $this, 'extened_animation' ], 10, 2 );
		//add_action( 'elementor/element/section/section_layout/after_section_end', [ $this, 'extends_header_params' ], 10, 2 );
		add_action( 'elementor/element/column/layout/after_section_end', [ $this, 'extends_column_params' ], 10, 2 );
		add_action( 'elementor/frontend/section/before_render', [ $this, 'extened_row_render' ], 10, 1 );
		add_action( 'elementor/frontend/column/before_render', [ $this, 'extened_column_render' ], 10, 1 );
		add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'elementor/element/wp-post/document_settings/after_section_end', [$this,'post_metaboxes'], 10, 1 );
	}


	function post_metaboxes( $page ) {

		$page->start_controls_section( 'header_options', [
			'label' => esc_html__( 'GPT Header Options', 'gpt-news-core' ),
			'tab'   => Controls_Manager::TAB_SETTINGS,
		] );

		$page->add_control( 'mobile_breakpoint', [
			'label'   => esc_html__( 'Mobile Header resolution breakpoint', 'gpt-news-core' ),
			'type'    => Controls_Manager::NUMBER,
			'step'    => 1,
			'min'     => 5,
			'max'     => 4000,
			'default' => 1200,
		] );

		$page->add_control( 'header_on_bg', [
			'label'        => esc_html__( 'Over content?', 'gpt-news-core' ),
			'description'  => esc_html__( 'Set Header to display over content.', 'gpt-news-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'On', 'gpt-news-core' ),
			'label_off'    => esc_html__( 'Off', 'gpt-news-core' ),
			'return_value' => 'yes',
		] );

		$page->end_controls_section();


	}

	public function extened_row_render( \Elementor\Element_Base $element ) {

		if ( 'section' !== $element->get_name() ) {
			return;
		}

		$settings = $element->get_settings();
		$data     = $element->get_data();

		if ( isset( $settings['add_background_text'] ) && ! empty( $settings['add_background_text'] ) ) {

			wp_enqueue_script( 'appear', esc_url( GPT_SCRIPTS . '/jquery.appear.js' ), [], false, false );
			wp_enqueue_script( 'anime', esc_url( GPT_SCRIPTS . '/anime.min.js' ), [], false, false );
		}

		if ( isset( $settings['add_background_animation'] ) && ! empty( $settings['add_background_animation'] ) ) {
			if ( ! (bool) Plugin::$instance->editor->is_edit_mode() ) {
				wp_enqueue_script( 'parallax', esc_url( GPT_SCRIPTS . '/parallax.min.js' ), [], false, false );
				wp_enqueue_script( 'paroller', esc_url( GPT_SCRIPTS . '/jquery.paroller.min.js' ), [], false, false );
				//wp_enqueue_style( 'animate', esc_url( GPT_SCRIPTS . 'assets/css/animate.css' ) );
			}
		}

		$this->sections[ $data['id'] ] = $settings;

	}

	public function extened_column_render( \Elementor\Element_Base $element ) {

		if ( 'column' !== $element->get_name() ) {
			return;
		}

		$settings = $element->get_settings();
		$data     = $element->get_data();

		if ( isset( $settings['apply_sticky_column'] ) && ! empty( $settings['apply_sticky_column'] ) ) {
			wp_enqueue_script( 'theia-sticky-sidebar', GPT_SCRIPTS . '/theia-sticky-sidebar.min.js', [], false, false );
		}
	}

	public function enqueue_scripts() {

		if ( (bool) Plugin::$instance->preview->is_preview_mode() ) {
			//wp_enqueue_style( 'animate', esc_url( GPT_SCRIPTS . '/css/animate.css' ) );

			wp_enqueue_script( 'parallax', esc_url( GPT_SCRIPTS . '/parallax.min.js' ), [], false, false );
			wp_enqueue_script( 'paroller', esc_url( GPT_SCRIPTS . '/jquery.paroller.min.js' ), [], false, false );
			wp_enqueue_script( 'theia-sticky-sidebar', GPT_SCRIPTS . '/theia-sticky-sidebar.min.js', [], false, false );
		}


		//Add options in the section
		wp_enqueue_script( 'gpt-parallax', esc_url( GPT_SCRIPTS . '/elementor_sections.js' ), [ 'jquery' ], false, true );

		//Add options in the column
		wp_enqueue_script( 'gpt-column', esc_url( GPT_SCRIPTS . '/elementor_column.js' ), [ 'jquery' ], false, true );

		wp_localize_script( 'gpt-parallax', 'gpt_parallax_settings', [
			$this->sections,
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'svgURL'  => esc_url( GPT_CORE_ASSETS_URL . 'shapes/' ),
		] );
	}

	public function extened_animation( $widget, $args ) {
		$widget->start_controls_section( 'extened_animation', [
			'label' => esc_html__( 'GPT Background Text', 'gpt-news-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$widget->add_control( 'add_background_text', [
			'label'        => esc_html__( 'Add Background Text?', 'gpt-news-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'On', 'gpt-news-core' ),
			'label_off'    => esc_html__( 'Off', 'gpt-news-core' ),
			'return_value' => 'add-background-text',
			'prefix_class' => 'gpt-',
		] );

		$widget->add_control( 'background_text', [
			'label'       => esc_html__( 'Background Text', 'gpt-news-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'label_block' => true,
			'default'     => esc_html__( 'Text', 'gpt-news-core' ),
			'selectors'   => [
				'{{WRAPPER}}.gpt-add-background-text:before' => 'content:"{{VALUE}}"',
				'{{WRAPPER}} .gpt-background-text'           => 'content:"{{VALUE}}"',
			],
			'condition'   => [
				'add_background_text' => 'add-background-text',
			],
		] );

		$widget->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'background_text_typo',
			'selector'  => '{{WRAPPER}}.gpt-add-background-text:before, {{WRAPPER}} .gpt-background-text',
			'condition' => [
				'add_background_text' => 'add-background-text',
			],
		] );

		$widget->add_responsive_control( 'background_text_indent', [
			'label'      => esc_html__( 'Text Indent', 'gpt-news-core' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'vw' ],
			'selectors'  => [
				'{{WRAPPER}}.gpt-add-background-text:before'          => 'margin-left: calc({{SIZE}}{{UNIT}} / 2);',
				'{{WRAPPER}} .gpt-background-text .letter:last-child' => 'margin-right: -{{SIZE}}{{UNIT}};',
			],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 250,
				],
				'vw' => [
					'min' => 0,
					'max' => 30,
				],
			],
			'default'    => [
				'unit' => 'vw',
				'size' => 8.9,
			],
			'condition'  => [
				'add_background_text' => 'add-background-text',
			],
		] );

		$widget->add_control( 'background_text_color', [
			'label'     => esc_html__( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#f1f1f1',
			'selectors' => [
				'{{WRAPPER}}.gpt-add-background-text:before' => 'color: {{VALUE}};',
				'{{WRAPPER}} .gpt-background-text'           => 'color: {{VALUE}};',
			],
			'condition' => [
				'add_background_text' => 'add-background-text',
			],
		] );

		$widget->add_responsive_control( 'background_text_spacing', [
			'label'     => esc_html__( 'Top Spacing', 'gpt-news-core' ),
			'type'      => Controls_Manager::SLIDER,
			'selectors' => [
				'{{WRAPPER}}.gpt-add-background-text:before' => 'margin-top: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .gpt-background-text'           => 'margin-top: {{SIZE}}{{UNIT}};',
			],
			'range'     => [
				'px' => [
					'min' => - 100,
					'max' => 400,
				],
			],
			'default'   => [
				'unit' => 'px',
				'size' => 0,
			],
			'condition' => [
				'add_background_text' => 'add-background-text',
			],
		] );

		$widget->add_control( 'apply_animation_background_text', [
			'label'        => esc_html__( 'Apply Animation?', 'gpt-news-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'On', 'gpt-news-core' ),
			'label_off'    => esc_html__( 'Off', 'gpt-news-core' ),
			'return_value' => 'animation-background-text',
			'default'      => 'animation-background-text',
			'prefix_class' => 'gpt-',
			'condition'    => [
				'add_background_text' => 'add-background-text',
			],
		] );

		$widget->end_controls_section();

		$widget->start_controls_section( 'extened_parallax', [
			'label' => esc_html__( 'GPT Parallax', 'gpt-news-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$widget->add_control( 'add_background_animation', [
			'label'        => esc_html__( 'Add Extended Background Animation?', 'gpt-news-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'On', 'gpt-news-core' ),
			'label_off'    => esc_html__( 'Off', 'gpt-news-core' ),
			'return_value' => 'yes',
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'image_effect', [
			'label'   => esc_html__( 'Parallax Effect', 'gpt-news-core' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'scroll'        => esc_html__( 'Scroll', 'gpt-news-core' ),
				'mouse'         => esc_html__( 'Mouse', 'gpt-news-core' ),
				'css_animation' => esc_html__( 'CSS Animation', 'gpt-news-core' ),
			],
			'default' => 'scroll',
		] );

		$repeater->add_responsive_control( 'animation_name', [
			'label'     => esc_html__( 'Animation', 'gpt-news-core' ),
			'type'      => Controls_Manager::SELECT2,
			'default'   => 'fadeIn',
			'options'   => [
				'bounce'             => 'bounce',
				'flash'              => 'flash',
				'pulse'              => 'pulse',
				'rubberBand'         => 'rubberBand',
				'shake'              => 'shake',
				'swing'              => 'swing',
				'tada'               => 'tada',
				'wobble'             => 'wobble',
				'jello'              => 'jello',
				'bounceIn'           => 'bounceIn',
				'bounceInDown'       => 'bounceInDown',
				'bounceInUp'         => 'bounceInUp',
				'bounceOut'          => 'bounceOut',
				'bounceOutDown'      => 'bounceOutDown',
				'bounceOutLeft'      => 'bounceOutLeft',
				'bounceOutRight'     => 'bounceOutRight',
				'bounceOutUp'        => 'bounceOutUp',
				'fadeIn'             => 'fadeIn',
				'fadeInDown'         => 'fadeInDown',
				'fadeInDownBig'      => 'fadeInDownBig',
				'fadeInLeft'         => 'fadeInLeft',
				'fadeInLeftBig'      => 'fadeInLeftBig',
				'fadeInRightBig'     => 'fadeInRightBig',
				'fadeInUp'           => 'fadeInUp',
				'fadeInUpBig'        => 'fadeInUpBig',
				'fadeOut'            => 'fadeOut',
				'fadeOutDown'        => 'fadeOutDown',
				'fadeOutDownBig'     => 'fadeOutDownBig',
				'fadeOutLeft'        => 'fadeOutLeft',
				'fadeOutLeftBig'     => 'fadeOutLeftBig',
				'fadeOutRightBig'    => 'fadeOutRightBig',
				'fadeOutUp'          => 'fadeOutUp',
				'fadeOutUpBig'       => 'fadeOutUpBig',
				'flip'               => 'flip',
				'flipInX'            => 'flipInX',
				'flipInY'            => 'flipInY',
				'flipOutX'           => 'flipOutX',
				'flipOutY'           => 'flipOutY',
				'lightSpeedIn'       => 'lightSpeedIn',
				'lightSpeedOut'      => 'lightSpeedOut',
				'rotateIn'           => 'rotateIn',
				'rotateInDownLeft'   => 'rotateInDownLeft',
				'rotateInDownRight'  => 'rotateInDownRight',
				'rotateInUpLeft'     => 'rotateInUpLeft',
				'rotateInUpRight'    => 'rotateInUpRight',
				'rotateOut'          => 'rotateOut',
				'rotateOutDownLeft'  => 'rotateOutDownLeft',
				'rotateOutDownRight' => 'rotateOutDownRight',
				'rotateOutUpLeft'    => 'rotateOutUpLeft',
				'rotateOutUpRight'   => 'rotateOutUpRight',
				'slideInUp'          => 'slideInUp',
				'slideInDown'        => 'slideInDown',
				'slideInLeft'        => 'slideInLeft',
				'slideInRight'       => 'slideInRight',
				'slideOutUp'         => 'slideOutUp',
				'slideOutDown'       => 'slideOutDown',
				'slideOutLeft'       => 'slideOutLeft',
				'slideOutRight'      => 'slideOutRight',
				'zoomIn'             => 'zoomIn',
				'zoomInDown'         => 'zoomInDown',
				'zoomInLeft'         => 'zoomInLeft',
				'zoomInRight'        => 'zoomInRight',
				'zoomInUp'           => 'zoomInUp',
				'zoomOut'            => 'zoomOut',
				'zoomOutDown'        => 'zoomOutDown',
				'zoomOutLeft'        => 'zoomOutLeft',
				'zoomOutUp'          => 'zoomOutUp',
				'hinge'              => 'hinge',
				'rollIn'             => 'rollIn',
				'rollOut'            => 'rollOut',
			],
			'condition' => [
				'image_effect' => 'css_animation',
			],
		] );
		$repeater->add_control( 'animation_name_iteration_count', [
			'label'     => esc_html__( 'Animation Iteration Count', 'gpt-news-core' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => '1',
			'options'   => [
				'infinite' => esc_html__( 'Infinite', 'gpt-news-core' ),
				'1'        => esc_html__( '1', 'gpt-news-core' ),
			],
			'condition' => [
				'image_effect' => 'css_animation',
			],
			'selectors' => [
				'{{WRAPPER}} {{CURRENT_ITEM}}' => 'animation-iteration-count:{{UNIT}}',
			],
		] );
		$repeater->add_control( 'animation_name_speed', [
			'label'     => esc_html__( 'Animation speed', 'gpt-news-core' ),
			'type'      => Controls_Manager::NUMBER,
			'min'       => 1,
			'step'      => 100,
			'default'   => '1',
			'condition' => [
				'image_effect' => 'css_animation',
			],
			'selectors' => [
				'{{WRAPPER}} {{CURRENT_ITEM}}' => 'animation-duration:{{UNIT}}s',
			],
		] );
		$repeater->add_control( 'animation_name_direction', [
			'label'     => esc_html__( 'Animation Direction', 'gpt-news-core' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'normal',
			'options'   => [
				'normal'    => esc_html__( 'Normal', 'gpt-news-core' ),
				'reverse'   => esc_html__( 'Reverse', 'gpt-news-core' ),
				'alternate' => esc_html__( 'Alternate', 'gpt-news-core' ),
			],
			'condition' => [
				'image_effect' => 'css_animation',
			],
			'selectors' => [
				"{{WRAPPER}} {{CURRENT_ITEM}}" => 'animation-direction:{{UNIT}}',
			],
		] );
		$repeater->add_control( 'image_bg', [
			'label'       => esc_html__( 'Parallax Image', 'gpt-news-core' ),
			'type'        => Controls_Manager::MEDIA,
			'label_block' => true,
			'default'     => [
				'url' => '',
			],
		] );


		$repeater->add_control( 'parallax_dir', [
			'label'     => esc_html__( 'Parallax Direction', 'gpt-news-core' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'vertical'   => esc_html__( 'Vertical', 'gpt-news-core' ),
				'horizontal' => esc_html__( 'Horizontal', 'gpt-news-core' ),
			],
			'condition' => [
				'image_effect' => 'scroll',
			],
			'default'   => 'vertical',
		] );

		$repeater->add_control( 'parallax_factor', [
			'label'       => esc_html__( 'Parallax Factor', 'gpt-news-core' ),
			'type'        => Controls_Manager::NUMBER,
			'min'         => - 3,
			'max'         => 3,
			'step'        => 0.01,
			'default'     => 0.03,
			'description' => esc_html__( 'Set elements offset and speed. It can be positive (0.3) or negative (-0.3). Less means slower.', 'gpt-news-core' ),
		] );

		$repeater->add_responsive_control( 'position_top', [
			'label'       => esc_html__( 'Top Offset', 'gpt-news-core' ),
			'type'        => Controls_Manager::SLIDER,
			'size_units'  => [ '%', 'px' ],
			'range'       => [
				'%'  => [ 'min' => - 100, 'max' => 100 ],
				'px' => [ 'min' => - 200, 'max' => 1000, 'step' => 5 ],
			],
			'default'     => [ 'size' => 0, 'unit' => '%' ],
			'description' => esc_html__( 'Set figure vertical offset from top border.', 'gpt-news-core' ),
			'selectors'   => [
				"{{WRAPPER}} {{CURRENT_ITEM}}" => 'top: {{SIZE}}{{UNIT}}',
			],
		] );

		$repeater->add_responsive_control( 'position_left', [
			'label'       => esc_html__( 'Left Offset', 'gpt-news-core' ),
			'type'        => Controls_Manager::SLIDER,
			'size_units'  => [ '%', 'px' ],
			'range'       => [
				'%'  => [
					'min' => - 100,
					'max' => 100,
				],
				'px' => [
					'min'  => - 200,
					'max'  => 1000,
					'step' => 5,
				],
			],
			'default'     => [
				'unit' => '%',
				'size' => 0,
			],
			'description' => esc_html__( 'Set figure horizontal offset from left border.', 'gpt-news-core' ),
			'selectors'   => [
				"{{WRAPPER}} {{CURRENT_ITEM}}" => 'left: {{SIZE}}{{UNIT}}',
			],
		] );

		$repeater->add_control( 'image_index', [
			'label'     => esc_html__( 'Image z-index', 'gpt-news-core' ),
			'type'      => Controls_Manager::NUMBER,
			'step'      => 1,
			'default'   => - 1,
			'selectors' => [
				"{{WRAPPER}} {{CURRENT_ITEM}}" => 'z-index: {{UNIT}}',
			],
		] );

		$repeater->add_control( 'hide_on_mobile', [
			'label'        => esc_html__( 'Hide On Mobile?', 'gpt-news-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'On', 'gpt-news-core' ),
			'label_off'    => esc_html__( 'Off', 'gpt-news-core' ),
			'return_value' => 'yes',
		] );
		$repeater->add_control( 'hide_mobile_resolution', [
			'label'     => esc_html__( 'Screen Resolution', 'gpt-news-core' ),
			'type'      => Controls_Manager::NUMBER,
			'step'      => 1,
			'default'   => 768,
			'condition' => [
				'hide_on_mobile' => 'yes',
			],
		] );

		$widget->add_control( 'items_parallax', [
			'label'     => esc_html__( 'Layers', 'gpt-news-core' ),
			'type'      => Controls_Manager::REPEATER,
			'condition' => [
				'add_background_animation' => 'yes',
			],
			'fields'    => $repeater->get_controls(),
		] );

		$widget->end_controls_section();

		$widget->start_controls_section( 'extened_shape', [
			'label' => esc_html__( 'GPT Shape Divider', 'gpt-news-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$widget->start_controls_tabs( 'tabs_gpt_shape_dividers' );

		$shapes_options = [
			''          => esc_html__( 'None', 'gpt-news-core' ),
			'torn_line' => esc_html__( 'Torn Line', 'gpt-news-core' ),
		];

		foreach (
			[
				'top'    => esc_html__( 'Top', 'gpt-news-core' ),
				'bottom' => esc_html__( 'Bottom', 'gpt-news-core' ),
			] as $side => $side_label
		) {
			$base_control_key = "gpt_shape_divider_$side";

			$widget->start_controls_tab( "tab_$base_control_key", [
				'label' => $side_label,
			] );

			$widget->add_control( $base_control_key, [
				'label'   => esc_html__( 'Type', 'gpt-news-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $shapes_options,
			] );


			$widget->add_control( $base_control_key . '_color', [
				'label'     => esc_html__( 'Color', 'gpt-news-core' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					"gpt_shape_divider_$side!" => '',
				],
				'selectors' => [
					"{{WRAPPER}} > .gpt-elementor-shape-$side path" => 'fill: {{UNIT}};',
				],
			] );

			$widget->add_responsive_control( $base_control_key . '_height', [
				'label'     => esc_html__( 'Height', 'gpt-news-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 500,
					],
				],
				'condition' => [
					"gpt_shape_divider_$side!" => '',
				],
				'selectors' => [
					"{{WRAPPER}} > .gpt-elementor-shape-$side svg" => 'height: {{SIZE}}{{UNIT}};',
				],
			] );

			$widget->add_control( $base_control_key . '_flip', [
				'label'     => __( 'Flip', 'gpt-news-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					"{{WRAPPER}} > .gpt-elementor-shape-$side svg" => 'transform: translateX(-50%) rotateY(180deg)',
				],
				'condition' => [
					"gpt_shape_divider_$side!" => '',
				],
			] );

			$widget->add_control( $base_control_key . '_invert', [
				'label'     => __( 'Invert', 'gpt-news-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					"{{WRAPPER}} > .gpt-elementor-shape-$side" => 'transform: rotate(180deg)',
				],
				'condition' => [
					"gpt_shape_divider_$side!" => '',
				],
			] );

			$widget->add_control( $base_control_key . '_above_content', [
				'label'     => esc_html__( 'Z-index', 'gpt-news-core' ),
				'type'      => Controls_Manager::NUMBER,
				'step'      => 1,
				'default'   => 0,
				'selectors' => [
					"{{WRAPPER}} > .gpt-elementor-shape-$side" => 'z-index: {{UNIT}}',
				],
				'condition' => [
					"gpt_shape_divider_$side!" => '',
				],
			] );

			$widget->end_controls_tab();
		}

		$widget->end_controls_tabs();
		$widget->end_controls_section();
	}

	public function extends_column_params( $widget, $args ) {

		$widget->start_controls_section( 'extened_header', [
			'label' => esc_html__( 'GPT Column Options', 'gpt-news-core' ),
			'tab'   => Controls_Manager::TAB_LAYOUT,
		] );

		$widget->add_control( 'apply_sticky_column', [
			'label'        => esc_html__( 'Enable Sticky?', 'gpt-news-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'On', 'gpt-news-core' ),
			'label_off'    => esc_html__( 'Off', 'gpt-news-core' ),
			'return_value' => 'sidebar',
			'prefix_class' => 'sticky-',
		] );

		$widget->end_controls_section();

	}
}