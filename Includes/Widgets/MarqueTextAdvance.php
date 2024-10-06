<?php

namespace GpTheme\GptNewsCore\Widgets;

use Elementor\{Controls_Manager,
	Widget_Base,
	Group_Control_Typography,
	Repeater
};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class MarqueTextAdvance extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve alert widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'gpt-marque-text-advance';
	}


	public function get_title() {
		return __( 'Marque Text Advance', 'gpt-core' );
	}

	public function get_icon() {

		return 'eicon-social-icons';
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

	protected function register_controls() {

		$this->start_controls_section(
			'faq_content',
			[
				'label' => __( 'Marque Content', 'gpt-core' ),
			]
		);

		// Style
		$this->add_control(
			'style',
			[
				'label'   => __( 'Style', 'gpt-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'one' => __( 'Big Text', 'gpt-core' ),
					'two'   => __( 'Small Text', 'gpt-core' ),
				],
				'default' => 'one',
			]
		);


		$repeater = new Repeater();

		$repeater->add_control(
			'title', [
				'label'       => __( 'Text', 'gpt-core' ),
				'type'        => Controls_Manager::TEXT,
				'plaseholder' => __( 'Enter Text', 'gpt-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'marque_lists',
			[
				'label'       => __( 'Text list', 'gpt-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'title' => __( 'Digital Agency', 'gpt-core' ),
					],
					[
						'title' => __( 'Web Design', 'gpt-core' ),
					],
					[
						'title' => __( 'Product Design', 'gpt-core' ),
					],
					[
						'title' => __( 'Branding Design', 'gpt-core' ),
					],
					[
						'title' => __( 'Branding Service', 'gpt-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);


		$this->end_controls_section();

		// Settings
		$this->start_controls_section(
			'settings_section',
			[
				'label' => __( 'Settings', 'gpt-core' ),
			]
		);

		// Direction
		$this->add_control(
			'direction',
			[
				'label'   => __( 'Direction', 'gpt-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'left'  => __( 'Right To Left', 'gpt-core' ),
					'right' => __( 'Left To Right', 'gpt-core' ),
				],
				'default' => 'left',
			]
		);

		// Duration
		$this->add_control(
			'duration',
			[
				'label'   => __( 'Duration', 'gpt-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 60,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'social_style_section',
			[
				'label' => __( 'Content', 'gpt-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'color',
			[
				'label'     => __( 'Color', 'gpt-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .marquee__text-part' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'    => __( 'Typography', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-marque__title',
			]
		);

		// Text Stroke width
		$this->add_responsive_control(
			'text_stroke_width',
			[
				'label'     => __( 'Text Stroke Width', 'gpt-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'default'   => 2,
				'selectors' => [
					'{{WRAPPER}} .marquee__text-part' => '-webkit-text-stroke-width: {{VALUE}}px; text-stroke-width: {{VALUE}}px;',
				],
			]
		);

		// Text Stroke Color
		$this->add_control(
			'text_stroke_color',
			[
				'label'     => __( 'Text Stroke Color', 'gpt-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .marquee__text-part' => '-webkit-text-stroke-color: {{VALUE}}; text-stroke-color: {{VALUE}};',
				],
			]
		);

		// Hover Stroke Color

		$this->add_control(
			'hover_stroke_color',
			[
				'label'     => __( 'Hover Color', 'gpt-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .marquee__text-part:before' => '-webkit-text-fill-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_stroke_color',
			[
				'label'     => __( 'Hover Stroke Color', 'gpt-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .marquee__text-part:hover' => '-webkit-text-stroke-color: {{VALUE}}; stroke: {{VALUE}}; -webkit-text-fill-color: {{VALUE}};',
				],
			]
		);


		// More Option Heading Control Field
		$this->add_control(
			'more_option_heading',
			[
				'label'     => __( 'More Option', 'gpt-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		// Svg Icon Width
		$this->add_responsive_control(
			'svg_icon_width',
			[
				'label'     => __( 'Svg Icon Width', 'gpt-core' ),
				'type'      => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .marquee__text-part .arrow svg' => 'width: {{VALUE}}px;',
				],

			]
		);

		// Svg Stroke Fill
		$this->add_control(
			'svg_stroke_fill',
			[
				'label'     => __( 'Svg Stroke Fill', 'gpt-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .marquee__text-part .arrow svg path' => 'fill: {{VALUE}}',
				],
			]
		);


		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// marquee__text-inner Class
		$this->add_render_attribute( 'marquee-inner', 'class', 'marquee__text-inner' );
		// Style
		$this->add_render_attribute( 'marquee-inner', 'class', 'style--' . $settings['style'] );

		// marquee__text-inner attribute
		$this->add_render_attribute( 'marquee-inner', 'data-initial-direction', $settings['direction'] );
		$this->add_render_attribute( 'marquee-inner', 'data-duration', $settings['duration'] );


		if ( $settings['marque_lists'] ) { ?>

			<div class="marquee-text">
				<div <?php echo $this->get_render_attribute_string('marquee-inner'); ?>>
					<?php foreach ( $settings['marque_lists'] as $item ) { ?>
						<div class="marquee__text-part" data-text="<?php echo esc_attr($item['title']) ?>">
							<?php if ( ! empty( $item['title'] ) ) : ?>
								<?php echo esc_html($item['title']); ?>
							<?php endif; ?>
							<span class="arrow">
								<?php if( $settings['style'] === 'one') : ?>
								<svg width="148" height="140" viewBox="0 0 148 140" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M43.2116 140L18.7872 122.257L49.1774 80.4185L0 64.4451L9.33076 35.776L58.5179 51.7108V0H88.705V51.7108L137.873 35.776L147.204 64.4934L98.0358 80.4185L128.426 122.257L103.963 140L73.6018 98.1711L43.2116 140ZM73.6018 94.8836L104.427 137.302L125.699 121.832L94.903 79.4033L144.777 63.2074L136.635 38.1642L86.7712 54.3698V1.93384H60.4517V54.3698L10.5684 38.1642L2.43663 63.2074L52.3102 79.4033L21.4849 121.832L42.7571 137.302L73.6018 94.8836Z" fill="#FFF7DC"/>
								</svg>
								<?php else : ?>
									<svg xmlns="http://www.w3.org/2000/svg" width="44" height="35" viewBox="0 0 44 35" fill="none">
										<path d="M26.8167 34.3626C25.9422 34.3626 25.0898 34.0875 24.3804 33.5761C23.6709 33.0648 23.1404 32.3432 22.8638 31.5136C22.5873 30.6839 22.5788 29.7883 22.8395 28.9536C23.1003 28.1188 23.6171 27.3873 24.3167 26.8626C26.675 25.1293 29.075 23.1876 31.1167 21.3626H4.16667C3.0616 21.3626 2.00179 20.9236 1.22039 20.1422C0.438987 19.3608 0 18.301 0 17.1959C0 16.0909 0.438987 15.0311 1.22039 14.2497C2.00179 13.4683 3.0616 13.0293 4.16667 13.0293H31.1417C29.1 11.2126 26.7 9.27094 24.3417 7.53761C23.9001 7.21302 23.5269 6.8045 23.2434 6.33546C22.96 5.86642 22.7718 5.34607 22.6898 4.8042C22.6077 4.26234 22.6334 3.70961 22.7652 3.17768C22.8971 2.64574 23.1327 2.14505 23.4583 1.70427C23.7823 1.26205 24.1903 0.888109 24.6591 0.603867C25.1278 0.319625 25.6481 0.130674 26.1899 0.0478411C26.7318 -0.0349917 27.2848 -0.0100777 27.817 0.121155C28.3493 0.252388 28.8504 0.48736 29.2917 0.812607C39.1833 8.09594 44 13.4459 44 17.1709C44 20.8959 39.1833 26.2543 29.2833 33.5543C28.5682 34.0795 27.704 34.3627 26.8167 34.3626ZM4.16667 14.6709C3.50363 14.6709 2.86774 14.9343 2.3989 15.4032C1.93006 15.872 1.66667 16.5079 1.66667 17.1709C1.66667 17.834 1.93006 18.4699 2.3989 18.9387C2.86774 19.4075 3.50363 19.6709 4.16667 19.6709H35.375L33.8583 21.1126C31.1585 23.6342 28.3118 25.9939 25.3333 28.1793C24.9077 28.4911 24.5917 28.9295 24.4305 29.4319C24.2692 29.9343 24.271 30.4747 24.4356 30.976C24.6003 31.4772 24.9192 31.9136 25.3469 32.2225C25.7746 32.5315 26.2891 32.6972 26.8167 32.6959C27.3472 32.6954 27.8637 32.5261 28.2917 32.2126C39.9 23.6626 42.3333 19.3209 42.3333 17.1709C42.3333 15.0209 39.9 10.6876 28.2917 2.17094C28.0326 1.9671 27.7358 1.81652 27.4183 1.72785C27.1008 1.63917 26.7689 1.61417 26.4417 1.65427C25.9447 1.72197 25.4796 1.93759 25.1068 2.2731C24.7339 2.60861 24.4707 3.0485 24.3511 3.5356C24.2316 4.02271 24.2614 4.53451 24.4365 5.00448C24.6117 5.47446 24.9242 5.88089 25.3333 6.17094C28.3138 8.35383 31.1606 10.7136 33.8583 13.2376L35.375 14.6709H4.16667Z" fill="#C7FF29"/>
									</svg>
								<?php endif; ?>
							</span>
						</div>
					<?php } ?>
				</div>
			</div>

			<?php

		}
	}

}

