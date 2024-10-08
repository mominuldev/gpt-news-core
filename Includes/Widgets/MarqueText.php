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

class MarqueText extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve alert widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'gpt-marquetext';
	}


	public function get_title() {
		return __( 'Marque Text', 'gpt-news-core' );
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
				'label' => __( 'Marque Content', 'gpt-news-core' ),
			]
		);


		$repeater = new Repeater();

		$repeater->add_control(
			'title', [
				'label'       => __( 'Text', 'gpt-news-core' ),
				'type'        => Controls_Manager::TEXT,
				'plaseholder' => __( 'Enter Text', 'gpt-news-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'marque_lists',
			[
				'label'       => __( 'Text list', 'gpt-news-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'title' => __( 'Digital Agency', 'gpt-news-core' ),
					],
					[
						'title' => __( 'Web Design', 'gpt-news-core' ),
					],
					[
						'title' => __( 'Product Design', 'gpt-news-core' ),
					],
					[
						'title' => __( 'Branding Design', 'gpt-news-core' ),
					],
					[
						'title' => __( 'Branding Service', 'gpt-news-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'social_style_section',
			[
				'label' => __( 'Content', 'gpt-news-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'faq_color',
			[
				'label'     => __( 'Color', 'gpt-news-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-marque__title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'faq_typography',
				'label'    => __( 'Typography', 'gpt-news-core' ),
				'selector' => '{{WRAPPER}} .gpt-marque__title',
			]
		);

		// Space
		$this->add_responsive_control(
			'faq_space',
			[
				'label'      => __( 'Space', 'gpt-news-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .gpt-marque__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'answer_style_section',
			[
				'label' => __( 'Answer', 'gpt-news-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ans_color',
			[
				'label'     => __( 'Faq Color', 'gpt-news-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-faq__content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'ans_typography',
				'label'    => __( 'Faq Typography', 'gpt-news-core' ),
				'selector' => '{{WRAPPER}} .gpt-faq__content',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'faq_style_section',
			[
				'label' => __( 'Faq', 'gpt-news-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'faq_margin',
			[
				'label'      => __( 'Margin', 'gpt-news-core' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .gpt-faq__item:not(:last-child)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'faq_padding',
			[
				'label'      => __( 'Padding', 'gpt-news-core' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .gpt-faq__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'faq_bg_color',
			[
				'label'     => __( 'Background Color', 'gpt-news-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-faq__item' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'faq_border',
				'label'    => __( 'Border', 'gpt-news-core' ),
				'selector' => '{{WRAPPER}} .gpt-faq__item',
			]
		);

		$this->add_responsive_control(
			'faq_border_radius',
			[
				'label'      => __( 'Border Radius', 'gpt-news-core' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .gpt-faq__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'faq_box_shadow',
				'selector' => '{{WRAPPER}} .gpt-faq__item',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();


		if ( $settings['marque_lists'] ) { ?>
			<div class="gpt-marque-wrapper">
				<ul class="gpt-faq__items">
					<?php foreach ( $settings['marque_lists'] as $item ) { ?>
						<?php if ( ! empty( $item['title'] ) ) : ?>
							<li class="gpt-marque__title"><?php echo $item['title']; ?></li>
						<?php endif; ?>
					<?php } ?>
				</ul>

				<ul class="gpt-faq__items" aria-hidden="true">
					<?php foreach ( $settings['marque_lists'] as $item ) { ?>
						<?php if ( ! empty( $item['title'] ) ) : ?>
							<li class="gpt-marque__title"><?php echo $item['title']; ?></li>
						<?php endif; ?>
					<?php } ?>
				</ul>
			</div>
			<!-- /.gpt-marque-wrapper -->
			<?php

		}
	}

}

