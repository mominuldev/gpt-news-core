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

class Hero extends Widget_Base {

	use TextAnimation;

	/**
	 * Get widget name.
	 * Retrieve Hero widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'gpt-hero-static';
	}


	/**
	 * Get widget title.
	 * Retrieve Hero widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'GPT Hero', 'gpt-news-core' );
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
	 * Get button sizes.
	 * Retrieve an array of button sizes for the button widget.
	 * @return array An array containing button sizes.
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function get_button_sizes() {
		return [
			'btn-xs' => __( 'Extra Small', 'gpt-news-core' ),
			'btn-sm' => __( 'Small', 'gpt-news-core' ),
			'btn-md' => __( 'Medium', 'gpt-news-core' ),
			'btn-lg' => __( 'Large', 'gpt-news-core' ),
			'btn-xl' => __( 'Extra Large', 'gpt-news-core' ),
		];
	}

	/**
	 * Register Hero widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @since 1.0.0
	 * @access protected
	 */

	protected function register_controls() {

		$this->start_controls_section( 'section_hero', [
			'label' => __( 'General', 'gpt-news-core' ),
		] );

		// Layout
		$this->add_control( 'layout', [
			'label'   => __( 'Layout', 'gpt-news-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'one',
			'options' => [
				'one'   => __( 'Layout One', 'gpt-news-core' ),
				'two'   => __( 'Layout Two', 'gpt-news-core' ),
				'three' => __( 'Layout Three', 'gpt-news-core' ),
				'four'  => __( 'Layout Four', 'gpt-news-core' ),
				'five'  => __( 'Layout Five', 'gpt-news-core' ),
			],
		] );

		$this->end_controls_section();

		// Social Icons
		$this->start_controls_section( 'social_icons_section', [
			'label'     => esc_html__( 'Social Icons', 'gpt-news-core' ),
			'condition' => [
				'layout' => 'three',
			],
		] );

		$repeater = new Repeater();

		// Social Icon
		$repeater->add_control(
			'social_icon',
			[
				'label'       => esc_html__( 'Icon', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-brands' => [
						'facebook-f',
						'twitter',
						'linkedin-in',
						'instagram',
						'youtube',
						'pinterest-p',
						'google-plus-g',
						'vimeo-v',
						'dribbble',
						'behance',
						'github',
						'gitlab',
						'wordpress',
						'flickr',
						'500px',
						'vk',
						'weibo',
						'xing',
						'rss',
						'foursquare',
						'quora',
						'skype',
						'soundcloud',
						'spotify',
						'tumblr',
						'viber',
						'whatsapp',
						'wechat',
						'xing',
						'yahoo',
						'paypal',
						'odnoklassniki'
					],
				],
			]
		);

		// Social Link
		$repeater->add_control(
			'social_link', [
				'label'       => __( 'Link', 'gpt-news-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'gpt-news-core' ),
				'default'     => [
					'url' => '#',
				],
			]
		);

		// Social Title
		$repeater->add_control(
			'social_title', [
				'label'       => __( 'Title', 'gpt-news-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'social_icons', [
				'label'       => __( 'Social Icons', 'gpt-news-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'condition'   => [
					'layout' => 'three',
				],
				'default'     => [
					[
						'social_title' => __( 'Facebook', 'gpt-news-core' ),
						'social_icon'  => [
							'value'   => 'fab fa-facebook-f',
							'library' => 'fa-brands',
						],
					],
					[
						'social_title' => __( 'Twitter', 'gpt-news-core' ),
						'social_icon'  => [
							'value'   => 'fab fa-twitter',
							'library' => 'fa-brands',
						],
					],
					[
						'social_title' => __( 'Linkedin', 'gpt-news-core' ),
						'social_icon'  => [
							'value'   => 'fab fa-linkedin-in',
							'library' => 'fa-brands',
						],
					],
					[
						'social_title' => __( 'Instagram', 'gpt-news-core' ),
						'social_icon'  => [
							'value'   => 'fab fa-instagram',
							'library' => 'fa-brands',
						],
					],
				],
				'title_field' => '{{{ social_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( 'subtitle_section', [
			'label'     => esc_html__( 'Subtitle', 'gpt-news-core' ),
			'condition' => [
				'layout!' => 'four',
			],
		] );

		$this->add_control( 'subtitle', [
			'label'       => __( 'Sub Title', 'gpt-news-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'Hello There! 👋', 'gpt-news-core' ),
			'label_block' => true,
			'description' => __( "Type your title here.", 'gpt-news-core' ),
		] );

		$this->textAnimation('subtitle_');

		// Spacing
		$this->add_responsive_control(
			'subtitle_spacing',
			[
				'label' => __( 'Spacing', 'gpt-news-core' ),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banner__subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Title
		// =====================
		$this->start_controls_section( 'title_section', [
			'label'     => esc_html__( 'Title', 'gpt-news-core' ),
		] );

		$this->add_control( 'title', [
			'label'       => __( 'Title', 'gpt-news-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => __( "I'm GpTheme Islam", 'gpt-news-core' ),
			'label_block' => true,
			'rows'        => 2,
			'description' => __( "Type your title here.", 'gpt-news-core' ),
		] );


		$this->add_control( 'designation', [
			'label'       => __( 'Designation', 'gpt-news-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( "Full-Stack", 'gpt-news-core' ),
			'label_block' => true,
			'description' => __( "Type your title here.", 'gpt-news-core' ),
			'separator'   => 'before',
		] );

		$this->add_control( 'designation_secondary', [
			'label'       => __( 'Designation', 'gpt-news-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( "Developer", 'gpt-news-core' ),
			'label_block' => true,
			'description' => __( "Type your title here.", 'gpt-news-core' ),
		] );

		// Text Animation Controls call from TextAnimation Trait
		$this->textAnimation('title_');

		// Spacing
		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Spacing', 'gpt-news-core' ),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banner__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Designation
		// =====================
		$this->start_controls_section( 'designation_section', [
			'label'     => esc_html__( 'Designation', 'gpt-news-core' ),
			'condition' => [
				'layout' => ['one','four'],
			],
		] );

		$this->add_control( 'designation', [
			'label'       => __( 'Designation', 'gpt-news-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( "Full-Stack Developer", 'gpt-news-core' ),
			'label_block' => true,
			'description' => __( "Type your title here.", 'gpt-news-core' ),
		] );

		$this->textAnimation('designation_');

		// Spacing
//		$this->add_responsive_control(
//			'designation_spacing',
//			[
//				'label' => __( 'Spacing', 'gpt-news-core' ),
//				'type'  => Controls_Manager::SLIDER,
//				'size_units' => [ 'px', 'em', 'rem' ],
//				'range' => [
//					'px' => [
//						'min' => 0,
//						'max' => 100,
//					],
//				],
//				'selectors' => [
//					'{{WRAPPER}} .banner__designation' => 'margin-bottom: {{SIZE}}{{UNIT}};',
//				],
//			]
//		);

		$this->end_controls_section();

		// Location
		// =====================
		$this->start_controls_section( 'location_section', [
			'label'     => esc_html__( 'Location', 'gpt-news-core' ),
			'condition' => [
				'layout' => ['one','four', 'five'],
			],
		] );

		$this->add_control( 'location', [
			'label'       => __( 'Location', 'gpt-news-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( "Dhaka, Bangladesh", 'gpt-news-core' ),
			'label_block' => true,
			'description' => __( "Type your title here.", 'gpt-news-core' ),
		] );

		$this->textAnimation('location_');

		// Spacing

		$this->add_responsive_control(
			'location_spacing',
			[
				'label' => __( 'Spacing', 'gpt-news-core' ),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banner__location' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Availability
		// =====================
		$this->start_controls_section( 'availability_section', [
			'label'     => esc_html__( 'Availability', 'gpt-news-core' ),
			'condition' => [
				'layout' => ['one','four', 'five'],
			],
		] );

		$this->add_control( 'availability', [
			'label'       => __( 'Availability', 'gpt-news-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( "Available for a full-time position", 'gpt-news-core' ),
			'label_block' => true,
			'description' => __( "Type your title here.", 'gpt-news-core' ),
		] );

		$this->textAnimation('availability_');

		$this->end_controls_section();

		// Description
		// =====================

		$this->start_controls_section( 'description_section', [
			'label'     => esc_html__( 'Description', 'gpt-news-core' ),
			'condition' => [
				'layout!' => ['four'],
			],
		] );

		$this->add_control( 'description', [
			'label'       => __( 'Description', 'gpt-news-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => __( 'With 7 years of WordPress mastery, I create dynamic websites that blend innovation and functionality for a powerful online presence', 'gpt-news-core' ),
			'label_block' => true,
		] );

		$this->textAnimation('description_');

		// Spacing
		$this->add_responsive_control(
			'description_spacing',
			[
				'label' => __( 'Spacing', 'gpt-news-core' ),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banner__description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Buttons
		// =====================

		$this->start_controls_section( 'button_section', [
			'label'     => esc_html__( 'Button', 'gpt-news-core' ),
			'condition' => [
				'layout!' => ['four', 'five'],
			],
		] );

		$this->add_control(
			'button_size',
			[
				'label'   => __( 'Size', 'gpt-news-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-md',
				'options' => $this->get_button_sizes(),
			]
		);

		$this->add_control(
			'button_shape',
			[
				'label'   => __( 'Shape', 'gpt-news-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-circle',
				'options' => [
					'btn-square' => __( 'Square', 'gpt-news-core' ),
					'btn-round'  => __( 'Round', 'gpt-news-core' ),
					'btn-circle' => __( 'Circle', 'gpt-news-core' ),
				],
			]
		);


		// Control Tabs
		$this->start_controls_tabs( 'button_tabs' );

		// Primary Button
		$this->start_controls_tab( 'button_primary_tab', [
			'label' => esc_html__( 'Primary', 'gpt-news-core' ),
		] );

		$this->add_control( 'btn_text', [
			'label'       => __( 'Button Label', 'gpt-news-core' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Type your button label here', 'gpt-news-core' ),
			'default'     => __( 'Hire Me 👋', 'gpt-news-core' ),
			'label_block' => true
		] );

		$this->add_control( 'btn_link', [
			'label'       => __( 'Button Link', 'gpt-news-core' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => __( 'https://your-link.com', 'gpt-news-core' ),
			'default'     => [
				'url' => '#',
			],
		] );

		$this->add_control(
			'primary_button_style',
			[
				'label'   => __( 'Button Style', 'gpt-news-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-fill',
				'options' => [
					'btn-fill' => __( 'Default', 'gpt-news-core' ),
					'btn-outline' => __( 'Outline', 'gpt-news-core' ),
				],
			]
		);

		// Button Color
		$this->add_control(
			'primary_button_color',
			[
				'label'   => __( 'Fill Color', 'gpt-news-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-default',
				'options' => [
					'btn-default' => __( 'Light', 'gpt-news-core' ),
					'btn-light' => __( 'Light', 'gpt-news-core' ),
					'btn-dark'  => __( 'Dark', 'gpt-news-core' ),
				],
			]
		);

		$this->end_controls_tab();

		// Secondary Button
		$this->start_controls_tab( 'button_secondary_tab', [
			'label' => esc_html__( 'Secondary', 'gpt-news-core' ),
		] );

		$this->add_control( 'sec_btn_text', [
			'label'       => __( 'Button Label', 'gpt-news-core' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Type your button label here', 'gpt-news-core' ),
			'default'     => __( 'Download Resume', 'gpt-news-core' ),
			'label_block' => true
		] );

		$this->add_control( 'sec_btn_link', [
			'label'       => __( 'Button Link', 'gpt-news-core' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => __( 'https://your-link.com', 'gpt-news-core' ),
			'default' => [
				'url' => '',
				'is_external' => false,
				'nofollow' => true,
				 'custom_attributes' => '',
			],
		] );

		// Secondary Button Style
		$this->add_control(
			'secondary_button_style',
			[
				'label'   => __( 'Shape', 'gpt-news-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-link',
				'options' => [
					'btn-default' => __( 'Default', 'gpt-news-core' ),
					'btn-link' => __( 'Link', 'gpt-news-core' ),
					'btn-outline' => __( 'Outline', 'gpt-news-core' ),
				],
			]
		);

		$this->add_control(
			'secondary_button_color',
			[
				'label'   => __( 'Fill Color', 'gpt-news-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-dark',
				'options' => [
					'btn-light' => __( 'Light', 'gpt-news-core' ),
					'btn-dark'  => __( 'Dark', 'gpt-news-core' ),
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();


		// Counter
		// =====================

		$this->start_controls_section( 'banner_section', [
			'label'     => __( 'Counter', 'gpt-news-core' ),
			'tab'       => Controls_Manager::TAB_CONTENT,
			'condition' => [
				'layout!' => ['three', 'four', 'five'],
			],
		] );

		// Repeater
		$repeater = new Repeater();

		$repeater->add_control(
			'info_count',
			[
				'label'       => __( 'Count', 'gpt-news-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '13', 'gpt-news-core' ),
				'label_block' => true,
			]
		);

		// Suffix
		$repeater->add_control(
			'info_suffix',
			[
				'label'       => __( 'Suffix', 'gpt-news-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '+',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'info_title',
			[
				'label'       => __( 'Title', 'gpt-news-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '+',
				'label_block' => true,
			]
		);

		$this->add_control(
			'info_list',
			[
				'label'   => __( 'Info List', 'gpt-news-core' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'info_count'  => __( '8', 'gpt-news-core' ),
						'info_suffix' => __( '+', 'gpt-news-core' ),
						'info_title'  => __( 'Years Of Experience', 'gpt-news-core' ),
					],
					[
						'info_count'  => __( '100', 'gpt-news-core' ),
						'info_suffix' => __( '+', 'gpt-news-core' ),
						'info_title'  => __( 'Projects Completed', 'gpt-news-core' ),
					],
					[
						'info_count'  => __( '99', 'gpt-news-core' ),
						'info_suffix' => __( '%', 'gpt-news-core' ),
						'info_title'  => __( 'Client Satisfactions', 'gpt-news-core' ),
					],
				],
				'title_field' => '{{{ info_title }}}',
			]
		);


		$this->end_controls_section();

		// Feature Image
		// =====================
		$this->start_controls_section( 'feature_image_section', [
			'label'     => __( 'Feature Image', 'gpt-news-core' ),
			'tab'       => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control( 'feature_image', [
			'label'     => __( 'Choose Image', 'gpt-news-core' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => plugin_dir_url( __FILE__ ) . 'images/banner/mominul.png'
			],
			'condition' => [
				'layout' => 'one'
			]
		] );

		$this->add_control( 'feature_image_two', [
			'label'     => __( 'Choose Image', 'gpt-news-core' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => plugin_dir_url( __FILE__ ) . 'images/banner/me.png'
			],
			'condition' => [
				'layout' => ['two', 'three', 'four', 'five'],
			]
		] );


		$this->end_controls_section();

		// Banner Shape
		// =====================
		$this->start_controls_section( 'banner_shape_section', [
			'label'     => __( 'Banner Shape', 'gpt-news-core' ),
			'tab'       => Controls_Manager::TAB_CONTENT,
			'condition' => [
				'layout' => 'two'
			]
		] );

		$this->add_control( 'banner_shape_circle', [
			'label'   => __( 'Choose Circle Shape', 'gpt-news-core' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => plugin_dir_url( __FILE__ ) . 'images/banner/circle.png'
			]
		] );

		$this->add_control( 'banner_shape_cube', [
			'label'   => __( 'Choose Cube Shape', 'gpt-news-core' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => plugin_dir_url( __FILE__ ) . 'images/banner/cube.svg'
			]
		] );

		$this->end_controls_section();

		// Style Settings
		// =====================

		$this->start_controls_section( 'title_style', [
			'label' => __( 'Title', 'gpt-news-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => __( 'Typography', 'gpt-news-core' ),
			'selector' => '{{WRAPPER}} .banner__title',
		] );


		$this->add_control( 'title_color', [
			'label'     => __( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__title' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();

		// Subtitle Style
		// =====================
		$this->start_controls_section( 'subtitle_style_section', [
			'label' => __( 'Subtitle', 'gpt-news-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
//			'condition' => [
//				'layout' => ['one', 'two', 'three'],
//			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'subtitle_typography',
			'label'    => __( 'Typography', 'gpt-news-core' ),
			'selector' => '{{WRAPPER}} .banner__subtitle',
		] );

		$this->add_control( 'subtitle_color', [
			'label'     => __( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__subtitle' => 'color: {{VALUE}}',
			],
		] );

		// Spacing
		$this->add_responsive_control(
			'subtitle_spacing',
			[
				'label' => __( 'Spacing', 'gpt-news-core' ),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banner__subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Designation Style
		// =====================

		$this->start_controls_section( 'designation_style_section', [
			'label' => __( 'Designation', 'gpt-news-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
			'condition' => [
				'layout' => ['four', 'five'],
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'designation_typography',
			'label'    => __( 'Typography', 'gpt-news-core' ),
			'selector' => '{{WRAPPER}} .banner__designation',
		] );

		$this->add_control( 'designation_color', [
			'label'     => __( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__designation' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();


		// Description
		// =====================
		$this->start_controls_section( 'description_style_section', [
			'label' => __( 'Description', 'gpt-news-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,

		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'des_typography',
			'label'    => __( 'Typography', 'gpt-news-core' ),
			'selector' => '{{WRAPPER}} .banner__description',
		] );

		$this->add_control( 'des_color', [
			'label'     => __( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__description' => 'color: {{VALUE}}',
			],

		] );

		$this->end_controls_section();

		// Location
		// =====================

		$this->start_controls_section( 'location_style_section', [
			'label' => __( 'Location', 'gpt-news-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
			'condition' => [
				'layout' => 'four',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'location_typography',
			'label'    => __( 'Typography', 'gpt-news-core' ),
			'selector' => '{{WRAPPER}} .banner__location',
		] );

		$this->add_control( 'location_color', [
			'label'     => __( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__location' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();

		// Availability
		// =====================

		$this->start_controls_section( 'availability_style_section', [
			'label' => __( 'Availability', 'gpt-news-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
			'condition' => [
				'layout' => 'four',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'availability_typography',
			'label'    => __( 'Typography', 'gpt-news-core' ),
			'selector' => '{{WRAPPER}} .banner__availability',
		] );

		$this->add_control( 'availability_color', [
			'label'     => __( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__availability' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();


		// Button Style
		// =====================
		$this->start_controls_section( 'style_button', [
			'label' => __( 'Button', 'gpt-news-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab( 'tab_button_normal', [
			'label' => __( 'Normal', 'gpt-news-core' ),
		] );

		$this->add_control( 'button_text_color', [
			'label'     => __( 'Text Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .banner-btn' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'button_bg_color', [
			'label'     => __( 'Background Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner-btn' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'button_border',
				'label'    => __( 'Border', 'gpt-news-core' ),
				'selector' => '{{WRAPPER}} .banner-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'label'    => __( 'Box Shadow', 'gpt-news-core' ),
				'selector' => '{{WRAPPER}} .banner-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_button_hover', [
			'label' => __( 'Hover', 'gpt-news-core' ),
		] );

		$this->add_control( 'hover_color', [
			'label'     => __( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner-btn:hover' => 'color: {{VALUE}};',
			],

		] );

		$this->add_control( 'button_hover_bg_color', [
			'label'     => __( 'Background Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner-btn:hover' => 'background-color: {{VALUE}};',
			]
		] );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'button_hover_border',
				'label'    => __( 'Border', 'gpt-news-core' ),
				'selector' => '{{WRAPPER}} .banner-btn:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow_hover',
				'label'    => __( 'Box Shadow', 'gpt-news-core' ),
				'selector' => '{{WRAPPER}} .banner-btn',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'btn_typography',
			'label'     => __( 'Typography', 'gpt-news-core' ),
			'selector'  => '{{WRAPPER}} .banner-btn',
			'separator' => 'before'
		] );

		$this->add_control(
			'padding',
			[
				'label'      => __( 'Padding', 'gpt-news-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .banner-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border-radius',
			[
				'label'      => __( 'Border Radius', 'gpt-news-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .banner-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Background Settings
		// =====================
		$this->start_controls_section( 'style_background', [
			'label' => __( 'Background & Spacing', 'gpt-news-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'background',
			'label'    => __( 'Background', 'gpt-news-core' ),
			'types'    => [ 'classic', 'gradient', 'video' ],
			'selector' => '{{WRAPPER}} .banner',
		] );

		$this->add_responsive_control(
			'hero_padding',
			[
				'label'      => __( 'Padding', 'gpt-news-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		// Wrapper Classes
		// =====================
		$this->add_render_attribute( 'wrapper', 'class', 'banner' );

		if ( $settings['layout'] == 'one' ) {
			$this->add_render_attribute( 'wrapper', 'class', 'd-flex align-items-center' );
		}

		if ( ! empty( $settings['layout'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'banner--' . $settings['layout'] );
		}

		if ( ! empty( $settings['btn_link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['btn_link'] );
			$this->add_render_attribute( 'button', 'class', 'gpt-btn banner-btn btn-mr-2' );
			// Button Size
			if ( ! empty( $settings['button_size'] ) ) {
				$this->add_render_attribute( 'button', 'class', $settings['button_size'] );
			}

			// Button Shape
			if ( ! empty( $settings['button_shape'] ) ) {
				$this->add_render_attribute( 'button', 'class', $settings['button_shape'] );
			}

			// Button Style
			if ( ! empty( $settings['primary_button_style'] ) ) {
				$this->add_render_attribute( 'button', 'class', $settings['primary_button_style'] );
			}

			// Button Fill Color
			if ( ! empty( $settings['primary_button_color'] ) ) {
				$this->add_render_attribute( 'button', 'class', $settings['primary_button_color'] );
			}
		}


		// Secondary Button
		// =====================
		if ( ! empty( $settings['sec_btn_link']['url'] ) ) {
			$this->add_link_attributes( 'secondary_button', $settings['sec_btn_link'] );
			$this->add_render_attribute( 'secondary_button', 'class', 'btn-download' );

			// Button Size
			if ( ! empty( $settings['button_size'] ) ) {
				$this->add_render_attribute( 'secondary_button', 'class', $settings['button_size'] );
			}

			// Button Shape
			if ( ! empty( $settings['button_shape'] ) ) {
				$this->add_render_attribute( 'secondary_button', 'class', $settings['button_shape'] );
			}

			// Button Style
			if ( ! empty( $settings['secondary_button_style'] ) ) {
				$this->add_render_attribute( 'secondary_button', 'class',  $settings['secondary_button_style'] );
			}

			// Button Fill Color
			if ( ! empty( $settings['secondary_button_color'] ) ) {
				$this->add_render_attribute( 'secondary_button', 'class', $settings['secondary_button_color'] );
			}
		}

		$this->add_render_attribute( 'title', 'class', 'banner__title' );
		$this->add_render_attribute( 'subtitle', 'class', 'banner__subtitle' );
		$this->add_render_attribute( 'description', 'class', 'banner__description' );

		// Animation Text Type
		if ( ! empty( $settings['title_animation_text_type'] ) ) {
			$this->add_render_attribute( 'title', 'data-text', $settings['title_animation_text_type'] );
		}

		// perspective
		if ( ! empty( $settings['title_perspective'] ) ) {
			$this->add_render_attribute( 'title', 'data-perspective', $settings['title_perspective'] );
		}

		// Title Animation Style
		// =====================
		if ( ! empty( $settings['title_animation_style'] ) ) {
			$this->add_render_attribute( 'title', [
				'data-animation' => $settings['title_animation_style'],
			] );
		}

		// Subtitle Animation Style
		// =====================
		if ( ! empty( $settings['subtitle_animation_style'] ) ) {
			$this->add_render_attribute( 'subtitle', [
				'data-subanimation' => $settings['subtitle_animation_style'],
			] );
		}

		// perspective
		if ( ! empty( $settings['subtitle_perspective'] ) ) {
			$this->add_render_attribute( 'subtitle', 'data-perspective', $settings['subtitle_perspective'] );
		}

		// Description Animation Style

		if ( ! empty( $settings['description_animation_style'] ) ) {
			$this->add_render_attribute( 'description', [
				'data-desanimation' => $settings['description_animation_style'],
			] );
		}

		// perspective
		if ( ! empty( $settings['description_perspective'] ) ) {
			$this->add_render_attribute( 'description', 'data-perspective', $settings['description_perspective'] );
		}

//		$textAnimation = $this->textAnimation( $settings );
//		$json = str_replace('"','', (string) wp_json_encode( $textAnimation ) );
//		$this->add_render_attribute( 'title', 'data-anime', $json);

		require __DIR__ . '/templates/hero/layout-' . $settings['layout'] . '.php';

	}
}