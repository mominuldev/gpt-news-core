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

class FaqList extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve alert widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'gpt-faq-list';
	}


	public function get_title() {
		return __( 'Faq List', 'gpt-core' );
	}

	public function get_icon() {

		return 'eicon-text';
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
				'label' => __( 'Faq', 'gpt-core' ),
			]
		);


		$repeater = new Repeater();

		$repeater->add_control(
			'faq', [
				'label'       => __( 'Question', 'gpt-core' ),
				'type'        => Controls_Manager::TEXT,
				'plaseholder' => __( 'Enter question', 'gpt-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'answer', [
				'label'       => __( 'Answer', 'gpt-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'plaseholder' => __( 'Answer', 'gpt-core' ),
				'label_block' => true,
			]
		);


		$this->add_control(
			'faq_lists',
			[
				'label'       => __( 'Faq List', 'gpt-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'faq'    => __( 'How to learn digital marketing?', 'gpt-core' ),
						'answer' => __( 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.', 'gpt-core' ),
					],
					[
						'faq'    => __( 'Can I use the demos made by Ewebot?', 'gpt-core' ),
						'answer' => __( 'Why I say old chap that is spiffing pukka, bamboozled wind up bugger buggered zonked hanky panky a blinding shot the little rotter bubble and squeak vagabond cheeky', 'gpt-core' ),
					],
					[
						'faq'    => __( 'Why didn\'t you showcase my submission?', 'gpt-core' ),
						'answer' => __( 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.', 'gpt-core' ),
					],
				],
				'title_field' => '{{{ faq }}}',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'social_style_section',
			[
				'label' => __( 'Question', 'gpt-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'faq_color',
			[
				'label'     => __( 'Color', 'gpt-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-faq__title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'faq_typography',
				'label'    => __( 'Typography', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-faq__title',
			]
		);

		// Space
		$this->add_responsive_control(
			'faq_space',
			[
				'label'      => __( 'Space', 'gpt-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .gpt-faq__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'answer_style_section',
			[
				'label' => __( 'Answer', 'gpt-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ans_color',
			[
				'label'     => __( 'Faq Color', 'gpt-core' ),
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
				'label'    => __( 'Faq Typography', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-faq__content',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'faq_style_section',
			[
				'label' => __( 'Faq', 'gpt-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'faq_margin',
			[
				'label'      => __( 'Margin', 'gpt-core' ),
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
				'label'      => __( 'Padding', 'gpt-core' ),
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
				'label'     => __( 'Background Color', 'gpt-core' ),
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
				'label'    => __( 'Border', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-faq__item',
			]
		);

		$this->add_responsive_control(
			'faq_border_radius',
			[
				'label'      => __( 'Border Radius', 'gpt-core' ),
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


		if ( $settings['faq_lists'] ) { ?>
			<div class="gpt-faq">
				<?php foreach ( $settings['faq_lists'] as $item ) { ?>
					<div class="gpt-faq__item">
						<?php if ( ! empty( $item['faq'] ) ) : ?>
							<h4 class="gpt-faq__title"><?php echo $item['faq']; ?></h4>
						<?php endif; ?>

						<?php if ( ! empty( $item['answer'] ) ) : ?>
							<p class="gpt-faq__content"><?php echo $item['answer']; ?></p>
						<?php endif; ?>
					</div>
				<?php } ?>
			</div>
			<!-- /.gpt-faq -->
			<?php

		}
	}

}

