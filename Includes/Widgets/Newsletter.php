<?php

namespace GpTheme\GptNewsCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\{Group_Control_Box_Shadow,
	Widget_Base,
	Controls_Manager,
	Group_Control_Typography,
	Group_Control_Border,
	Group_Control_Background};


class Newsletter extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve alert widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'gpt-newsletter';
	}


	public function get_title() {
		return __( 'MPT Newsletter', 'gpt-core' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-mailchimp';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the widget categories.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_categories() {
		return [ 'gpt-elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section( 'section_content', [
			'label' => __( 'Newsletter', 'gpt-core' ),
		] );

		// Layout
		$this->add_control( 'layout', [
			'label'   => __( 'Layout', 'gpt-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'one',
			'options' => [
				'one' => __( 'Layout One', 'gpt-core' ),
				'two'  => __( 'Layout Two', 'gpt-core' ),
				'three'  => __( 'Layout Three', 'gpt-core' ),
			],
		] );

		$this->add_control( 'button_view', [
			'label'   => __( 'Button View', 'gpt-core' ),
			'type'    => Controls_Manager::CHOOSE,
			'default' => 'traditional',
			'options' => [
				'traditional' => [
					'title' => __( 'Default', 'gpt-core' ),
					'icon'  => 'eicon-ellipsis-h',
				],
				'block'      => [
					'title' => __( 'Block', 'gpt-core' ),
					'icon'  => 'eicon-editor-list-ul'
				],
			],
		] );

		$this->add_control( 'name_placeholder', [
			'label'       => esc_html__( 'Name Placeholder', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'Enter your name', 'gpt-core' ),
			'label_block' => true,
			'condition' => [
				'layout' => 'two',
			],
		] );

		$this->add_control( 'input_placeholder', [
			'label'       => esc_html__( 'Email Placeholder', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'Enter your email', 'gpt-core' ),
			'label_block' => true,
		] );

		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Spacing', 'unialulmni-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .newsletter-form .newsletter-inner.btn-inline .input-inner' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .newsletter-form .newsletter-inner.btn-block .input-inner' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control( 'button_type', [
			'label'   => esc_html__( 'Button Type', 'gpt-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'text',
			'options' => [
				'icon'  => esc_html__( 'Icon', 'gpt-core' ),
				'text'  => esc_html__( 'Text', 'gpt-core' ),
			],
		] );

		$this->add_control( 'subscribe_text', [
			'label'       => esc_html__( 'Button Text', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => __( 'Subscribe', 'gpt-core' ),
			'condition'   => [
				'button_type' => 'text',
			],
		] );

		$this->add_control( 'subscribe_icon', [
			'label'     => esc_html__( 'Button Icon', 'gpt-core' ),
			'type' => \Elementor\Controls_Manager::ICONS,
			'default' => [
				'value' => 'far fa-paper-plane',
				'library' => 'fa-regular',
			],
			'condition' => [
				'button_type' => 'icon',
			],
		] );

		$this->add_control(
			'button_switch',
			[
				'label' => esc_html__( 'Button Icon Show/Hide', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'button_type' => 'text'
				],
			]
		);

		$this->add_control( 'selected_icon', [
			'label'     => __( 'Icon', 'gpt-core' ),
			'type'      => Controls_Manager::ICONS,
			'default'   => [
				'value'   => 'fas fa-arrow-right',
				'library' => 'solid',
			],
			'condition' => [
				'button_type' => 'text',
				'button_switch' => 'yes'
			],
		] );

		$this->add_control(
			'icon_align',
			[
				'label' => __('Icon Position', 'gpt-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left' => __('Before', 'gpt-core'),
					'right' => __('After', 'gpt-core'),
				],
				'condition' => [
					'selected_icon!' => '',
					'button_type' => 'text',
					'button_switch' => 'yes'
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label' => __('Icon Spacing', 'gpt-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'selected_icon!' => '',
					'button_type' => 'text',
					'button_switch' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .gpt-btn .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gpt-btn .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Newsletter Form alignment
		$this->add_responsive_control(
			'newsletter_position',
			[
				'label' => esc_html__( 'Alignment', 'gpt-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'gpt-core' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'gpt-core' ),
						'icon' => 'fa fa-align-center',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right', 'gpt-core' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'start',
				'selectors' => [
					'{{WRAPPER}} .gpt-newsletter' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();


		// Style Section
		//======================

		$this->start_controls_section( 'section_style_field', [
			'label' => __( 'Email Field', 'gpt-core' ),
			'tab' => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control(
			'field_color',
			[
				'label' => __('Color', 'gpt-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit])' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_bg_color',
			[
				'label' => __('Background', 'gpt-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit])' => 'background-color: {{VALUE}};',
				],
			]
		);

		// Paceholder Color
		$this->add_control(
			'placeholder_color',
			[
				'label' => __('Placeholder Color', 'gpt-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit])::placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'field_typography',
				'label' => __('Typography', 'gpt-core'),
				'selector' => '{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit])',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_field',
				'label' => __('Border', 'gpt-core'),
				'selector' => '{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit])'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_field_shadow',
				'label' => __( 'Box Shadow', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit])',
			]
		);

		$this->add_control(
			'field_bg_color_focus',
			[
				'label' => __('Focus Background', 'gpt-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit]):focus' => 'background-color: {{VALUE}};',
				],
				'separator' => 'before'
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_field_focus',
				'label' => __('Focus Border', 'gpt-core'),
				'selector' => '{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit]):focus'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_field_shadow_focus',
				'label' => __( 'Focus Box Shadow', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit]):focus',
			]
		);

		// Input Height
		$this->add_control(
			'input_height',
			[
				'label' => __('Input Height', 'gpt-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .newsletter-form input:not([type=checkbox]), {{WRAPPER}} .newsletter-form .newsletter-submit' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style',
			[
				'label' => __('Button', 'gpt-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'label' => __('Typography', 'gpt-core'),
				'selector' => '{{WRAPPER}} .gpt-btn',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __('Border Radius', 'gpt-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} a.gpt-btn, {{WRAPPER}} .gpt-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'text_padding',
			[
				'label' => __('Padding', 'gpt-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} a.gpt-btn, {{WRAPPER}} .gpt-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		// Button Min Width
		$this->add_responsive_control(
			'button_min_width',
			[
				'label' => __('Min Width', 'gpt-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 80,
						'max' => 300,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} a.gpt-btn, {{WRAPPER}} .gpt-btn' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __('Normal', 'gpt-core'),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __('Color', 'gpt-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.gpt-btn, {{WRAPPER}} .gpt-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __('Background Color', 'gpt-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __('Border', 'gpt-core'),
				'selector' => '{{WRAPPER}} .gpt-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __('Hover', 'gpt-core'),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => __('Color', 'gpt-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color_hover',
			[
				'label' => __('Background Color', 'gpt-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_hover',
				'label' => __('Border', 'gpt-core'),
				'selector' => '{{WRAPPER}} .gpt-btn:hover'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'label' => __( 'Box Shadow', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_wrapper_style',
			[
				'label' => __('Wrapper', 'gpt-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Color
		$this->add_control(
			'wrapper_bg_color',
			[
				'label' => __('Background Color', 'gpt-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .newsletter-form .newsletter-inner' => 'background-color: {{VALUE}};',
				],
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wrapper_border',
				'label' => __('Border', 'gpt-core'),
				'selector' => '{{WRAPPER}} .newsletter-form .newsletter-inner',
			]
		);

		// Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wrapper_box_shadow',
				'label' => __( 'Box Shadow', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .newsletter-form .newsletter-inner',
			]
		);

		// Border Radius
		$this->add_responsive_control(
			'wrapper_border_radius',
			[
				'label' => __('Border Radius', 'gpt-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .newsletter-form .newsletter-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_control(
			'wrapper_padding',
			[
				'label' => __('Padding', 'gpt-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .newsletter-form .newsletter-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$this->add_render_attribute('icon-align', 'class', 'elementor-align-icon-' . $settings['icon_align']);
		$this->add_render_attribute('icon-align', 'class', 'gpt-btn-icon');

		// Add Inner form wrapper class
		if( $settings['button_view'] == 'traditional'  ) {
			$this->add_render_attribute('form-inner', 'class', 'newsletter-inner btn-inline justify-content-center');
		} else {
			$this->add_render_attribute('form-inner', 'class', 'newsletter-inner btn-block');
		}

		$this->add_render_attribute('form', 'method', 'post');
		$this->add_render_attribute('form', 'action', admin_url( 'admin-ajax.php' ));
		$this->add_render_attribute('form', 'class', 'newsletter-form');

		// Add Inner form wrapper class
		if( $settings['layout']  ) {
			$this->add_render_attribute('form-inner', 'class', 'style-' . $settings['layout'] );
		}

		// Newsletter position
		if ( $settings['newsletter_position'] == 'right' ) {
			$this->add_render_attribute( 'form-inner', 'class', 'position-right' );
		} elseif ( $settings['newsletter_position'] == 'center' ) {
			$this->add_render_attribute( 'form-inner', 'class', 'position-center' );
		} else {
			$this->add_render_attribute( 'form-inner', 'class', 'position-left' );
		}

//		if($settings['show_input_icon'] == 'yes' ) {
//			$this->add_render_attribute('form-inner', 'class', 'show_before_icon');
//		}

		// Form action
		$this->add_render_attribute('form-inner', 'data-gpt-form', 'newsletter-subscribe');
		?>

		<div class="gpt-newsletter">
			<form <?php echo $this->get_render_attribute_string('form') ?>>
				<?php
					$nonce = wp_create_nonce( 'gpt_mailchimp_subscribe' );
				?>
				<input type="hidden" name="action" value="gpt_mailchimp_subscribe" class="gpt-newsletter-security" data-security="<?php echo esc_attr($nonce); ?>">
				<div <?php echo $this->get_render_attribute_string('form-inner'); ?> >
					<div class="input-inner">
						<?php if( $settings['layout'] == 'two' ) : ?>
							<input type="text" name="fname" class="form-control"  placeholder="<?php echo esc_attr( $settings['name_placeholder'] ); ?>" required>
						<?php endif; ?>
						<input type="email" name="email" class="form-control"  placeholder="<?php echo esc_attr( $settings['input_placeholder'] ); ?>" required>
					</div>
					<button type="submit" name="submit" class="newsletter-submit gpt-btn">
						<?php if( $settings['button_type'] == 'text' ) : ?>
							<?php echo esc_html( $settings['subscribe_text'] ); ?>
							<?php if (!empty($settings['selected_icon']) && $settings['button_switch'] == 'yes' ) : ?>
								<span <?php echo $this->get_render_attribute_string('icon-align'); ?>>
                                    <?php if ( ! empty( $settings['selected_icon'] ) ) : ?>
	                                    <?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    <?php endif; ?>
                                </span>
							<?php endif; ?>
						<?php else : ?>
							<?php \Elementor\Icons_Manager::render_icon( $settings['subscribe_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						<?php endif; ?>
						<i class="fa fa-circle-o-notch fa-spin"></i>
					</button>
				</div>
				<div class="form-result alert">
					<div class="content"></div>
				</div><!-- /.form-result-->
			</form><!-- /.newsletter-form -->
		</div>
		<!-- /.newsletter -->
		<?php
	}
}
