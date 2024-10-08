<?php

namespace GpTheme\GptNewsCore\Widgets;

use Elementor\{Controls_Manager,
	Group_Control_Background,
	Group_Control_Box_Shadow,
	Widget_Base,
	Group_Control_Typography
};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class BlogSlider extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'gpt-blog-slider';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'GPT Blog Slider', 'gpt-news-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-post-slider';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return [ 'gpt-elements' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'blog', 'slider', 'gpt' ];
	}

	/**
	 * Register widget controls.
	 *
	 * @since 1.0.0
	 */
	protected function register_controls() {
		// Testimonial
		//=========================
		$this->start_controls_section( 'section_tab_style', [
			'label' => esc_html__( 'Blog', 'gpt-news-core' ),
		] );

		$this->add_control( 'post_count', [
			'label'   => esc_html__( 'Post count', 'gpt-news-core' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => esc_html__( '3', 'gpt-news-core' ),

		] );

		$this->add_control( 'post_cat', [
			'label'       => esc_html__( 'Select category', 'gpt-news-core' ),
			'type'        => Controls_Manager::SELECT2,
			'multiple'    => true,
			'label_block' => true,
			'options'     => \GPT_Helper::categories_suggester(),
			'default'     => '0'
		] );

		$this->add_control( 'content_length', [
			'label'   => __( 'Word Limit', 'gpt-news-core' ),
			'type'    => \Elementor\Controls_Manager::NUMBER,
			'min'     => 5,
			'max'     => 30,
			'step'    => 1,
			'default' => 13,
		] );

		$this->add_control( 'readmore', [
			'label'       => __( 'Read More Button text' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter button text here' ),
			'default'     => __( 'Read More', 'gpt-news-core' ),
			'label_block' => true
		] );

		$this->end_controls_section();

		// Slider Control
		//=====================
		$this->start_controls_section( 'settingd_section', [
			'label' => esc_html__( 'Slider Control', 'gpt-news-core' ),
		] );

		$this->add_control( 'navigation', [
			'label'        => esc_html__( 'Navigation', 'gpt-news-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Show', 'gpt-news-core' ),
			'label_off'    => esc_html__( 'Hide', 'gpt-news-core' ),
			'return_value' => 'yes',
			'default'      => 'no'
		] );

		$this->add_control( 'pagination', [
			'label'        => esc_html__( 'Pagination', 'gpt-news-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Show', 'gpt-news-core' ),
			'label_off'    => esc_html__( 'Hide', 'gpt-news-core' ),
			'return_value' => 'yes',
			'default'      => 'yes'
		] );


		$this->add_control( 'loop', [
			'label'        => esc_html__( 'Loop', 'gpt-news-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'On', 'gpt-news-core' ),
			'label_off'    => esc_html__( 'Off', 'gpt-news-core' ),
			'return_value' => 'yes',
			'default'      => 'yes'
		] );

		$this->add_control( 'speed', [
			'label'   => __( 'Speed', 'gpt-news-core' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => 700,
		] );

		$this->add_control( 'autoplay', [
			'label'        => esc_html__( 'Autoplay', 'gpt-news-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'On', 'gpt-news-core' ),
			'label_off'    => esc_html__( 'Off', 'gpt-news-core' ),
			'return_value' => 'yes',
			'default'      => 'yes'
		] );

		$this->add_control( 'autoplay_time', [
			'label'     => __( 'Autoplay Time', 'gpt-news-core' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => 9000,
			'condition' => [
				'autoplay' => 'yes'
			]
		] );

		$this->end_controls_section();

		// Blog Meta Style
		//====================
		$this->start_controls_section( 'background_shape', [
			'label' => __( 'Meta', 'gpt-news-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'meta_show', [
			'label'        => __( 'Show Post meta', 'gpt-news-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'gpt-news-core' ),
			'label_off'    => __( 'No', 'gpt-news-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'meta_text_typography',
			'label'    => __( 'Typography', 'gpt-news-core' ),
			'selector' => '{{WRAPPER}} .gpt-post__date-meta .posted-on a',
		] );


		$this->add_control( 'meta_text_color', [
			'label'     => __( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => ['{{WRAPPER}} .gpt-post__date-meta .posted-on a' => 'color: {{VALUE}}'],
		] );

		$this->add_control( 'meta_icon_color', [
			'label'     => __( 'Icon Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-post__date-meta svg path' => 'strocke: {{VALUE}}',
			],
		] );


		$this->add_control( 'title_color_hover', [
			'label'     => __( 'Hover Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-post__date-meta .posted-on a:hover' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();

		// Title Style
		//=====================
		$this->start_controls_section( 'name_section', [
			'label' => __( 'Title', 'gpt-news-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => __( 'Typography', 'gpt-news-core' ),
			'selector' => '{{WRAPPER}} .gpt__post-slider .gpt__entry-title',
		] );

		$this->add_control( 'title_color', [
			'label'     => __( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt__post-slider .gpt__entry-title a' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'title_hover_color', [
			'label'     => __( 'Hover Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt__post-slider .gpt__entry-title a:hover' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();

		// Content Style
		//=====================
		$this->start_controls_section( 'designation_section', [
			'label' => __( 'Content', 'gpt-news-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'content_typography',
			'label'    => __( 'Typography', 'gpt-news-core' ),
			'selector' => '{{WRAPPER}} .gpt__post-slider .gpt__entry-content',
		] );

		$this->add_control( 'content_color', [
			'label'     => __( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt__post-slider .gpt__entry-content' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();


		// Style Slider Control Section
		//================================
		$this->start_controls_section( 'control_section', [
			'label' => __( 'Slider  Control', 'gpt-news-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );


		$this->add_control(
			'nav_width',
			[
				'label'      => esc_html__( 'Nav Height/Width', 'gpt-news-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .blog-prev, {{WRAPPER}} .blog-next' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'nav_font_size',
			[
				'label'      => esc_html__( 'Nav Font Size', 'gpt-news-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .blog-prev, {{WRAPPER}} .blog-next' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]

		);

		$this->add_control(
			'nav_border_radius',
			[
				'label'      => esc_html__( 'Nav Border Radius', 'gpt-news-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .blog-prev, {{WRAPPER}} .blog-next' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs( 'tabs_nav_style' );
		$this->start_controls_tab(
			'tab_nav_normal',
			[
				'label' => __( 'Normal', 'gpt-news-core' ),
			]
		);

		$this->add_control( 'slider_nav_color', [
			'label'     => __( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .blog-prev, {{WRAPPER}} .blog-next' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'nav_bg_color', [
			'label'     => __( 'Background Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .blog-prev, {{WRAPPER}} .blog-next' => 'background-color: {{VALUE}}',
			],
		] );

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'slider_control_border',
				'selector' => '{{WRAPPER}} .blog-prev, {{WRAPPER}} .blog-next',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'nav_box_shadow',
				'label'    => __( 'Box Shadow', 'gpt-news-core' ),
				'selector' => '{{WRAPPER}} .blog-prev, {{WRAPPER}} .blog-next',
			]
		);

		$this->add_control( 'pagination_bg_color', [
			'label'     => __( 'Pagination BG Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'background: {{VALUE}}',
			],
			'separator' => 'before',
		] );

		$this->end_controls_tab();


		$this->start_controls_tab(
			'tab_nav_hover',
			[
				'label' => __( 'Hover', 'gpt-news-core' ),
			]
		);

		$this->add_control( 'nav_color_hover', [
			'label'     => __( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .blog-prev:hover, {{WRAPPER}} .blog-next:hover' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'nav_color_bg_hover', [
			'label'     => __( 'Background Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .blog-prev:hover, {{WRAPPER}} .blog-next:hover' => 'background-color: {{VALUE}}',
			],
		] );

		$this->add_control( 'nav_control_hover', [
			'label'     => __( 'Border Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .blog-prev:hover, {{WRAPPER}} .blog-next:hover' => 'border-color: {{VALUE}}',
			],
		] );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'nav_box_shadow_hover',
				'label'    => __( 'Box Shadow', 'gpt-news-core' ),
				'selector' => '{{WRAPPER}} .blog-prev:hover, {{WRAPPER}} .blog-next:hover',
			]
		);

		$this->add_control( 'slider_pagination_active_color', [
			'label'     => __( 'Pagination Active BG Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet:before' => 'background: {{VALUE}}',
			],
			'separator' => 'before',
		] );

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Style Slider Control Section
		//================================
		$this->start_controls_section( 'blog_section', [
			'label' => __( 'Blog Container', 'gpt-news-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'blog_bg_color', [
			'label'     => __( 'Background Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-post__item' => 'background: {{VALUE}}',
			],
		] );

		$this->add_control(
			'blog_padding',
			[
				'label'      => __( 'Padding', 'gpt-news-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .gpt-post__blog-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'blog_border_radius',
			[
				'label'      => __( 'Border Radius', 'gpt-news-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}}  .gpt-post__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'blog_shadow',
				'label'    => __( 'Box Shadow', 'gpt-news-core' ),
				'selector' => '{{WRAPPER}} .gpt-post__item',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$post_cat = $settings['post_cat'];

		$post_count = $settings['post_count'];

		$this->add_render_attribute( 'wrapper', 'class', [
			'swiper-container',
			'gpt-post-slider',
		] );

		$slider_options = $this->get_slider_options( $settings );
		$this->add_render_attribute( 'wrapper', 'data-blog', wp_json_encode( $slider_options ) );


		$paged = 1;
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		}
		if ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		}

		$_tax_query = array();

		if ( $post_cat ) {
			$_tax_query = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'slug',
					'terms'    => $post_cat,
				)
			);
		}

		$query = array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => $post_count,
			'tax_query'      => $_tax_query,
			'paged'          => $paged,
		);

		$gpt_query = new \WP_Query( $query );

		if ( $gpt_query->have_posts() ): ?>


			<div class="blog-slider-wrapper">
				<?php if ( $settings['navigation'] == 'yes' ) : ?>
					<div class="blog-prev">
						<i class="fas fa-chevron-left"></i>
					</div>
				<?php endif; ?>
				<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
					<div class="swiper-wrapper">
						<?php
						while ( $gpt_query->have_posts() ) :
							$gpt_query->the_post();
							echo '<div class="swiper-slide">';
							require __DIR__ . '/templates/blog/blog-slider.php';
							echo '</div>';
						endwhile;
						?>
					</div>

					<?php if ( $settings['pagination'] == 'yes' ) { ?>
						<div class="blog-pagination swiper-pagination"></div>
					<?php } ?>

				</div>
				<?php if ( $settings['navigation'] == 'yes' ) : ?>
					<div class="blog-next">
						<i class="fas fa-chevron-right"></i>
					</div>
				<?php endif; ?>
			</div>


		<?php
		endif;
		wp_reset_postdata();

	}

	protected function get_slider_options( array $settings ) {

		// Loop
		if ( $settings['loop'] == 'yes' ) {
			$slider_options['loop'] = true;
		}

		// Speed
		if ( ! empty( $settings['speed'] ) ) {
			$slider_options['speed'] = $settings['speed'];
		}

		// Breakpoints
		$slider_options['breakpoints'] = [
			'991' => [
				'slidesPerView' => 3,
			],

			'767' => [
				'slidesPerView' => 2,
			],

			'320' => [
				'slidesPerView' => 1,
			],
		];


		// Auto Play
		if ( $settings['autoplay'] == 'yes' ) {
			$slider_options['autoplay'] = [
				'delay'                => $settings['autoplay_time'],
				'disableOnInteraction' => false
			];
		} else {
			$slider_options['autoplay'] = [
				'delay' => '99999999999',
			];
		}

		if ( $settings['navigation'] == 'yes' ) {
			$slider_options['navigation'] = [
				'nextEl' => '.blog-next',
				'prevEl' => '.blog-prev'
			];
		}

		if ( $settings['pagination'] == 'yes' ) {
			$slider_options['pagination'] = [
				'el'        => '.blog-pagination',
				'clickable' => true
			];
		}

		$slider_options['spaceBetween'] = (int) '35';

		return $slider_options;
	}


}