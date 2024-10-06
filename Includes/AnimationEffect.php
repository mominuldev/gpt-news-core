<?php

namespace GpTheme\GptNewsCore;

use Elementor\Element_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;

defined( 'ABSPATH' ) || die();

/**
 * Test Effects extension class.
 */
class AnimationEffect {

	public static function init() {

		//ping area controls
		add_action( 'elementor/element/section/section_advanced/after_section_end', [
			__CLASS__,
			'register_ping_area_controls'
		] );

		add_action( 'elementor/element/container/section_layout/after_section_end', [
			__CLASS__,
			'register_ping_area_controls'
		] );

		//popup controls
//		add_action( 'elementor/element/container/section_layout/after_section_end', [
//			__CLASS__,
//			'register_popup_controls'
//		] );

		//animation controls
		add_action( 'elementor/element/common/_section_style/after_section_end', [
			__CLASS__,
			'register_animation_controls',
		] );

		add_action( 'elementor/element/container/section_layout/after_section_end', [
			__CLASS__,
			'register_animation_controls'
		] );

		$image_elements = [
			[
				'name'    => 'image',
				'section' => 'section_image',
			],
			[
				'name'    => 'wcf--image',
				'section' => 'section_content',
			],
		];
		foreach ( $image_elements as $element ) {
			add_action( 'elementor/element/' . $element['name'] . '/' . $element['section'] . '/after_section_end', [
				__CLASS__,
				'register_image_animation_controls',
			], 10, 2 );
		}

		//image reveal
		$image_reveal_elements = [
			[
				'name'    => 'wcf--image-box',
				'section' => 'section_button_content',
			],
			[
				'name'    => 'wcf--timeline',
				'section' => 'section_timeline',
			],
		];
		foreach ( $image_reveal_elements as $element ) {
			add_action( 'elementor/element/' . $element['name'] . '/' . $element['section'] . '/after_section_end', [
				__CLASS__,
				'register_image_reveal_animation_controls',
			], 10, 2 );
		}

		$text_elements = [
			[
				'name'    => 'heading',
				'section' => 'section_title',
			],
			[
				'name'    => 'text-editor',
				'section' => 'section_editor',
			],
			[
				'name'    => 'gpt-heading',
				'section' => 'section_content',
			],
			[
				'name'    => 'gpt-list',
				'section' => 'section_content',
			],
		];
		foreach ( $text_elements as $element ) {
			add_action( 'elementor/element/' . $element['name'] . '/' . $element['section'] . '/after_section_end', [
				__CLASS__,
				'register_text_animation_controls',
			], 10, 2 );
		}

		add_action( 'elementor/frontend/widget/before_render', [ __CLASS__, 'wcf_attributes' ] );
		add_action( 'elementor/frontend/container/before_render', [ __CLASS__, 'wcf_attributes' ] );

		add_action( 'elementor/preview/enqueue_scripts', [ __CLASS__, 'enqueue_scripts' ] );
	}

	public static function enqueue_scripts() {

	}

	/**
	 * Set attributes based extension settings
	 *
	 * @param  Element_Base  $section
	 *
	 * @return void
	 */
	public static function wcf_attributes( $element ) {
		if ( ! empty( $element->get_settings( 'wcf_enable_scroll_smoother' ) ) ) {
			$attributes = [];

			if ( ! empty( $element->get_settings( 'data-speed' ) ) ) {
				$attributes['data-speed'] = $element->get_settings( 'data-speed' );
			}
			if ( ! empty( $element->get_settings( 'data-lag' ) ) ) {
				$attributes['data-lag'] = $element->get_settings( 'data-lag' );
			}

			$element->add_render_attribute( '_wrapper', $attributes );
		}
	}

