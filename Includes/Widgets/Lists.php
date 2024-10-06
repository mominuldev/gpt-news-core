<?php

namespace GpTheme\GptNewsCore\Widgets;

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
		return 'gpt-list';
	}


	public function get_title() {
		return __( 'MPT List', 'gpt-core' );
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
		return [ 'gpt-elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section( 'section_content', [
			'label' => __( 'List', 'gpt-core' ),
		] );

		$this->add_control( 'list_view', [
			'label'   => __( 'View', 'gpt-core' ),
			'type'    => Controls_Manager::CHOOSE,
			'default' => 'traditional',
			'options' => [
				'traditional' => [
					'title' => __( 'Default', 'gpt-core' ),
					'icon'  => 'eicon-editor-list-ul',
				],
				'inline'      => [
					'title' => __( 'Inline', 'gpt-core' ),
					'icon'  => 'eicon-ellipsis-h',
				],
			],
		] );

		$this->add_control( 'icon_show', [
			'label'        => __( 'Icon Show', 'gpt-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'gpt-core' ),
			'label_off'    => __( 'No', 'gpt-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_control( 'icon_shape', [
			'label'        => __( 'Icon Circle Shape', 'gpt-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'gpt-core' ),
			'label_off'    => __( 'No', 'gpt-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'list_title', [
			'label'       => __( 'Title', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'List Title', 'gpt-core' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'icon_type', [
			'label'   => __( 'Icon Type', 'gpt-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'fontawesome',
			'options' => [
				'fontawesome' => __( 'Font Awesome', 'gpt-core' ),
				'feather'     => __( 'Feather', 'gpt-core' ),
			],
		] );

		$repeater->add_control( 'icon_feather', [
			'label'       => __( 'Icon', 'gpt-core' ),
			'type'        => Controls_Manager::ICON,
			'options'     => gpt_feather_icon(),
			'include'     => gpt_include_feather_icons(),
			'default'     => 'feather-check',
			'condition'   => [
				'icon_type' => 'feather'
			],
			'label_block' => true,
		] );

		$repeater->add_control( 'icon', [
			'label'     => __( 'Icon', 'gpt-core' ),
			'type'      => Controls_Manager::ICONS,
			'default'   => [
				'value'   => 'fas fa-check',
				'library' => 'solid',
			],
			'condition' => [
				'icon_type' => 'fontawesome'
			]
		] );

		$repeater->add_control( 'link', [
			'label'       => __( 'Link', 'gpt-core' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => __( 'https://your-link.com', 'gpt-core' ),
		] );


		$this->add_control( 'list', [
			'label'       => __( 'List Items', 'gpt-core' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'list_title' => __( 'List One', 'gpt-core' ),
					'icon'       => [
						'value' => 'fas fa-check'
					]
				],
				[
					'list_title' => __( 'List Two', 'gpt-core' ),
					'icon'       => [
						'value' => 'fas fa-check'
					]
				],
				[
					'list_title' => __( 'List Three', 'gpt-core' ),
					'icon'       => [
						'value' => 'fas fa-check'
					]
				],
			],
			'title_field' => '{{{ list_title }}}',
		] );


		$this->end_controls_section();

		$this->start_controls_section( 'list_style_section', [
			'label' => __( 'List', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'list_space_between', [
			'label'     => __( 'Space Between', 'gpt-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .gpt__list:not(.inline-items) .list-item:not(:last-child)'  => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
				'{{WRAPPER}} .gpt__list:not(.inline-items) .list-item:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
				'{{WRAPPER}} .gpt__list.inline-items .list-item'                         => 'margin-right: calc({{SIZE}}{{UNIT}}/2);',
				//                    '{{WRAPPER}} .gpt__list.inline-items' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
			],
		] );

		$this->add_responsive_control( 'list_align', [
			'label'     => __( 'Alignment', 'gpt-core' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [
					'title' => __( 'Left', 'gpt-core' ),
					'icon'  => 'eicon-h-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'gpt-core' ),
					'icon'  => 'eicon-h-align-center',
				],
				'right'  => [
					'title' => __( 'Right', 'gpt-core' ),
					'icon'  => 'eicon-h-align-right',
				],
			],
			'toggle'    => false,
			'selectors' => [
				'{{WRAPPER}} .gpt__list' => 'text-align: {{VALUE}};'
			]
		] );

		$this->end_controls_section();

		// Icon Style
		// ==============================
		$this->start_controls_section( 'list_icon_section', [
			'label' => __( 'Icon', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'icon_color', [
			'label'     => __( 'Color', 'elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .gpt__list li .gpt__list-icon i'   => 'color: {{VALUE}};',
				'{{WRAPPER}} .gpt__list li svg' => 'fill: {{VALUE}};',
			],
		] );

		$this->add_control( 'icon_color_hover', [
			'label'     => __( 'Hover', 'elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .gpt__list li:hover .gpt__list-icon i'   => 'color: {{VALUE}};',
				'{{WRAPPER}} .gpt__list li:hover svg' => 'fill: {{VALUE}};',
			],
		] );

		$this->add_control( 'icon_bg_color', [
			'label'     => __( 'BG Color', 'elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .gpt__list li .gpt__list-icon' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'icon_bg_hover_color', [
			'label'     => __( 'BG Color', 'elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .gpt__list li:hover .gpt__list-icon' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'uld_icon_size', [
			'label'     => __( 'Size', 'elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 14,
			],
			'range'     => [
				'px' => [
					'min' => 6,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .gpt__list li i'   => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .gpt__list li svg' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		// Space between icon and text
		$this->add_responsive_control( 'icon_space', [
			'label'     => __( 'Space', 'gpt-core' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 10,
			],
			'range'     => [
				'px' => [
					'min' => 0,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .gpt__list li .gpt__list-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
			],
		] );

		// Icon Padding with slider control
		$this->add_responsive_control( 'icon_padding', [
			'label'      => __( 'Padding', 'gpt-core' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 50,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .gpt__list li .gpt__list-icon' => 'padding: {{SIZE}}{{UNIT}};',
			],
		] );



		$this->end_controls_section();

		$this->start_controls_section( 'list_text_section', [
			'label' => __( 'Text', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'list_typography',
			'label'    => __( 'Typography', 'gpt-core' ),
			'selector' => '{{WRAPPER}} .gpt__list li',
		] );

		$this->add_control( 'list_color', [
			'label'     => __( 'Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt__list li,
                    {{WRAPPER}} .gpt__list li a' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'list_hover_color', [
			'label'     => __( 'Hover Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt__list li:hover,
                    {{WRAPPER}} .gpt__list li a:hover' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'text_indent', [
			'label'     => __( 'Text Indent', 'elementor' ),
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


		$this->add_render_attribute( 'icon_list', 'class', 'gpt__list' );
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

						<?php if ( 'yes' === $settings['icon_show'] ) :
							if ( $item['icon_type'] == 'fontawesome' ) { ?>
								<span class="gpt__list-icon">
                                    <?php Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
							<?php } else { ?>
								<span class="gpt__list-icon">
                                    <i class="<?php echo esc_attr( $item['icon_feather'] ) ?>"></i>
                                </span>
							<?php }
						endif; ?>
						<span class="list-text"><?php echo $item['list_title']; ?></span>
						<?php if ( ! empty( $item['link']['url'] ) ) : ?>
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
	//        view.addRenderAttribute( 'icon_list', 'class', 'gpt__list' );
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

