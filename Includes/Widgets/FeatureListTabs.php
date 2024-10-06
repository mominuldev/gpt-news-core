<?php

namespace GpTheme\GptNewsCore\Widgets;

use Elementor\{Controls_Manager,
	Widget_Base,
	Group_Control_Typography,
	Repeater
};

if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

class FeatureListTabs extends Widget_Base
{

	/**
	 * Get widget name.
	 * Retrieve alert widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name()
	{
		return 'gpt-feature-list-tabs';
	}


	public function get_title()
	{
		return __('MPT Feature Tabs ', 'gpt-core');
	}

	public function get_icon()
	{

		return 'eicon-text';
	}

	/**
	 * Get widget categories.
	 * Retrieve the widget categories.
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories()
	{
		return ['gpt-elements'];
	}

	protected function register_controls()
	{

		$this->start_controls_section(
			'feature_content',
			[
				'label' => __('Tabs', 'gpt-core'),
			]
		);


		$repeater = new Repeater();

		$repeater->add_control(
			'icon',
			[
				'label'   => esc_html__('Icon', 'gpt-core'),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-circle',
					'library' => 'fa-solid',
				]
			]
		);


		$repeater->add_control(
			'feature_title', [
				'label'       => __('Title', 'gpt-core'),
				'type'        => Controls_Manager::TEXT,
				'plaseholder' => __('Title', 'gpt-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'description', [
				'label'       => __('Description', 'gpt-core'),
				'type'        => Controls_Manager::TEXTAREA,
				'plaseholder' => __('Description', 'gpt-core'),
				'label_block' => true,
			]
		);

		// Image
		$repeater->add_control(
			'image',
			[
				'label'   => __('Image', 'gpt-core'),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);


		$this->add_control(
			'feature_lists',
			[
				'label'       => __('Feature List', 'gpt-core'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'feature_title' => __("Marketing & Reporting", "gpt-core"),
						'description'   => __("In today's data-driven world, effective marketing.. ", "gpt-core"),
						'image'         => [
							'url' => plugin_dir_url(__FILE__).'images/tabs/tab-image-one.png',
						],
					],
					[
						'feature_title' => __("Creative Design", "gpt-core"),
						'description'   => __("Creative design is instrumental in creating a strong..", "gpt-core"),
						'image'         => [
							'url' => plugin_dir_url(__FILE__).'images/tabs/tab-image-two.png',
						],
					],
					[
						'feature_title' => __("SEO Friendly", "gpt-core"),
						'description'   => __("Optimizing your online content for search engines..", "gpt-core"),
						'image'         => [
							'url' => plugin_dir_url(__FILE__).'images/tabs/tab-image-three.png',
						],
					],
					[
						'feature_title' => __("24/7 Support", "gpt-core"),
						'description'   => __("By offering 24/7 support, businesses can address...", "gpt-core"),
						'image'         => [
							'url' => plugin_dir_url(__FILE__).'images/tabs/tab-image-four.png',
						],
					],
				],
				'title_field' => '{{{ feature_title }}}',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'title_style_section',
			[
				'label' => __('Title', 'gpt-core'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'feature_color',
			[
				'label'     => __('Color', 'gpt-core'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-feature__title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'feature_typography',
				'label'    => __('Typography', 'gpt-core'),
				'selector' => '{{WRAPPER}} .gpt-feature__title',
			]
		);

		// Space
		$this->add_responsive_control(
			'feature_space',
			[
				'label'      => __('Space', 'gpt-core'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .gpt-feature__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'description_style_section',
			[
				'label' => __('Description', 'gpt-core'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ans_color',
			[
				'label'     => __('Color', 'gpt-core'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-feature__content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'ans_typography',
				'label'    => __('Typography', 'gpt-core'),
				'selector' => '{{WRAPPER}} .gpt-feature__content',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'feature_style_section',
			[
				'label' => __('Feature Container', 'gpt-core'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'feature_margin',
			[
				'label'      => __('Margin', 'gpt-core'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .gpt-feature__item:not(:last-child)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'feature_padding',
			[
				'label'      => __('Padding', 'gpt-core'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .gpt-feature__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'feature_bg_color',
			[
				'label'     => __('Background Color', 'gpt-core'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-feature__item' => 'background-color: {{VALUE}}',
				],
			]
		);

		// Hover Background Color
		$this->add_control(
			'feature_hover_bg_color',
			[
				'label'     => __('Hover Background Color', 'gpt-core'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-feature__item:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'feature_icon_color',
			[
				'label'     => __('Icon Color', 'gpt-core'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-feature__item .gpt-feature__icon i'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .gpt-feature__item .gpt-feature__icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		// Hover Icon Color
		$this->add_control(
			'feature_hover_icon_color',
			[
				'label'     => __('Hover Icon Color', 'gpt-core'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-feature__item:hover .gpt-feature__icon i'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .gpt-feature__item:hover .gpt-feature__icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'feature_border',
				'label'    => __('Border', 'gpt-core'),
				'selector' => '{{WRAPPER}} .gpt-feature__item',
			]
		);

		$this->add_responsive_control(
			'feature_border_radius',
			[
				'label'      => __('Border Radius', 'gpt-core'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .gpt-feature__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'feature_box_shadow',
				'selector' => '{{WRAPPER}} .gpt-feature__item',
			]
		);

		$this->end_controls_section();

	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();


		if ($settings['feature_lists']) { ?>
			<div class="gpt-feature">
				<div class="row align-items-center">
					<div class="col-lg-6 gpt-order-md">
						<?php foreach ($settings['feature_lists'] as $index => $item) {
							$id_int = 'gpt-tabs-id-' . substr( $this->get_id_int(), 0, 3 );
							?>
							<div class="gpt-feature__item">
								<a href="#<?php echo esc_attr( $id_int . '-' . $index ); ?>">
									<?php if (!empty($item['icon'])) : ?>
										<div class="gpt-feature__icon">
											<?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
										</div>
									<?php endif; ?>

									<div class="gpt-feature__content">
										<?php if (!empty($item['feature_title'])) : ?>
											<h4 class="gpt-feature__title"><?php echo $item['feature_title']; ?></h4>
										<?php endif; ?>

										<?php if (!empty($item['description'])) : ?>
											<p class="gpt-feature__content"><?php echo $item['description']; ?></p>
										<?php endif; ?>
									</div>
								</a>
							</div>
						<?php } ?>
					</div>

					<div class="col-lg-6">
						<div class="gpt-feature__image-wrapper">
						<?php foreach ($settings['feature_lists'] as $index => $item) { ?>
							<div class="gpt-feature__image" id="<?php echo esc_attr( $id_int . '-' . $index ); ?>">
								<?php if (!empty($item['image']['url'])) : ?>
									<img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['feature_title']); ?>">
								<?php endif; ?>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<!-- /.gpt-feature -->
			<?php
		}
	}
}

