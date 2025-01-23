<?php

namespace PixelPath\PPSPassportCore\Widgets;

use Elementor\{
	Group_Control_Box_Shadow,
	Widget_Base,
	Controls_Manager,
	Group_Control_Typography,
	Group_Control_Border
};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Button
 *
 * @package PixelPath\PPSPassportCore\Widgets
 */

class Button extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve button widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'pps-button';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve button widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'PPS Button', 'pps-passport-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve button widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'eicon-button';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the icon box widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_categories() {
		return [ 'pps-elements' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'button', 'link', 'cta' ];
	}

	/**
	 * Get button sizes.
	 *
	 * Retrieve an array of button sizes for the button widget.
	 *
	 * @return array An array containing button sizes.
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 */
	public static function get_button_sizes() {
		return [
			'btn-xs' => __( 'Extra Small', 'pps-passport-core' ),
			'btn-sm' => __( 'Small', 'pps-passport-core' ),
			'btn-md' => __( 'Medium', 'pps-passport-core' ),
			'btn-lg' => __( 'Large', 'pps-passport-core' ),
			'btn-xl' => __( 'Extra Large', 'pps-passport-core' ),
		];
	}


	/**
	 * Register button widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_button',
			[
				'label' => __( 'Button', 'pps-passport-core' ),
			]
		);

		$this->add_control(
			'button_size',
			[
				'label'   => __( 'Size', 'pps-passport-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-md',
				'options' => $this->get_button_sizes(),
			]
		);

		$this->add_control(
			'button_shape',
			[
				'label'   => __( 'Shape', 'pps-passport-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-round',
				'options' => [
					'btn-square' => __( 'Square', 'pps-passport-core' ),
					'btn-round'  => __( 'Round', 'pps-passport-core' ),
					'btn-circle' => __( 'Circle', 'pps-passport-core' ),
				],
			]
		);

		$this->add_control(
			'button_style',
			[
				'label'   => __( 'Shape', 'pps-passport-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-default',
				'options' => [
					'btn-default' => __( 'Default', 'pps-passport-core' ),
					'btn-outline' => __( 'Outline', 'pps-passport-core' ),
				],
			]
		);

		$this->add_control(
			'button_fill_color',
			[
				'label'   => __( 'Fill Color', 'pps-passport-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-dark',
				'options' => [
					'btn-default' => __( 'Default', 'pps-passport-core' ),
					'btn-light' => __( 'Light', 'pps-passport-core' ),
					'btn-dark' => __( 'Dark', 'pps-passport-core' ),
				],
			]
		);

		$this->add_control(
			'text',
			[
				'label'       => __( 'Text', 'pps-passport-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Learn More', 'pps-passport-core' ),
				'placeholder' => __( 'Button Text', 'pps-passport-core' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label'       => __( 'Link', 'pps-passport-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'http://your-link.com',
				'default'     => [
					'url' => '#',
				],
			]
		);

		$this->add_control( 'selected_icon', [
			'label'   => __( 'Icon', 'pps-passport-core' ),
			'type'    => Controls_Manager::ICONS,
			'fa4compatibility' => 'icon',
			'label_block' => true,

		] );

		$this->add_control(
			'icon_align',
			[
				'label'     => __( 'Icon Position', 'pps-passport-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'right',
				'options'   => [
					'left'  => __( 'Before', 'pps-passport-core' ),
					'right' => __( 'After', 'pps-passport-core' ),
				],
				'condition' => [
					'selected_icon!' => '',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label'     => __( 'Icon Spacing', 'pps-passport-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'selected_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .pps-btn .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pps-btn .elementor-align-icon-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'        => __( 'Alignment', 'pps-passport-core' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
					'left'    => [
						'title' => __( 'Left', 'pps-passport-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => __( 'Center', 'pps-passport-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'pps-passport-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default'      => '',
			]
		);

		$this->add_control(
			'view',
			[
				'label'   => __( 'View', 'pps-passport-core' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		// Style Section
		//======================

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Button', 'pps-passport-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'label'    => __( 'Typography', 'pps-passport-core' ),
				'selector' => '{{WRAPPER}} .pps-btn',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'pps-passport-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.pps-btn, {{WRAPPER}} .pps-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'btn_padding',
			[
				'label'      => __( 'Padding', 'pps-passport-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.pps-btn, {{WRAPPER}} .pps-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'pps-passport-core' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => __( 'Color', 'pps-passport-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} a.pps-btn, {{WRAPPER}} .pps-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => __( 'Background Color', 'pps-passport-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pps-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'border',
				'label'    => __( 'Border', 'pps-passport-core' ),
				'selector' => '{{WRAPPER}} .pps-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'pps-passport-core' ),
				'selector' => '{{WRAPPER}} .pps-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'pps-passport-core' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label'     => __( 'Color', 'pps-passport-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pps-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color_hover',
			[
				'label'     => __( 'Background Color', 'pps-passport-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pps-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'border_hover',
				'label'    => __( 'Border', 'pps-passport-core' ),
				'selector' => '{{WRAPPER}} .pps-btn:hover'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow_hover',
				'label'    => __( 'Box Shadow', 'pps-passport-core' ),
				'selector' => '{{WRAPPER}} .pps-btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Render button widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings    = $this->get_settings_for_display();
		$button_type = $settings['button_size'];

		$this->add_render_attribute( 'wrapper', 'class', 'pps-btn-wrapper' );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'button', 'href', $settings['link']['url'] );
			$this->add_render_attribute( 'button', 'class', 'pps-btn-links' );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'button', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'button', 'rel', 'nofollow' );
			}
		}

		$this->add_render_attribute( 'button', 'class', 'pps-btn' );


		if ( ! empty( $settings['button_shape'] ) ) {
			$this->add_render_attribute( 'button', 'class', $settings['button_shape'] );
		}

		if ( ! empty( $settings['button_size'] ) ) {
			$this->add_render_attribute( 'button', 'class', $settings['button_size'] );
		}
		if ( ! empty( $settings['button_style'] ) ) {
			$this->add_render_attribute( 'button', 'class', $settings['button_style'] );
		}

		// Button Fill Color
		if ( ! empty( $settings['button_fill_color'] ) ) {
			$this->add_render_attribute( 'button', 'class',  $settings['button_fill_color'] );
		}

		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
				<?php $this->render_text(); ?>
			</a>
		</div>
		<?php
	}

	/**
	 * Render button widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() {
		?>
		<#
		view.addRenderAttribute( 'text', 'class', 'btn-text' );
		view.addInlineEditingAttributes( 'text', 'none' );

		var iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' );
		#>
		<div class="pps-btn-wrapper">
			<a class="pps-btn {{ settings.button_shape }} {{ settings.button_size }} {{ settings.button_style }} {{ settings.button_fill_color}} elementor-animation-{{ settings.hover_animation }}"
			   href="{{ settings.link.url }}">
				<span class="pps-btn-content-wrapper">
					<span class="pps-btn-icon elementor-align-icon-{{ settings.icon_align }}">
						{{{ iconHTML.value }}}
					</span>
					<span {{{ view.getRenderAttributeString( 'text' ) }}}>{{{ settings.text }}}</span>
				</span>
			</a>
		</div>
		<?php
	}

	/**
	 * Render button text.
	 *
	 * Render button widget text.
	 *
	 * @since 1.5.0
	 * @access protected
	 */
	protected function render_text() {
		$settings = $this->get_settings();
		$this->add_render_attribute( 'content-wrapper', 'class', 'pps-btn-content-wrapper' );
		$this->add_render_attribute( 'icon-align', 'class', 'elementor-align-icon-' . $settings['icon_align'] );
		$this->add_render_attribute( 'icon-align', 'class', 'pps-btn-icon' );

		$this->add_render_attribute( 'text', 'class', 'pps-btn-text' );

		// $this->add_inline_editing_attributes( 'text', 'none' );
		?>
		<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
			<?php if ( ! empty( $settings['selected_icon'] ) ) : ?>
				<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
					<?php if ( ! empty( $settings['selected_icon'] ) ) : ?>
						<?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					<?php endif; ?>
				</span>
			<?php endif; ?>
			<span <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo $settings['text']; ?></span>
		</span>
		<?php
	}
}