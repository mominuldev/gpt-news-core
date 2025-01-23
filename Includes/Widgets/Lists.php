<?php

namespace PixelPath\PPSPassportCore\Widgets;

use Elementor\{Controls_Manager,
	Icons_Manager,
	Repeater,
	Widget_Base,
	Group_Control_Typography
};

class Lists extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve alert widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'pps-list';
	}


	public function get_title() {
		return __( 'PPS List', 'pps-passport-core' );
	}

	public function get_icon() {
		return 'eicon-editor-list-ul';
	}

	/**
	 * Get widget categories.
	 * Retrieve the widget categories.
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories() {
		return [ 'pps-elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section( 'section_content', [
			'label' => __( 'List', 'pps-passport-core' ),
		] );

		$this->add_control( 'list_view', [
			'label'   => __( 'View', 'pps-passport-core' ),
			'type'    => Controls_Manager::CHOOSE,
			'default' => 'traditional',
			'options' => [
				'traditional' => [
					'title' => __( 'Default', 'pps-passport-core' ),
					'icon'  => 'eicon-editor-list-ul',
				],
				'inline'      => [
					'title' => __( 'Inline', 'pps-passport-core' ),
					'icon'  => 'eicon-ellipsis-h',
				],
			],
		] );

		$this->add_control( 'icon_show', [
			'label'        => __( 'Icon Show', 'pps-passport-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'pps-passport-core' ),
			'label_off'    => __( 'No', 'pps-passport-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_control( 'icon_shape', [
			'label'        => __( 'Icon Circle Shape', 'pps-passport-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'pps-passport-core' ),
			'label_off'    => __( 'No', 'pps-passport-core' ),
			'return_value' => 'yes',
			'default'      => 'no',
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'list_title', [
			'label'       => __( 'Title', 'pps-passport-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'List Title', 'pps-passport-core' ),
			'label_block' => true,
		] );


		$repeater->add_control( 'icon', [
			'label'   => __( 'Icon', 'pps-passport-core' ),
			'type'    => Controls_Manager::ICONS,
			'default' => [
				'value' => 'ri-arrow-right-double-fill',
			]
		] );

		$repeater->add_control( 'link', [
			'label'       => __( 'Link', 'pps-passport-core' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => __( 'https://your-link.com', 'pps-passport-core' ),
		] );


		$this->add_control( 'list', [
			'label'       => __( 'List Items', 'pps-passport-core' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'list_title' => __( 'List One', 'pps-passport-core' ),
					'icon'       => [
						'value' => 'ri-arrow-right-double-fill'
					]
				],
				[
					'list_title' => __( 'List Two', 'pps-passport-core' ),
					'icon'       => [
						'value' => 'ri-arrow-right-double-fill'
					]
				],
				[
					'list_title' => __( 'List Three', 'pps-passport-core' ),
					'icon'       => [
						'value' => 'ri-arrow-right-double-fill'
					]
				],
			],
			'title_field' => '{{{ list_title }}}',
		] );


		$this->end_controls_section();

		$this->start_controls_section( 'list_style_section', [
			'label' => __( 'List', 'pps-passport-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'list_space_between', [
			'label'     => __( 'Space Between', 'pps-passport-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .pps__list:not(.inline-items) .list-item:not(:last-child)'  => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
				'{{WRAPPER}} .pps__list:not(.inline-items) .list-item:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
				'{{WRAPPER}} .pps__list.inline-items .list-item'                         => 'margin-right: calc({{SIZE}}{{UNIT}}/2);',
				//                    '{{WRAPPER}} .pps__list.inline-items' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
			],
		] );

		$this->add_responsive_control( 'list_align', [
			'label'     => __( 'Alignment', 'pps-passport-core' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [
					'title' => __( 'Left', 'pps-passport-core' ),
					'icon'  => 'eicon-h-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'pps-passport-core' ),
					'icon'  => 'eicon-h-align-center',
				],
				'right'  => [
					'title' => __( 'Right', 'pps-passport-core' ),
					'icon'  => 'eicon-h-align-right',
				],
			],
			'toggle'    => false,
			'selectors' => [
				'{{WRAPPER}} .pps__list' => 'text-align: {{VALUE}};'
			]
		] );

		$this->end_controls_section();

		// Icon Style
		// ==============================
		$this->start_controls_section( 'list_icon_section', [
			'label' => __( 'Icon', 'pps-passport-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'icon_color', [
			'label'     => __( 'Color', 'pps-passport-core' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .pps__list li .pps__list-icon' => 'color: {{VALUE}};',
				'{{WRAPPER}} .pps__list li svg'               => 'fill: {{VALUE}};',
			],
		] );

		$this->add_control( 'icon_color_hover', [
			'label'     => __( 'Hover', 'pps-passport-core' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .pps__list li:hover .pps__list-icon' => 'color: {{VALUE}};',
				'{{WRAPPER}} .pps__list li:hover svg'               => 'fill: {{VALUE}};',
			],
		] );

		$this->add_control( 'icon_bg_color', [
			'label'     => __( 'BG Color', 'pps-passport-core' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .pps__list li .pps__list-icon' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'icon_bg_hover_color', [
			'label'     => __( 'BG Color', 'pps-passport-core' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .pps__list li:hover .pps__list-icon' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'list_icon_size', [
			'label'     => __( 'Size', 'pps-passport-core' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 16,
			],
			'range'     => [
				'px' => [
					'min' => 6,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .pps__list li .pps__list-icon'   => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .pps__list li svg' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		// Space between icon and text
		$this->add_responsive_control( 'icon_space', [
			'label'     => __( 'Space', 'pps-passport-core' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 5,
			],
			'range'     => [
				'px' => [
					'min' => 0,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .pps__list li .pps__list-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
			],
		] );

		// Icon Padding with slider control
		$this->add_responsive_control( 'icon_padding', [
			'label'      => __( 'Padding', 'pps-passport-core' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 50,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .pps__list li .pps__list-icon' => 'padding: {{SIZE}}{{UNIT}};',
			],
		] );


		$this->end_controls_section();

		$this->start_controls_section( 'list_text_section', [
			'label' => __( 'Text', 'pps-passport-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'list_typography',
			'label'    => __( 'Typography', 'pps-passport-core' ),
			'selector' => '{{WRAPPER}} .pps__list li',
		] );

		$this->add_control( 'list_color', [
			'label'     => __( 'Color', 'pps-passport-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .pps__list li,
                    {{WRAPPER}} .pps__list li a' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'list_hover_color', [
			'label'     => __( 'Hover Color', 'pps-passport-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .pps__list li:hover,
                    {{WRAPPER}} .pps__list li a:hover' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'text_indent', [
			'label'     => __( 'Text Indent', 'pps-passport-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 50,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .list-text' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
			],
		] );


		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();


		$this->add_render_attribute( 'icon_list', 'class', 'pps__list' );
		$this->add_render_attribute( 'list_item', 'class', 'list-item' );

		if ( 'inline' === $settings['list_view'] ) {
			$this->add_render_attribute( 'icon_list', 'class', 'inline-items' );
			$this->add_render_attribute( 'list_item', 'class', 'inline-item' );
		}

		if ( 'yes' === $settings['icon_shape'] ) {
			$this->add_render_attribute( 'list_item', 'class', 'icon-shape' );
		}
		?>
		<ul <?php echo $this->get_render_attribute_string( 'icon_list' ); ?>>
			<?php foreach ( $settings['list'] as $item ) {

				$target   = $item['link']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $item['link']['nofollow'] ? ' rel="nofollow"' : '';
				?>
				<li <?php echo $this->get_render_attribute_string( 'list_item' ); ?>>
					<?php if ( ! empty( $item['link']['url'] ) ) : ?>
						<a href="<?php echo esc_attr( $item['link']['url'] ); ?>" <?php echo $target, $nofollow ?>>
					<?php endif; ?>

						<?php if ( 'yes' === $settings['icon_show'] ) : ?>
							<span class="pps__list-icon">
								<?php Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
						<?php endif; ?>
						<span class="list-text"><?php echo $item['list_title']; ?></span>
					<?php if ( ! empty( $item['link']['url'] ) ) : ?>
							<i class="ri-external-link-fill"></i>
						</a>
					<?php endif; ?>
				</li>
			<?php } ?>
		</ul>
		<?php
	}

	/**
	 * Render icon list widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 * @since 2.9.0
	 * @access protected
	 */
	//    protected function content_template() {
	//
	//        <#
	//        view.addRenderAttribute( 'icon_list', 'class', 'pps__list' );
	//        view.addRenderAttribute( 'list_item', 'class', 'list-item' );
	//
	//        if ( 'inline' == settings.list_view ) {
	//        view.addRenderAttribute( 'icon_list', 'class', 'inline-items' );
	//        view.addRenderAttribute( 'list_item', 'class', ''inline-item' );
	//        }
	//
	//        #>
	//
	//        <ul {{{ view.getRenderAttributeString( 'icon_list' ) }}}>
	//
	//            <# _.each( settings.list, function( item, index ) { #>
	//                <li {{{ view.getRenderAttributeString( 'list_item' ) }}}>
	//
	//                    <# if ( item.link.url ) { #>
	//                        <a href="{{ item.link.url }}">
	//                    <# } #>
	//
	//                        <# if ( settings.icon_show == 'yes' ) { #>
	//                            Icons_Manager::render_icon.item.icon
	//                        <# } #>
	//                        <span class="list-text">{{{ item.list_title }}}</span>
	//
	//                    <# if ( item.link.url ) { #>
	//                         </a>
	//                    <# } #>
	//                </li>
	//            <# } ); #>
	//        </ul>
	//
	//    }

}