	public static function register_animation_controls( $element ) {
		$element->start_controls_section(
			'_section_wcf_animation',
			[
				'label' => sprintf( '%s <i class="wcf-logo"></i>', __( 'Animation', 'wcf-addons' ) ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->add_control(
			'wcf-animation',
			[
				'label'              => esc_html__( 'Animation', 'wcf-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'none',
				'separator'          => 'before',
				'options'            => [
					'none' => esc_html__( 'none', 'wcf-addons' ),
					'fade' => esc_html__( 'fade animation', 'wcf-addons' ),
				],
				'render_type'        => 'template',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'delay',
			[
				'label'              => esc_html__( 'Delay', 'wcf-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 0,
				'max'                => 10,
				'step'               => 0.1,
				'default'            => 0.15,
				'condition'          => [
					'wcf-animation!' => 'none',
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'on-scroll',
			[
				'label'              => esc_html__( 'Animation on scroll', 'wcf-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Yes', 'wcf-addons' ),
				'label_off'          => esc_html__( 'No', 'wcf-addons' ),
				'return_value'       => 1,
				'default'            => 1,
				'frontend_available' => true,
				'condition'          => [
					'wcf-animation!' => 'none',
				],
			]
		);

		$element->add_control(
			'fade-from',
			[
				'label'              => esc_html__( 'Fade from', 'wcf-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'top',
				'options'            => [
					'top'    => esc_html__( 'Top', 'wcf-addons' ),
					'bottom' => esc_html__( 'Bottom', 'wcf-addons' ),
					'left'   => esc_html__( 'Left', 'wcf-addons' ),
					'right'  => esc_html__( 'Right', 'wcf-addons' ),
					'in'     => esc_html__( 'In', 'wcf-addons' ),
				],
				'frontend_available' => true,
				'condition'          => [
					'wcf-animation!' => 'none',
				],
			]
		);

		$element->add_control(
			'data-duration',
			[
				'label'              => esc_html__( 'Duration', 'wcf-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 1.15,
				'condition'          => [
					'wcf-animation!' => 'none',
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'ease',
			[
				'label'              => esc_html__( 'Ease', 'wcf-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'power2.out',
				'options'            => [
					'power2.out' => esc_html__( 'Power2.out', 'wcf-addons' ),
					'bounce'     => esc_html__( 'Bounce', 'wcf-addons' ),
					'back'       => esc_html__( 'Back', 'wcf-addons' ),
					'elastic'    => esc_html__( 'Elastic', 'wcf-addons' ),
					'slowmo'     => esc_html__( 'Slowmo', 'wcf-addons' ),
					'stepped'    => esc_html__( 'Stepped', 'wcf-addons' ),
					'sine'       => esc_html__( 'Sine', 'wcf-addons' ),
					'expo'       => esc_html__( 'Expo', 'wcf-addons' ),
				],
				'condition'          => [
					'wcf-animation!' => 'none',
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'fade-offset',
			[
				'label'              => esc_html__( 'Fade offset', 'wcf-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 50,
				'condition'          => [
					'wcf-animation!' => 'none',
				],
				'frontend_available' => true,
			]
		);

		$dropdown_options = [
			'' => esc_html__( 'All', 'wcf-addons' ),
		];

		foreach ( Plugin::$instance->breakpoints->get_active_breakpoints() as $breakpoint_key => $breakpoint_instance ) {

			$dropdown_options[ $breakpoint_key ] = sprintf(
			/* translators: 1: Breakpoint label, 2: `>` character, 3: Breakpoint value. */
				esc_html__( '%1$s (%2$dpx)', 'wcf-addons' ),
				$breakpoint_instance->get_label(),
				$breakpoint_instance->get_value()
			);
		}

		$element->add_control(
			'fade_animation_breakpoint',
			[
				'label'              => esc_html__( 'Breakpoint', 'wcf-addons' ),
				'type'               => Controls_Manager::SELECT,
				'description'        => esc_html__( 'Note: Choose at which breakpoint animation will work.', 'wcf-addons' ),
				'options'            => $dropdown_options,
				'frontend_available' => true,
				'default'            => 'mobile',
				'condition'          => [
					'wcf-animation!' => 'none',
				],
			]
		);

		$element->add_control(
			'fade_breakpoint_min_max',
			[
				'label'              => esc_html__( 'Breakpoint Min/Max', 'wcf-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'min',
				'options'            => [
					'min' => esc_html__( 'Min(>)', 'wcf-addons' ),
					'max' => esc_html__( 'Max(<)', 'wcf-addons' ),
				],
				'frontend_available' => true,
				'condition'          => [
					'wcf-animation!'             => 'none',
					'fade_animation_breakpoint!' => '',
				],
			]
		);

		//smooth scroll animation
		$element->add_control(
			'wcf_enable_scroll_smoother',
			[
				'label'        => esc_html__( 'Enable Scroll Smoother', 'wcf-addons' ),
				'description'  => esc_html__( 'If you want to use scroll smooth, please enable global settings first', 'wcf-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'wcf-addons' ),
				'label_off'    => esc_html__( 'No', 'wcf-addons' ),
				'return_value' => 'yes',
				'separator'    => 'before',
			]
		);

		$element->add_control(
			'data-speed',
			[
				'label'     => esc_html__( 'Speed', 'wcf-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 0.9,
				'condition' => [ 'wcf_enable_scroll_smoother' => 'yes' ],
			]
		);

		$element->add_control(
			'data-lag',
			[
				'label'     => esc_html__( 'Lag', 'wcf-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 0,
				'condition' => [ 'wcf_enable_scroll_smoother' => 'yes' ],
			]
		);

		$element->end_controls_section();
	}

	public static function register_image_animation_controls( $element ) {
		$element->start_controls_section(
			'_section_wcf_image_animation',
			[
				'label' => sprintf( '%s <i class="wcf-logo"></i>', __( 'Image Animation', 'wcf-addons' ) ),
			]
		);

		$element->add_control(
			'wcf-image-animation',
			[
				'label'              => esc_html__( 'Animation', 'wcf-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'none',
				'separator'          => 'before',
				'options'            => [
					'none'    => esc_html__( 'none', 'wcf-addons' ),
					'reveal'  => esc_html__( 'Reveal', 'wcf-addons' ),
					'scale'   => esc_html__( 'Scale', 'wcf-addons' ),
					'stretch' => esc_html__( 'Stretch', 'wcf-addons' ),
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'wcf-scale-start',
			[
				'label'              => esc_html__( 'Start Scale', 'wcf-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 0.7,
				'condition'          => [ 'wcf-image-animation' => 'scale' ],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'wcf-scale-end',
			[
				'label'              => esc_html__( 'End Scale', 'wcf-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 1,
				'condition'          => [ 'wcf-image-animation' => 'scale' ],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'wcf-animation-start',
			[
				'label'              => esc_html__( 'Animation Start', 'wcf-addons' ),
				'description'        => esc_html__( 'First value is element position, Second value is display position', 'wcf-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'top top',
				'frontend_available' => true,
				'render_type'        => 'template',
				'options'            => [
					'top top'       => esc_html__( 'Top Top', 'wcf-addons' ),
					'top center'    => esc_html__( 'Top Center', 'wcf-addons' ),
					'top bottom'    => esc_html__( 'Top Bottom', 'wcf-addons' ),
					'center top'    => esc_html__( 'Center Top', 'wcf-addons' ),
					'center center' => esc_html__( 'Center Center', 'wcf-addons' ),
					'center bottom' => esc_html__( 'Center Bottom', 'wcf-addons' ),
					'bottom top'    => esc_html__( 'Bottom Top', 'wcf-addons' ),
					'bottom center' => esc_html__( 'Bottom Center', 'wcf-addons' ),
					'bottom bottom' => esc_html__( 'Bottom Bottom', 'wcf-addons' ),
					'custom'        => esc_html__( 'Custom', 'wcf-addons' ),
				],
				'condition'          => [ 'wcf-image-animation' => 'scale' ],
			]
		);

		$element->add_control(
			'wcf_animation_custom_start',
			[
				'label'              => esc_html__( 'Custom', 'wcf-addons' ),
				'type'               => Controls_Manager::TEXT,
				'default'            => esc_html__( 'top 90%', 'wcf-addons' ),
				'placeholder'        => esc_html__( 'top 90%', 'wcf-addons' ),
				'render_type'        => 'template',
				'condition'          => [
					'wcf-image-animation' => 'scale',
					'wcf-animation-start' => 'custom'
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'image-ease',
			[
				'label'              => esc_html__( 'Data ease', 'wcf-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'power2.out',
				'options'            => [
					'power2.out' => esc_html__( 'Power2.out', 'wcf-addons' ),
					'bounce'     => esc_html__( 'Bounce', 'wcf-addons' ),
					'back'       => esc_html__( 'Back', 'wcf-addons' ),
					'elastic'    => esc_html__( 'Elastic', 'wcf-addons' ),
					'slowmo'     => esc_html__( 'Slowmo', 'wcf-addons' ),
					'stepped'    => esc_html__( 'Stepped', 'wcf-addons' ),
					'sine'       => esc_html__( 'Sine', 'wcf-addons' ),
					'expo'       => esc_html__( 'Expo', 'wcf-addons' ),
				],
				'condition'          => [ 'wcf-image-animation' => 'reveal' ],
				'frontend_available' => true,
			]
		);

		$element->end_controls_section();
	}

	public static function register_image_reveal_animation_controls( $element ) {
		$element->start_controls_section(
			'_section_wcf_image_animation',
			[
				'label' => sprintf( '%s <i class="wcf-logo"></i>', __( 'Image Animation', 'wcf-addons' ) ),
			]
		);

		$element->add_control(
			'wcf-image-animation',
			[
				'label'              => esc_html__( 'Animation', 'wcf-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'none',
				'separator'          => 'before',
				'options'            => [
					'none'   => esc_html__( 'none', 'wcf-addons' ),
					'reveal' => esc_html__( 'Reveal', 'wcf-addons' ),
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'image-ease',
			[
				'label'              => esc_html__( 'Data ease', 'wcf-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'power2.out',
				'options'            => [
					'power2.out' => esc_html__( 'Power2.out', 'wcf-addons' ),
					'bounce'     => esc_html__( 'Bounce', 'wcf-addons' ),
					'back'       => esc_html__( 'Back', 'wcf-addons' ),
					'elastic'    => esc_html__( 'Elastic', 'wcf-addons' ),
					'slowmo'     => esc_html__( 'Slowmo', 'wcf-addons' ),
					'stepped'    => esc_html__( 'Stepped', 'wcf-addons' ),
					'sine'       => esc_html__( 'Sine', 'wcf-addons' ),
					'expo'       => esc_html__( 'Expo', 'wcf-addons' ),
				],
				'condition'          => [ 'wcf-image-animation' => 'reveal' ],
				'frontend_available' => true,
			]
		);

		$element->end_controls_section();
	}

	public static function register_text_animation_controls( $element ) {
		$element->start_controls_section(
			'_section_wcf_text_animation',
			[
				'label' => sprintf( '%s <i class="wcf-logo"></i>', __( 'Text Animation', 'wcf-addons' ) ),
			]
		);

		$animation = [
			'none'        => esc_html__( 'none', 'wcf-addons' ),
			'char'        => esc_html__( 'Character', 'wcf-addons' ),
			'word'        => esc_html__( 'Word', 'wcf-addons' ),
			'text_move'   => esc_html__( 'Text Move', 'wcf-addons' ),
			'text_reveal' => esc_html__( 'Text Reveal', 'wcf-addons' ),
		];

		if ( in_array( $element->get_name(), [ 'heading', 'wcf--title' ] ) ) {
			$animation['text_invert'] = esc_html__( 'Text Invert', 'wcf-addons' );
		}

		$element->add_control(
			'wcf_text_animation',
			[
				'label'              => esc_html__( 'Animation', 'wcf-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'none',
				'separator'          => 'before',
				'options'            => $animation,
				'render_type'        => 'template',
				'prefix_class'       => 'wcf-t-animation-',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'text_delay',
			[
				'label'              => esc_html__( 'Delay', 'wcf-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 0,
				'max'                => 10,
				'step'               => 0.1,
				'default'            => 0.15,
				'condition'          => [
					'wcf_text_animation!' => 'none',
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'text_stagger',
			[
				'label'              => esc_html__( 'Stagger', 'wcf-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 0,
				'max'                => 10,
				'step'               => 0.01,
				'default'            => 0.02,
				'condition'          => [
					'wcf_text_animation' => [ 'char', 'word', 'text_reveal' ],
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'text_on_scroll',
			[
				'label'              => esc_html__( 'Animation on scroll', 'wcf-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Yes', 'wcf-addons' ),
				'label_off'          => esc_html__( 'No', 'wcf-addons' ),
				'return_value'       => 'yes',
				'default'            => 'yes',
				'condition'          => [
					'wcf_text_animation!' => 'none',
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'text_translate_x',
			[
				'label'              => esc_html__( 'Translate-X', 'wcf-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 20,
				'condition'          => [
					'wcf_text_animation' => [ 'char', 'word' ],
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'text_translate_y',
			[
				'label'              => esc_html__( 'Translate-Y', 'wcf-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 0,
				'condition'          => [
					'wcf_text_animation' => [ 'char', 'word' ],
				],
				'frontend_available' => true,
			]
		);

		$dropdown_options = [
			'' => esc_html__( 'All', 'wcf-addons' ),
		];

		foreach ( Plugin::$instance->breakpoints->get_active_breakpoints() as $breakpoint_key => $breakpoint_instance ) {

			$dropdown_options[ $breakpoint_key ] = sprintf(
			/* translators: 1: Breakpoint label, 2: `>` character, 3: Breakpoint value. */
				esc_html__( '%1$s (%2$dpx)', 'wcf-addons' ),
				$breakpoint_instance->get_label(),
				$breakpoint_instance->get_value()
			);
		}

		$element->add_control(
			'text_animation_breakpoint',
			[
				'label'              => esc_html__( 'Breakpoint', 'wcf-addons' ),
				'type'               => Controls_Manager::SELECT,
				'description'        => esc_html__( 'Note: Choose at which breakpoint animation will work.', 'wcf-addons' ),
				'options'            => $dropdown_options,
				'frontend_available' => true,
				'default'            => 'mobile',
				'condition'          => [
					'wcf_text_animation!' => 'none',
				],
			]
		);

		$element->add_control(
			'text_breakpoint_min_max',
			[
				'label'              => esc_html__( 'Breakpoint Min/Max', 'wcf-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'min',
				'options'            => [
					'min' => esc_html__( 'Min(>)', 'wcf-addons' ),
					'max' => esc_html__( 'Max(<)', 'wcf-addons' ),
				],
				'frontend_available' => true,
				'condition'          => [
					'wcf_text_animation!'        => 'none',
					'text_animation_breakpoint!' => '',
				],
			]
		);

		$element->end_controls_section();
	}

	public static function register_ping_area_controls( $element ) {
		$element->start_controls_section(
			'_section_pin-area',
			[
				'label' => sprintf( '%s <i class="wcf-logo"></i>', __( 'Pin Element', 'wcf-addons' ) ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->add_control(
			'wcf_enable_pin_area',
			[
				'label'              => esc_html__( 'Enable Pin', 'wcf-addons' ),
				'description'        => esc_html__( 'If you changed any options value, please reload the browser.', 'wcf-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'frontend_available' => true,
				'return_value'       => 'yes',
			]
		);

		$element->add_control(
			'wcf_pin_area_trigger',
			[
				'label'     => esc_html__( 'Pin Wrapper', 'wcf-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''       => esc_html__( 'Default', 'wcf-addons' ),
					'custom' => esc_html__( 'Custom', 'wcf-addons' ),
				],
				'condition' => [ 'wcf_enable_pin_area!' => '' ],
			]
		);

		$element->add_control(
			'wcf_custom_pin_area',
			[
				'label'              => esc_html__( 'Custom Pin Area', 'wcf-addons' ),
				'description'        => esc_html__( 'Add the section class where the element will be pin. please use the parent section or container class.',
					'wcf-addons' ),
				'type'               => Controls_Manager::TEXT,
				'ai'                 => false,
				'placeholder'        => esc_html__( '.pin_area', 'wcf-addons' ),
				'frontend_available' => true,
				'condition'          => [
					'wcf_pin_area_trigger' => 'custom',
					'wcf_enable_pin_area!' => '',
				]
			]
		);

		$element->add_control(
			'wcf_pin_area_start',
			[
				'label'              => esc_html__( 'Start', 'wcf-addons' ),
				'description'        => esc_html__( 'First value is element position, Second value is display position', 'wcf-addons' ),
				'type'               => Controls_Manager::SELECT,
				'separator'          => 'before',
				'default'            => 'top top',
				'frontend_available' => true,
				'options'            => [
					'top top'       => esc_html__( 'Top Top', 'wcf-addons' ),
					'top center'    => esc_html__( 'Top Center', 'wcf-addons' ),
					'top bottom'    => esc_html__( 'Top Bottom', 'wcf-addons' ),
					'center top'    => esc_html__( 'Center Top', 'wcf-addons' ),
					'center center' => esc_html__( 'Center Center', 'wcf-addons' ),
					'center bottom' => esc_html__( 'Center Bottom', 'wcf-addons' ),
					'bottom top'    => esc_html__( 'Bottom Top', 'wcf-addons' ),
					'bottom center' => esc_html__( 'Bottom Center', 'wcf-addons' ),
					'bottom bottom' => esc_html__( 'Bottom Bottom', 'wcf-addons' ),
					'custom'        => esc_html__( 'custom', 'wcf-addons' ),
				],
				'condition'          => [ 'wcf_enable_pin_area!' => '' ],
			]
		);

		$element->add_control(
			'wcf_pin_area_start_custom',
			[
				'label'              => esc_html__( 'Custom', 'wcf-addons' ),
				'type'               => Controls_Manager::TEXT,
				'default'            => esc_html__( 'top top', 'wcf-addons' ),
				'placeholder'        => esc_html__( 'top top+=100', 'wcf-addons' ),
				'frontend_available' => true,
				'condition'          => [
					'wcf_enable_pin_area!' => '',
					'wcf_pin_area_start'   => 'custom',
				],
			]
		);

		$element->add_control(
			'wcf_pin_area_end',
			[
				'label'              => esc_html__( 'End', 'wcf-addons' ),
				'description'        => esc_html__( 'First value is element position, Second value is display position', 'wcf-addons' ),
				'type'               => Controls_Manager::SELECT,
				'separator'          => 'before',
				'default'            => 'bottom top',
				'frontend_available' => true,
				'options'            => [
					'top top'       => esc_html__( 'Top Top', 'wcf-addons' ),
					'top center'    => esc_html__( 'Top Center', 'wcf-addons' ),
					'top bottom'    => esc_html__( 'Top Bottom', 'wcf-addons' ),
					'center top'    => esc_html__( 'Center Top', 'wcf-addons' ),
					'center center' => esc_html__( 'Center Center', 'wcf-addons' ),
					'center bottom' => esc_html__( 'Center Bottom', 'wcf-addons' ),
					'bottom top'    => esc_html__( 'Bottom Top', 'wcf-addons' ),
					'bottom center' => esc_html__( 'Bottom Center', 'wcf-addons' ),
					'bottom bottom' => esc_html__( 'Bottom Bottom', 'wcf-addons' ),
					'custom'        => esc_html__( 'custom', 'wcf-addons' ),
				],
				'condition'          => [ 'wcf_enable_pin_area!' => '' ],
			]
		);

		$element->add_control(
			'wcf_pin_area_end_custom',
			[
				'label'              => esc_html__( 'Custom', 'wcf-addons' ),
				'type'               => Controls_Manager::TEXT,
				'frontend_available' => true,
				'default'            => esc_html__( 'bottom top', 'wcf-addons' ),
				'placeholder'        => esc_html__( 'bottom top+=100', 'wcf-addons' ),
				'condition'          => [
					'wcf_enable_pin_area!' => '',
					'wcf_pin_area_end'     => 'custom',
				],
			]
		);

		$dropdown_options = [
			'' => esc_html__( 'None', 'wcf-addons' ),
		];

		$excluded_breakpoints = [
			'laptop',
			'tablet_extra',
			'widescreen',
		];

		foreach ( Plugin::$instance->breakpoints->get_active_breakpoints() as $breakpoint_key => $breakpoint_instance ) {
			// Exclude the larger breakpoints from the dropdown selector.
			if ( in_array( $breakpoint_key, $excluded_breakpoints, true ) ) {
				continue;
			}

			$dropdown_options[ $breakpoint_key ] = sprintf(
			/* translators: 1: Breakpoint label, 2: `>` character, 3: Breakpoint value. */
				esc_html__( '%1$s (%2$s %3$dpx)', 'wcf-addons' ),
				$breakpoint_instance->get_label(),
				'>',
				$breakpoint_instance->get_value()
			);
		}

		$element->add_control(
			'wcf_pin_breakpoint',
			[
				'label'              => esc_html__( 'Breakpoint', 'wcf-addons' ),
				'type'               => Controls_Manager::SELECT,
				'separator'          => 'before',
				'description'        => esc_html__( 'Note: Choose at which breakpoint Pin element will work.', 'wcf-addons' ),
				'options'            => $dropdown_options,
				'frontend_available' => true,
				'default'            => 'mobile',
			]
		);

		$element->end_controls_section();
	}

	public static function register_popup_controls( $element ) {
		$element->start_controls_section(
			'_section_wcf_popup_area',
			[
				'label' => sprintf( '%s <i class="wcf-logo"></i>', __( 'Popup', 'wcf-addons' ) ),
				'tab'   => Controls_Manager::TAB_LAYOUT,
			]
		);

		$element->add_control(
			'wcf_enable_popup',
			[
				'label'              => esc_html__( 'Enable Popup', 'wcf-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'frontend_available' => true,
				'return_value'       => 'yes',
			]
		);

		$element->add_control(
			'wcf_enable_popup_editor',
			[
				'label'              => esc_html__( 'Enable On Editor', 'wcf-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'frontend_available' => true,
				'return_value'       => 'yes',
				'condition'          => [ 'wcf_enable_popup!' => '' ]
			]
		);

		$element->add_control(
			'popup_content_type',
			[
				'label'     => esc_html__( 'Content Type', 'wcf-addons' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'content'  => esc_html__( 'Content', 'wcf-addons' ),
					'template' => esc_html__( 'Saved Templates', 'wcf-addons' ),
				],
				'default'   => 'content',
				'condition' => [ 'wcf_enable_popup!' => '' ]
			]
		);

		$element->add_control(
			'popup_elementor_templates',
			[
				'label'       => esc_html__( 'Save Template', 'wcf-addons' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => false,
				'multiple'    => false,
				'options'     => get_saved_template_list(),
				'condition'   => [
					'popup_content_type' => 'template',
					'wcf_enable_popup!'  => '',
				],
			]
		);

		$element->add_control(
			'popup_content',
			[
				'label'     => esc_html__( 'Content', 'wcf-addons' ),
				'default'   => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
					'wcf-addons' ),
				'type'      => Controls_Manager::WYSIWYG,
				'condition' => [
					'popup_content_type' => 'content',
					'wcf_enable_popup!'  => '',
				],
			]
		);

		$element->add_control(
			'popup_trigger_cursor',
			[
				'label'     => esc_html__( 'Cursor', 'wcf-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => [
					'default'  => esc_html__( 'Default', 'wcf-addons' ),
					'none'     => esc_html__( 'None', 'wcf-addons' ),
					'pointer'  => esc_html__( 'Pointer', 'wcf-addons' ),
					'grabbing' => esc_html__( 'Grabbing', 'wcf-addons' ),
					'move'     => esc_html__( 'Move', 'wcf-addons' ),
					'text'     => esc_html__( 'Text', 'wcf-addons' ),
				],
				'selectors' => [
					'{{WRAPPER}}' => 'cursor: {{VALUE}};',
				],
				'condition' => [ 'wcf_enable_popup!' => '' ],
			]
		);

		$element->add_control(
			'popup_animation',
			[
				'label'              => esc_html__( 'Animation', 'wcf-addons' ),
				'type'               => Controls_Manager::SELECT,
				'frontend_available' => true,
				'default'            => 'default',
				'options'            => [
					'default'             => esc_html__( 'Default', 'wcf-addons' ),
					'mfp-zoom-in'         => esc_html__( 'Zoom', 'wcf-addons' ),
					'mfp-zoom-out'        => esc_html__( 'Zoom-out', 'wcf-addons' ),
					'mfp-newspaper'       => esc_html__( 'Newspaper', 'wcf-addons' ),
					'mfp-move-horizontal' => esc_html__( 'Horizontal move', 'wcf-addons' ),
					'mfp-move-from-top'   => esc_html__( 'Move from top', 'wcf-addons' ),
					'mfp-3d-unfold'       => esc_html__( '3d unfold', 'wcf-addons' ),
				],
				'condition'          => [ 'wcf_enable_popup!' => '' ],
			]
		);

		$element->add_control(
			'popup_animation_delay',
			[
				'label'              => esc_html__( 'Removal Delay', 'wcf-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'frontend_available' => true,
				'default'            => 500,
				'condition'          => [ 'wcf_enable_popup!' => '' ],
			]
		);

		$element->end_controls_section();
	}

}

//AnimationEffect::init();
