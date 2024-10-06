<?php

namespace GpTheme\GptNewsCore\Widgets;

use Elementor\{Controls_Manager,
	Group_Control_Background,
	Group_Control_Border,
	Group_Control_Box_Shadow,
	Widget_Base,
	Group_Control_Typography,
	Repeater};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Class Team
 *
 * @package GpTheme\GptNewsCore\Widgets
 */

class Team extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Team widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'gpt-team';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Team widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'MPT Team', 'gpt-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Team widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-person';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Team widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'gpt-elements' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'Team', 'gpt member' ];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//============================================
		// START TEAME CONTENT
		//============================================
		$this->start_controls_section( 'team_content', [
			'label' => __( 'Team Member', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Style', 'gpt-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'one',
				'options' => [
					'one' => esc_html__( 'Style One', 'gpt-core' ),
					'two' => esc_html__( 'Style Two', 'gpt-core' ),
				]
			]
		);


		$this->add_control( 'name', [
			'label'       => __( 'Name', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Name', 'gpt-core' ),
			'default'     => __( 'Mashil Nanchy', 'gpt-core' ),
		] );

		$this->add_control( 'position', [
			'label'       => __( 'Position', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Position', 'gpt-core' ),
			'default'     => __('Web Designer', 'gpt-core'),
		] );

		$this->add_control( 'image', [
			'label'   => __( 'Choose Image', 'gpt-core' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => plugin_dir_url( __FILE__ ) . 'images/team1.jpg'
			],
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'icon', [
			'label' => __( 'Icon', 'gpt-core' ),
			'type'  => Controls_Manager::ICONS,
		] );

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'gpt-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'gpt-core' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
				],
			]
		);

		$repeater->add_control( 'social_name', [
			'label'       => __( 'Name', 'gpt-core' ),
			'description' => __( 'This name will be show in the item header', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => 'Facebook',
		] );

		$this->add_control( 'social_icons', [
			'label'       => __( 'Add Social Icon', 'gpt-core' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'icon'        => [
						'value'   => 'fab fa-facebook-f',
						'library' => 'solid',
					],
					'link'        => [
						'url' => '#',
					],
					'social_name' => __('Facebook', 'gpt-core'),
				],
				[
					'icon'        => [
						'value'   => 'fab fa-twitter',
						'library' => 'solid',
					],
					'link'        => [
						'url' => '#',
					],
					'social_name' => __('Twitter', 'gpt-core'),
				],
				[
					'icon'        => [
						'value'   => 'fab fa-linkedin-in',
						'library' => 'solid',
					],
					'link'        => [
						'url' => '#',
					],
					'social_name' => __('Linkedin', 'gpt-core'),
				],
				[
					'icon'        => [
						'value'   => 'fab fa-pinterest-p',
						'library' => 'solid',
					],
					'link'        => [
						'url' => '#',
					],
					'social_name' => __('Pinterest', 'gpt-core'),
				],

			],
			'title_field' => '{{{ social_name }}}',
		] );

		$this->end_controls_section();
		// End Team Content
		// =====================

		$this->start_controls_section( 'animation_effect', [
			'label' => __( 'Animation Effect', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		// Enable tilt Animation
		$this->add_control(
			'enable_tilt',
			[
				'label' => __( 'Enable Tilt', 'gpt-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Enable', 'gpt-core' ),
				'label_off' => __( 'Disable', 'gpt-core' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->end_controls_section();



		//============================================
		// START TEAME STYLE
		//============================================

		// Start Name Style
		// =====================
		$this->start_controls_section( 'name_style', [
			'label' => __( 'Name', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'name_color', [
			'label'     => __( 'Text Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-team__name' => 'color: {{VALUE}};',
			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'name_typography',
			'label'    => __( 'Typography', 'gpt-core' ),
			'selector' => '{{WRAPPER}} .gpt-team__name',
		] );


		$this->end_controls_section();
		// End Name Style
		// =====================

		// Start Position Style
		// =====================
		$this->start_controls_section( 'position_style', [
			'label' => __( 'Designation', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'position_color', [
			'label'     => __( 'Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-team__designation' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'position_typography',
			'label'    => __( 'Typography', 'gpt-core' ),
			'selector' => '{{WRAPPER}} .gpt-team__designation',
		] );

		$this->end_controls_section();
		// End Position Style
		// =====================


		// Start Description Style
		// =====================
		$this->start_controls_section( 'member_short_info', [
			'label' => __( 'Description', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'short_info_color', [
			'label'     => __( 'Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .team-member .member-short-info' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'short_info_typography',
			'label'    => __( 'Typography', 'gpt-core' ),
			'selector' => '{{WRAPPER}} .team-member .member-short-info',
		] );

		$this->end_controls_section();
		// End Position Style
		// =====================


		// Start Icon Style
		// =====================
		$this->start_controls_section( 'icon_style', [
			'label' => __( 'Social Icon', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'font_size', [
			'label'      => __( 'Font Size', 'gpt-core' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em' ],
			'default'    => [
				'unit' => 'px',
				'size' => '16',
			],
			'selectors'  => [
				'{{WRAPPER}} .gpt-team__social li a' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->start_controls_tabs( 'team_icon_tabs' );

		$this->start_controls_tab( 'team_icon_normal', [
			'label' => __( 'Normal', 'gpt-core' ),
		] );

		$this->add_control( 'team_icon_color', [
			'label'     => __( 'Icon Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-team__social li a' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'team_icon_hover', [
			'label' => __( 'Hover', 'gpt-core' ),
		] );

		$this->add_control( 'team_icon_hover_color', [
			'label'     => __( 'Icon Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-team__social li a:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		// Team Container Style Section
		// ================================

		$this->start_controls_section( 'team_container_style', [
			'label' => __( 'Team Container', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'team_wrapper_box_shadow',
				'label' => __( 'Box Shadow', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-team',
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_background',
				'label' => __( 'Background', 'gpt-core' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .gpt-team',
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'team_border',
				'label' => __( 'Border', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-team',
			]
		);

		$this->add_control( 'team_padding', [
			'label'      => __( 'Padding', 'gpt-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .gpt-team .gpt-team__info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'team_border-radius', [
			'label'      => __( 'Border Radius', 'gpt-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .gpt-team' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		// Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'team_box_shadow',
				'label' => __( 'Box Shadow', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-team',
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		// Wrapper attributes
		$this->add_render_attribute( 'wrapper', 'class', 'gpt-team' );
		if ( $settings['enable_tilt'] == 'yes' ) {
			$this->add_render_attribute( 'wrapper', 'data-tilt', );
		}

		// Style
		$this->add_render_attribute( 'wrapper', 'class', 'gpt-team--' . $settings['layout'] );

		require __DIR__ . '/templates/team/style-'.  $settings['layout'] .'.php';
	}

}