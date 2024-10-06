<?php

namespace GpTheme\GptNewsCore\Widgets;

use Elementor\{Controls_Manager, Group_Control_Border, Group_Control_Box_Shadow, Widget_Base, Group_Control_Typography, Repeater};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Class ContactInfo
 * @package GpTheme\GptNewsCore\Widgets
 */
class ContactInfo extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve Team widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'gpt-contact-info';
	}

	/**
	 * Get widget title.
	 * Retrieve Team widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'MPT Contact Info', 'gpt-core' );
	}

	/**
	 * Get widget icon.
	 * Retrieve Team widget icon.
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		return 'eicon-circle-o';
	}

	/**
	 * Get widget categories.
	 * Retrieve the list of categories the Team widget belongs to.
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
		return [ 'contact', 'gpt contact' ];
	}

	/**
	 * Register widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//============================================
		// START Contact Info
		//============================================
		$this->start_controls_section( 'team_content', [
			'label' => __( 'Contact Info', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );


		$this->add_control(
			'icon',
			[
				'label'   => esc_html__( 'Icon', 'textdomain' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value'   => 'far fa-envelope',
					'library' => 'fa-regular',
				],
			]
		);

		$this->add_control( 'contact_email', [
			'label'       => __( 'Contact Email', 'gpt-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'rows'        => 3,
			'placeholder' => __( 'Enter Contact Info', 'gpt-core' ),
			'default'     => __( 'hello@mominul.me', 'gpt-core' ),
			'label_block' => true,
		] );

		// URL
		$this->add_control( 'link', [
			'label'       => __( 'URL', 'gpt-core' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => __( 'Enter URL', 'gpt-core' ),
			'label_block' => true,
		] );

		// WhatsApp
		$this->add_control( 'whatsapp', [
			'label'       => __( 'WhatsApp', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter WhatsApp Number', 'gpt-core' ),
			'default'     => __( '+8801711022299', 'gpt-core' ),
			'label_block' => true,
		] );


		$this->end_controls_section();
		// End Contact Information
		// =====================

		//============================================
		// START TEAME STYLE
		//============================================

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
				'{{WRAPPER}} .gpt-contact__title' => 'color: {{VALUE}};',
			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'name_typography',
			'label'    => __( 'Typography', 'gpt-core' ),
			'selector' => '{{WRAPPER}} .gpt-contact__title',
		] );


		$this->end_controls_section();
		// End Name Style
		// =====================

		// Start Position Style
		// =====================
		$this->start_controls_section( 'position_style', [
			'label' => __( 'Contact Info', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'contact_email_color', [
			'label'     => __( 'Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-contact__info' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'position_typography',
			'label'    => __( 'Typography', 'gpt-core' ),
			'selector' => '{{WRAPPER}} .gpt-contact__info',
		] );

		$this->end_controls_section();
		// End Position Style
		// =====================

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
					'{{WRAPPER}} .gpt-contact__icon' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .gpt-contact__icon i'        => 'color: {{VALUE}};',
					'{{WRAPPER}} .gpt-contact__icon svg path' => 'fill: {{VALUE}};',
				],
			]
		);

		//Size
		$this->add_control(
			'icon_size',
			[
				'label'      => __( 'Icon Size', 'gpt-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px'  => [
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					],
					'em'  => [
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
				'selectors'  => [
					'{{WRAPPER}} .gpt-contact__icon'     => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gpt-contact__icon svg' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Padding Slider Control
		$this->add_control(
			'icon_padding',
			[
				'label'      => __( 'Padding', 'gpt-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px'  => [
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					],
					'em'  => [
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
				'selectors'  => [
					'{{WRAPPER}} .gpt-contact__icon' => 'padding: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .gpt-contact__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Contact Container Style Section
		// ================================

		$this->start_controls_section( 'contact_container_style', [
			'label' => __( 'Contact Container', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'team_bg_color', [
			'label'     => __( 'Background Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-contact' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'team_border',
				'label'    => __( 'Border', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-contact',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'team_box_shadow',
				'label'    => __( 'Box Shadow', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-contact',
			]
		);

		$this->add_control( 'team_padding', [
			'label'      => __( 'Padding', 'gpt-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .gpt-contact' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'team_border-radius', [
			'label'      => __( 'Border Radius', 'gpt-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .gpt-contact' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		// Link
		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'link', $settings['link'] );
		}

		?>
			<div class="gpt-contact">
				<div class="gpt-contact__email">
					<div class="gpt-contact__icon">
						<?php if ( ! empty( $settings['icon']['value'] ) ) : ?>
							<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
						<?php endif; ?>
					</div>
					<?php if ( ! empty( $settings['contact_email'] ) ) : ?>
						<div class="gpt-contact__title">
							<a href="mailto:<?php echo esc_html( $settings['contact_email'] ); ?>">
								<?php echo esc_html( $settings['contact_email'] ); ?>
							</a>
						</div>
					<?php endif; ?>
				</div>


				<?php if ( ! empty( $settings['whatsapp'] ) ) : ?>
					<div class="gpt-contact__whatsapp">
						<a href="https://wa.me/<?php echo esc_html( $settings['whatsapp'] ); ?>" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" width="34" height="36" viewBox="0 0 34 36" fill="none">
								<path d="M28.9758 5.92653C25.7787 2.74142 21.5257 0.986193 16.9992 0.984375C12.4829 0.984375 8.22308 2.73804 5.00499 5.92238C1.78119 9.11217 0.00415438 13.3512 0 17.8431V17.8483V17.8514C0.000519298 20.5702 0.714814 23.3129 2.0707 25.8164L0.0464772 35.0171L9.35308 32.9002C11.7102 34.0881 14.3402 34.7143 16.9927 34.7154H16.9995C21.515 34.7154 25.7748 32.9614 28.9934 29.7769C32.2201 26.5845 33.9979 22.3509 34 17.8561C34.0013 13.393 32.2173 9.15631 28.9758 5.92653ZM16.9992 32.0592H16.9932C14.6115 32.0581 12.2515 31.4602 10.1689 30.3294L9.72879 30.0905L3.54031 31.4981L4.88452 25.389L4.62539 24.9422C3.33701 22.7204 2.65621 20.2677 2.65621 17.8486C2.66114 10.0183 9.09473 3.64058 16.9987 3.64058C20.8171 3.64214 24.4049 5.1224 27.1011 7.80821C29.8381 10.5356 31.3448 14.1037 31.3435 17.8553C31.3404 25.6874 24.9055 32.0592 16.9992 32.0592Z" fill="#FFF7DC"/>
								<path d="M12.3736 10.4141H11.6284C11.369 10.4141 10.9478 10.5112 10.5916 10.8988C10.2351 11.2867 9.23053 12.2243 9.23053 14.1312C9.23053 16.0381 10.6241 17.8805 10.8183 18.1394C11.0128 18.398 13.5082 22.4361 17.4606 23.9896C20.7454 25.2805 21.414 25.0237 22.1268 24.9591C22.8398 24.8947 24.4275 24.0217 24.7516 23.1169C25.0756 22.212 25.0756 21.4362 24.9785 21.2741C24.8811 21.1126 24.6217 21.0158 24.233 20.8221C23.8441 20.6281 21.9383 19.6747 21.5818 19.5451C21.2253 19.4161 20.9661 19.3514 20.7068 19.7396C20.4474 20.127 19.6837 21.0233 19.4568 21.2819C19.2301 21.5408 19.0032 21.5733 18.6142 21.3793C18.2253 21.1848 16.9857 20.7683 15.5003 19.4483C14.3441 18.4209 13.5417 17.1107 13.3148 16.7228C13.0881 16.3351 13.2907 16.1253 13.4857 15.9319C13.6604 15.7584 13.8964 15.5211 14.0909 15.2949C14.2851 15.0685 14.3404 14.907 14.4702 14.6484C14.5998 14.3898 14.5349 14.1634 14.4378 13.9697C14.3404 13.7757 13.5942 11.8593 13.2483 11.0928H13.2486C12.9573 10.4473 12.6506 10.4255 12.3736 10.4141Z" fill="#FFF7DC"/>
							</svg>
						</a>
					</div>
				<?php endif; ?>
			</div>
		<?php
	}

}