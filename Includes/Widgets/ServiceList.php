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
class ServiceList extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve Service widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'gpt-service-list';
	}

	/**
	 * Get widget title.
	 * Retrieve Service widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'MPT Service LIst', 'gpt-core' );
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

		// Repeater List
		$repeater = new Repeater();

		// Image
		$repeater->add_control( 'image', [
			'label'     => __( 'Choose Image', 'gpt-core' ),
			'type'      => Controls_Manager::MEDIA,
		] );

		// Title
		$repeater->add_control( 'title', [
			'label'       => __( 'Title', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Title', 'gpt-core' ),
			'default'     => __( 'Advertising and Scale', 'gpt-core' ),
			'label_block' => true,
		] );

		// Description
		$repeater->add_control( 'description', [
			'label'       => __( 'Description', 'gpt-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'placeholder' => __( 'Enter Description', 'gpt-core' ),
			'default'     => __( 'An effective business strategy provides clarity and direction', 'gpt-core' ),
		] );

		// Button Link
		$repeater->add_control( 'button_link', [
			'label'       => __( 'Button Link', 'gpt-core' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => __( 'https://your-link.com', 'gpt-core' ),
			'default'     => [
				'url' => '#'
			]
		] );

		$this->add_control('service_lists',
			[
				'label' => esc_html__('Service Lists', 'gpt-core'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => 'Mobile Development',
						'description' => 'An effective business strategy provides clarity and direction',
						'image' => [
							'url' => plugin_dir_url( __FILE__ ) . 'images/service-1.png'
						],
						'button_link' => [
							'url' => '#'
						]
					],
					[
						'title' => 'Business Strategy',
						'description' => 'An effective business strategy provides clarity and direction',
						'image' => [
							'url' => plugin_dir_url( __FILE__ ) . 'images/service-1.png'
						],
						'button_link' => [
							'url' => '#'
						]
					],
					[
						'title' => 'Digital Marketing',
						'description' => 'An effective business strategy provides clarity and direction',
						'image' => [
							'url' => plugin_dir_url( __FILE__ ) . 'images/service-1.png'
						],
						'button_link' => [
							'url' => '#'
						]
					],
					[
						'title' => 'Social Media',
						'description' => 'An effective business strategy provides clarity and direction',
						'image' => [
							'url' => plugin_dir_url( __FILE__ ) . 'images/service-1.png'
						],
						'button_link' => [
							'url' => '#'
						]
					],
					[
						'title' => 'Website Development',
						'description' => 'An effective business strategy provides clarity and direction',
						'image' => [
							'url' => plugin_dir_url( __FILE__ ) . 'images/service-1.png'
						],
						'button_link' => [
							'url' => '#'
						]
					],

				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();
		// End Service Content
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
				'{{WRAPPER}} .gpt-service-list__title' => 'color: {{VALUE}};',
			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => __( 'Typography', 'gpt-core' ),
			'selector' => '{{WRAPPER}} .gpt-service-list__title',
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
				'{{WRAPPER}} .gpt-service-list__arrow svg path' => 'fill: {{VALUE}};',
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
				'{{WRAPPER}} .gpt-service-list__btn' => 'color: {{VALUE}};',
			],
		] );

		// Hover Color
		$this->add_control( 'btn_hover_color', [
			'label'     => __( 'Hover Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-service-list__btn:hover' => 'color: {{VALUE}};',
			],
		] );

		// Background Color
		$this->add_control( 'btn_bg_color', [
			'label'     => __( 'Background Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-service-list__btn' => 'background-color: {{VALUE}};',
			],
		] );

		// Hover Background Color
		$this->add_control( 'btn_hover_bg_color', [
			'label'     => __( 'Hover Background Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-service-list__btn:hover' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'position_typography',
			'label'    => __( 'Typography', 'gpt-core' ),
			'selector' => '{{WRAPPER}} .gpt-service-list__btn',
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
				'{{WRAPPER}} .gpt-service-list__btn' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		// Icon Style
		// =====================
		$this->start_controls_section( 'icon_container_style', [
			'label' => __( 'Icon', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		// Icon Color
		$this->add_control( 'icon_color', [
			'label'     => __( 'Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-service-list__icon' => 'color: {{VALUE}};',
			],
		] );

		// Icon Hover Color
		$this->add_control( 'icon_hover_color', [
			'label'     => __( 'Hover Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-service-list__icon:hover' => 'color: {{VALUE}};',
			],
		] );

		// Icon Background Color
		$this->add_control( 'icon_bg_color', [
			'label'     => __( 'Background Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-service-list__icon' => 'background-color: {{VALUE}};',
			],
		] );

		// Icon Hover Background Color
		$this->add_control( 'icon_hover_bg_color', [
			'label'     => __( 'Hover Background Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-service-list__icon:hover' => 'background-color: {{VALUE}};',
			],
		] );

		// Height and Width
		$this->add_responsive_control( 'icon_size', [
			'label'      => __( 'Size', 'gpt-core' ),
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
				'{{WRAPPER}} .gpt-service-list__icon' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		// Padding slider control
		// Height and Width
		$this->add_responsive_control( 'icon_padding', [
			'label'     => __( 'Padding', 'gpt-core' ),
			'type'      => Controls_Manager::SLIDER,
			'selectors' => [
				'{{WRAPPER}} .gpt-service-list__icon' => 'padding: {{SIZE}}{{UNIT}};',
			],
		] );

		// Space Between Icon and Title
		$this->add_responsive_control( 'icon_title_space', [
			'label'     => __( 'Space Between Icon and Title', 'gpt-core' ),
			'type'      => Controls_Manager::SLIDER,
			'selectors' => [
				'{{WRAPPER}} .gpt-service-list__icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		] );

		// Icon Border Radius
		$this->add_responsive_control( 'icon_border_radius', [
			'label'      => __( 'Border Radius', 'gpt-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .gpt-service-list__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

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
				'selector' => '{{WRAPPER}} .gpt-service-list:not(.gpt-service-list--two)',
				'condition' => [
					'layout' => 'one',
				]
			]
		);

		// Hover Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'service_two_background',
				'label'    => __( 'Background Color', 'gpt-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .gpt-service-list:not(.gpt-service-list--one)',
				'condition' => [
					'layout' => 'two',
				]
			]
		);


		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'service_border',
				'label'    => __( 'Border', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-service-list:not(:hover)',
			]
		);

		// Hover Border Color
		$this->add_control( 'service_hover_border_color', [
			'label'     => __( 'Hover Border Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-service-list:hover' => 'border-color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'service_padding', [
			'label'      => __( 'Padding', 'gpt-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .gpt-service-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );


		$this->add_responsive_control( 'service_border-radius', [
			'label'      => __( 'Border Radius', 'gpt-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .gpt-service-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		// Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'service_box_shadow',
				'label'    => __( 'Box Shadow', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-service-list',
			]
		);

		// Hover Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'service_hover_box_shadow',
				'label'    => __( 'Hover Box Shadow', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-service-list:hover',
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		$ant = 0.3;
		$count = 0;

		// Wrapper attributes
		$this->add_render_attribute( 'wrapper', 'class', 'gpt-service-list wow fadeInUp' );
		$this->add_render_attribute( 'wrapper', 'data-wow-delay', $ant . 's' );

		// Style
		$this->add_render_attribute( 'wrapper', 'class', 'gpt-service-list--' . $settings['layout'] );

		if ( ! empty( $settings['service_lists'] ) ) {
//			$ant = 0.3;
			foreach ( $settings['service_lists'] as $item ) {
				require __DIR__ . '/templates/service/service-two.php';
				$ant = $ant + 0.2;
			}
		}
	}


}