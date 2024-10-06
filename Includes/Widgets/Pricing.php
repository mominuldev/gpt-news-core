<?php

namespace GpTheme\GptNewsCore\Widgets;


if (!defined('ABSPATH')) {
	exit;
}

use Elementor\{Controls_Manager,
	Group_Control_Background,
	Widget_Base,
	Group_Control_Typography,
	Group_Control_Box_Shadow,
	Group_Control_Border
};

class Pricing extends Widget_Base
{

	public function get_name()
	{
		return 'gpt-pricing';
	}

	public function get_title()
	{
		return __('MPT Pricing', 'gpt-core');
	}

	public function get_icon()
	{
		return 'eicon-price-table';
	}

	public function get_categories()
	{
		return ['gpt-elements'];
	}

	protected function register_controls()
	{

		$this->start_controls_section('pricing', [
			'label' => __('Pricing', 'gpt-core'),
		]);

		$this->add_control('layout', [
			'type'    => Controls_Manager::SELECT,
			'label'   => __('Layout', 'gpt-core'),
			'default' => 'one',
			'options' => [
				'one'   => __('Style One', 'gpt-core'),
				'two'   => __('Style Two', 'gpt-core'),
				'three' => __('Style Three', 'gpt-core'),
			],
		]);

		$this->end_controls_section();

		$this->start_controls_section('pricing_plane', [
			'label' => __('Pricing Plans', 'gpt-core'),
			'tab'   => Controls_Manager::TAB_CONTENT,
		]);

		$this->add_control('featured_table', [
			'label'        => __('Do you want to feature it?', 'gpt-core'),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __('Yes', 'your-plugin'),
			'label_off'    => __('No', 'your-plugin'),
			'return_value' => 'yes',
			'default'      => 'no',
		]);

		$this->add_control('table_title', [
			'label'       => __('Pricing Title', 'gpt-core'),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => __('Standard', 'gpt-core')
		]);

		$this->add_control('table_subtitle', [
			'label'       => __('Pricing Sub Title', 'gpt-core'),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => __('Single User', 'gpt-core'),
			'condition'   => [
				'layout' => 'one'
			]
		]);

		$this->add_control('table_price', [
			'label'       => __('Price', 'gpt-core'),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => __('19.00', 'gpt-core')
		]);

		$this->add_control('currency', [
			'label'       => __('Currency', 'gpt-core'),
			'type'        => Controls_Manager::TEXT,
			'label_block' => false,
			'default'     => '$'
		]);

		$this->add_control('period', [
			'label' => __('Period', 'gpt-core'),
			'type'  => Controls_Manager::TEXT,
		]);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control('feature', [
			'label'       => __('Feature Title', 'gpt-core'),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'label_block' => true,
		]);

		$repeater->add_control('feature_before', [
			'label'   => __('Feature Before', 'gpt-core'),
			'type'    => Controls_Manager::SELECT,
			'default' => 'include',
			'options' => [
				'include' => __('Include', 'gpt-core'),
				'exclude' => __('Exclude', 'gpt-core'),
				'bullet'  => __('Bullet', 'gpt-core'),
			],
		]);

		$this->add_control('features', [
			'label'       => __('Repeater List', 'gpt-core'),
			'type'        => \Elementor\Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'feature' => __('50 MB Disk Space', 'gpt-core'),
				],
				[
					'feature' => __('2 Subdo Mains', 'gpt-core'),
				],
				[
					'feature' => __(' 6 Email Accounts', 'gpt-core'),
				],
				[
					'feature' => __('Analytics', 'gpt-core'),
				],
				[
					'feature' => __('Phone & Mail Support', 'gpt-core'),
				],
			],
			'title_field' => '{{{ feature }}}',
		]);

		$this->add_control('button_text', [
			'label'       => __('Button Text', 'gpt-core'),
			'type'        => Controls_Manager::TEXT,
			'default'     => __('Get Started', 'gpt-core'),
			'label_block' => true,
		]);

		$this->add_control('btn_url', [
			'label'       => __('Button URL', 'gpt-core'),
			'type'        => Controls_Manager::URL,
			'placeholder' => __('https://your-link.com', 'gpt-core'),
			'default'     => [
				'url' => '#',
			],
		]);

		$this->end_controls_section();


		/**
		 * Pricing Style
		 */
		$this->start_controls_section('section_title_style', [
			'label' => __('Pricing Header', 'gpt-core'),
			'tab'   => Controls_Manager::TAB_STYLE,
		]);

		$this->add_control('title_color', [
			'label'     => __('Title Color', 'gpt-core'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-pricing__title' => 'color: {{VALUE}};',
			],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => __('Typography', 'gpt-core'),
			'selector' => '{{WRAPPER}} .gpt-pricing__title',
		]);

		$this->add_responsive_control('title_space', [
			'label'     => esc_html__('Spacing', 'gpt-core'),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .gpt-pricing__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		]);

		$this->add_control('price_style', [
			'label'     => __('Price', 'gpt-core'),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		]);

		$this->add_control('price_color', [
			'label'     => __('Table Title Color', 'gpt-core'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-pricing__price-wrap' => 'color: {{VALUE}} !important;',
			],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
			'name'     => 'price_typography',
			'label'    => __('Typography', 'gpt-core'),
			'selector' => '{{WRAPPER}} .gpt-pricing__price-wrap',
		]);

		$this->add_control('period_color', [
			'label'     => __('Period Color', 'gpt-core'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-pricing__period' => 'color: {{VALUE}} !important;',
			],
			'separator' => 'before'
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
			'name'     => 'period_typography',
			'label'    => __('Period Typography', 'gpt-core'),
			'selector' => '{{WRAPPER}} .gpt-pricing__period',
		]);

		$this->end_controls_section();


		/**
		 * Feature Pricing Table Style
		 */
		$this->start_controls_section('section_fea_style', [
			'label' => __('Pricing Feature', 'gpt-core'),
			'tab'   => Controls_Manager::TAB_STYLE,
		]);

		$this->add_control('feature_color', [
			'label'     => __('Color', 'gpt-core'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-pricing__feature-list li' => 'color: {{VALUE}};',
			],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
			'name'     => 'feature_typography',
			'label'    => __('Typography', 'gpt-core'),
			'selector' => '{{WRAPPER}} .gpt-pricing__feature-list li',
		]);

		$this->add_control('bullet_color', [
			'label'     => __('Bullet Color', 'gpt-core'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .bullet' => 'background-color: {{VALUE}};',
			],
		]);

		$this->add_control('include_color', [
			'label'     => __('Include Icon Color', 'gpt-core'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .ei-icon_check' => 'color: {{VALUE}};',
			],
		]);


		$this->add_control('include_bg_color', [
			'label'     => __('Include BG Color', 'gpt-core'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-pricing__feature-list li i:not(.exclude)' => 'background: {{VALUE}};',
			],
			'condition' => [
				'layout' => 'three'
			]
		]);

		$this->add_control('exclude_color', [
			'label'     => __('Exclude Icon Color', 'gpt-core'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .ei-icon_close, {{WRAPPER}} .exclude.ei-icon_check' => 'color: {{VALUE}};',
			],
		]);

		$this->add_control('exclude_bg_color', [
			'label'     => __('Exclude BG Color', 'gpt-core'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .exclude.ei-icon_check' => 'background: {{VALUE}};',
			],
			'condition' => [
				'layout' => 'three'
			]
		]);

		$this->add_group_control(Group_Control_Box_Shadow::get_type(), [
			'name'     => 'table_box_shadow_fea',
			'label'    => __('Box Shadow Hover', 'gpt-core'),
			'selector' => '{{WRAPPER}} .single_pricing_plan.active:hover',
		]);

		$this->add_responsive_control('feature_space', [
			'label'     => esc_html__('Gap', 'gpt-core'),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 20,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .gpt-pricing__feature-list li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		]);

		$this->end_controls_section();

		// Button Style
		// =====================
		$this->start_controls_section('style_button', [
			'label' => __('Button', 'gpt-core'),
			'tab'   => Controls_Manager::TAB_STYLE,
		]);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab('tab_button_normal', [
			'label' => __('Normal', 'gpt-core'),
		]);

		$this->add_control('button_text_color', [
			'label'     => __('Text Color', 'gpt-core'),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .gpt-btn' => 'color: {{VALUE}};',
			],
		]);

		$this->add_control('button_bg_color', [
			'label'     => __('Background Color', 'gpt-core'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-btn, {{WRAPPER}} .gpt-btn.featured_btn' => 'background-color: {{VALUE}};',
			],
		]);

		$this->add_group_control(Group_Control_Border::get_type(), [
			'name'     => 'button_border',
			'label'    => __('Border', 'gpt-core'),
			'selector' => '{{WRAPPER}} .gpt-btn, {{WRAPPER}} .gpt-btn.featured_btn',
		]);

		$this->add_group_control(Group_Control_Box_Shadow::get_type(), [
			'name'     => 'button_box_shadow',
			'label'    => __('Box Shadow', 'gpt-core'),
			'selector' => '{{WRAPPER}} .gpt-btn, {{WRAPPER}} .gpt-btn.featured_btn',
		]);

		$this->end_controls_tab();

		$this->start_controls_tab('tab_button_hover', [
			'label' => __('Hover', 'gpt-core'),
		]);

		$this->add_control('hover_color', [
			'label'     => __('Color', 'gpt-core'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-btn:hover, {{WRAPPER}} .gpt-btn.featured_btn:hover' => 'color: {{VALUE}};',
			],
		]);

		$this->add_control('button_hover_bg_color', [
			'label'     => __('Background Color', 'gpt-core'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-btn:hover, {{WRAPPER}} .gpt-btn.featured_btn:hover' => 'background-color: {{VALUE}};',
			]
		]);

		$this->add_group_control(Group_Control_Border::get_type(), [
			'name'     => 'button_hover_border',
			'label'    => __('Border', 'gpt-core'),
			'selector' => '{{WRAPPER}} .gpt-btn:hover',
		]);

		$this->add_group_control(Group_Control_Box_Shadow::get_type(), [
			'name'     => 'button_box_shadow_hover',
			'label'    => __('Box Shadow', 'gpt-core'),
			'selector' => '{{WRAPPER}} .gpt-btn:hover, {{WRAPPER}} .gpt-btn.featured_btn:hover',
		]);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(Group_Control_Typography::get_type(), [
			'name'      => 'button_typography',
			'label'     => __('Typography', 'gpt-core'),
			'selector'  => '{{WRAPPER}} .gpt-btn',
			'separator' => 'before'
		]);

		$this->add_control('padding', [
			'label'      => __('Padding', 'gpt-core'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', '%', 'em'],
			'selectors'  => [
				'{{WRAPPER}} .gpt-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->add_control('border-radius', [
			'label'      => __('Border Radius', 'gpt-core'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', '%', 'em'],
			'selectors'  => [
				'{{WRAPPER}} .gpt-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->end_controls_section();


		$this->start_controls_section('style_pricing_box', [
			'label' => __('Pricing Box', 'gpt-core'),
			'tab'   => Controls_Manager::TAB_STYLE,
		]);

		$this->start_controls_tabs('tabs_pricing_style');

		$this->start_controls_tab('tab_pricing_normal', [
			'label' => __('Normal', 'gpt-core'),
		]);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'pricing_background',
				'label'    => __('Background', 'gpt-core'),
				'types'    => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .gpt-pricing',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'pricing_border',
				'selector' => '{{WRAPPER}} .gpt-pricing',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'pricing_box_shadow',
				'label'    => __('Box Shadow', 'gpt-core'),
				'selector' => '{{WRAPPER}} .gpt-pricing',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('tab_pricing_hover', [
			'label' => __('Hover', 'gpt-core'),
		]);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'pricing_background_hover',
				'label'    => __('Background', 'gpt-core'),
				'types'    => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .gpt-pricing:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'pricing_border_hover',
				'selector' => '{{WRAPPER}} .gpt-pricing:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'pricing_hover_box_shadow',
				'label'    => __('Box Shadow', 'gpt-core'),
				'selector' => '{{WRAPPER}} .gpt-pricing:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control('pricing_padding', [
			'label'      => __('Padding', 'gpt-core'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', '%', 'em'],
			'selectors'  => [
				'{{WRAPPER}} .gpt-pricing' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->add_control('pricing_border-radius', [
			'label'      => __('Border Radius', 'gpt-core'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', '%', 'em'],
			'selectors'  => [
				'{{WRAPPER}} .gpt-pricing' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings();

		$this->add_render_attribute('pricing', 'class', 'gpt-pricing');

		if (!empty($settings['layout'])) {
			$this->add_render_attribute('pricing', 'class', 'gpt-pricing-' . $settings['layout']);
		}

		if ($settings['featured_table'] == 'yes') {
			$this->add_render_attribute('pricing', 'class', 'gpt-pricing-featured');
		}

		?>
		<div <?php echo $this->get_render_attribute_string('pricing'); ?>>
			<div class="gpt-pricing__header">
				<?php if ($settings['layout'] == 'two' || $settings['layout'] == 'three') : ?>
					<?php if ($settings['table_title']): ?>
						<h2 class="gpt-pricing__title"><?php esc_html_e($settings['table_title']); ?></h2>
					<?php endif; ?>
				<?php endif; ?>

				<?php if ($settings['table_price']): ?>
					<h3 class="gpt-pricing__price">
						<?php if (!empty($settings['table_price'])): ?>
							<span class="gpt-pricing__price-wrap">
								<span class="currency"><?php esc_html_e($settings['currency']); ?></span>
								<span><?php esc_html_e($settings['table_price']); ?></span>
							</span>
						<?php endif; ?>
						<?php if ($settings['period']): ?>
							<span class="gpt-pricing__period"><?php esc_html_e($settings['period']); ?></span>
						<?php endif; ?>
					</h3>
				<?php endif; ?>

				<?php if ($settings['layout'] == 'one') : ?>
					<?php if ($settings['table_title']): ?>
						<h2 class="gpt-pricing__title"><?php esc_html_e($settings['table_title']); ?></h2>
					<?php endif; ?>

					<?php if ($settings['table_subtitle']): ?>
						<h5 class="gpt-pricing__subtitle"><?php esc_html_e($settings['table_subtitle']); ?></h5>
					<?php endif; ?>
				<?php endif; ?>

			</div>

			<div class="gpt-pricing__feature-lists">
				<ul class="gpt-pricing__feature-list">
					<?php foreach ($settings['features'] as $item) : ?>
						<li>
							<?php if ($item['feature_before'] == 'include') : ?>
								<i class="fa-solid fa-check"></i>
							<?php elseif ($item['feature_before'] == 'exclude'): ?>
								<?php if ($settings['layout'] == 'three') : ?>
									<i class="ex ei ei-icon_check exclude"></i>
								<?php else: ?>
									<i class="fa-solid fa-xmark"></i>
								<?php endif; ?>
							<?php elseif ($item['feature_before'] == 'bullet') : ?>
								<span class="bullet"></span>
							<?php endif; ?>
							<?php esc_html_e($item['feature']); ?>
						</li>
					<?php endforeach; ?>
				</ul>
				<!-- /.gpt-pricing__feature-list -->
			</div>
			<!-- /.gpt-pricing__feature-lists -->

			<?php if ($settings['btn_url']['url']) : ?>
				<div class="gpt-pricing__action">
					<a href="<?php echo esc_url($settings['btn_url']['url']); ?>"
					   class="gpt-btn <?php echo $settings['featured_table'] == 'yes' ? 'featured_btn' : 'btn-outline' ?> ">
						<?php esc_html_e($settings['button_text']) ?>
					</a>
				</div>
				<!-- /.gp-pricing__action -->
			<?php endif; ?>
		</div>
		<!-- /.gpt-pricing -->
		<?php
	}
}