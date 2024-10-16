<?php

namespace GpTheme\GptNewsCore\Widgets;

use Elementor\{Controls_Manager, Group_Control_Background, Group_Control_Border, Group_Control_Box_Shadow, Widget_Base, Group_Control_Typography};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Blog extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'gpt-blog-grid';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'GPT Blog Grid', 'gpt-news-core' );
	}

	/**
	 * Get widget icon.
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-post-list';
	}

	/**
	 * Get widget categories.
	 * @since 1.0.0
	 */
	public function get_categories() {
		return [ 'gpt-elements' ];
	}

	/**
	 * Get widget keywords.
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'blog', 'grid', 'gpt' ];
	}

	/**
	 * Register widget controls.
	 * @since 1.0.0
	 */
	protected function register_controls() {
		// Testimonial
		//=========================
		$this->start_controls_section( 'section_tab_style', [
			'label' => esc_html__( 'Blog Grid', 'gpt-news-core' ),
		] );

		// Column
//		$this->add_control( 'column', [
//			'label'   => esc_html__( 'Column', 'gpt-news-core' ),
//			'type'    => Controls_Manager::SELECT,
//			'default' => '4',
//			'options' => [
//				'6' => esc_html__( '2 Column', 'gpt-news-core' ),
//				'4' => esc_html__( '3 Column', 'gpt-news-core' ),
//				'3' => esc_html__( '4 Column', 'gpt-news-core' ),
//			]
//		] );

		$this->add_control( 'post_count', [
			'label'   => esc_html__( 'Post count', 'gpt-news-core' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => esc_html__( '3', 'gpt-news-core' ),

		] );


		$this->add_control( 'content_length', [
			'label'   => __( 'Word Limit', 'gpt-news-core' ),
			'type'    => \Elementor\Controls_Manager::NUMBER,
			'min'     => 5,
			'max'     => 30,
			'step'    => 1,
			'default' => 15,
		] );

		$this->add_control( 'readmore', [
			'label'       => __( 'Read More Button text' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter button text here' ),
			'default'     => __( 'Read More', 'gpt-news-core' ),
			'label_block' => true
		] );

		$this->end_controls_section();

		// Query
		//=========================
		$this->start_controls_section( 'section_query', [
			'label' => esc_html__( 'Query', 'gpt-news-core' ),
		] );

		$this->add_control( 'post_cat', [
			'label'       => esc_html__( 'Select category', 'gpt-news-core' ),
			'type'        => Controls_Manager::SELECT2,
			'multiple'    => true,
			'label_block' => true,
			'options'     => \GPT_Helper::categories_suggester(),
			'default'     => '0'
		] );

		$this->add_control( 'order', [
			'label'   => esc_html__( 'Order', 'gpt-news-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'DESC',
			'options' => [
				'ASC'  => esc_html__( 'ASC', 'gpt-news-core' ),
				'DESC' => esc_html__( 'DESC', 'gpt-news-core' ),
			]
		] );

		$this->add_control( 'orderby', [
			'label'   => esc_html__( 'Order By', 'gpt-news-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'date',
			'options' => [
				'date'          => esc_html__( 'Date', 'gpt-news-core' ),
				'title'         => esc_html__( 'Title', 'gpt-news-core' ),
				'rand'          => esc_html__( 'Random', 'gpt-news-core' ),
				'comment_count' => esc_html__( 'Comment Count', 'gpt-news-core' ),
			]
		] );

		// Offset
		$this->add_control( 'offset', [
			'label'   => esc_html__( 'Offset', 'gpt-news-core' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => 0,
		] );

		// Exclude
		$this->add_control( 'exclude', [
			'label'   => esc_html__( 'Exclude', 'gpt-news-core' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '',
		] );

		// Include
		$this->add_control( 'include', [
			'label'   => esc_html__( 'Include', 'gpt-news-core' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '',
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
			'label'    => __( 'Date Typography', 'gpt-news-core' ),
			'selector' => '{{WRAPPER}} .gpt-post__item .gpt-post__date-meta .posted-on a, {{WRAPPER}} .gpt-post__date-meta a',
		] );

		$this->add_control( 'meta_text_color', [
			'label'     => __( 'Date Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-post__item .gpt-post__date-meta .posted-on a, {{WRAPPER}} .gpt-post__date-meta a' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'meta_icon_color', [
			'label'     => __( 'Icon Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-post__date-meta svg path' => 'stroke: {{VALUE}}',
			],
		] );


		$this->add_control( 'date_title_color_hover', [
			'label'     => __( 'Hover Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt__post-post-meta li a:hover, {{WRAPPER}} .gpt-post__date-meta a:hover' => 'color: {{VALUE}}',
			],
		] );

		// Author name
		$this->add_control(
			'author_options',
			[
				'label'     => esc_html__( 'Author Style', 'gpt-news-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'author_text_typography',
			'label'     => __( 'Author Typography', 'gpt-news-core' ),
			'selectors' => [ '{{WRAPPER}} .gpt-post__author-avatar a', '{{WRAPPER}} .gpt-post__author-meta a' ],
			'separator' => 'before'
		] );

		$this->add_control( 'author_text_color', [
			'label'     => __( 'Author Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-post__author-avatar a, {{WRAPPER}} .gpt-post__author-meta a' => 'color: {{VALUE}}',
			],

		] );

		$this->add_control( 'author_color_hover', [
			'label'     => __( 'Hover Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-post__author-avatar a:hover, {{WRAPPER}} .gpt-post__author-meta a:hover' => 'color: {{VALUE}}',
			],
		] );

		// Icon color
		$this->add_control( 'author_icon_color', [
			'label'     => __( 'Icon Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-post__author-meta svg path' => 'stroke: {{VALUE}}',
			],
			'condition' => [
				'layout' => 'list'
			]
		] );

		$this->add_control(
			'comments_and_view_options',
			[
				'label'     => esc_html__( 'Comments and View', 'gpt-news-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// Icon color
		$this->add_control( 'icon_color', [
			'label'     => __( 'Icon Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-post__comments svg path, {{WRAPPER}} .gpt-post__views svg path' => 'stroke: {{VALUE}}',
			],
		] );

		$this->add_control( 'comments_text_color', [
			'label'     => __( 'Comments Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-post__comments, {{WRAPPER}} .post_view_count' => 'color: {{VALUE}}',
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
			'selector' => '{{WRAPPER}} .gpt-post__entry-title',
		] );

		$this->add_control( 'title_color', [
			'label'     => __( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-post__entry-title a' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'title_hover_color', [
			'label'     => __( 'Hover Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-post__entry-title a:hover' => 'color: {{VALUE}}',
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
			'selector' => '{{WRAPPER}} .gpt-post__entry-content',
		] );

		$this->add_control( 'content_color', [
			'label'     => __( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-post__entry-content' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();

		// Category Style
		//=====================
		$this->start_controls_section( 'category_section', [
			'label'     => __( 'Category', 'gpt-news-core' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'layout' => 'list'
			]
		] );

		// Show Category
		$this->add_control(
			'category_show',
			[
				'label'        => __( 'Show Category', 'gpt-news-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'gpt-news-core' ),
				'label_off'    => __( 'Hide', 'gpt-news-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'category_typography',
			'label'    => __( 'Typography', 'gpt-news-core' ),
			'selector' => '{{WRAPPER}} .gpt__blog-meta-category',
		] );

		// Padding

		$this->add_responsive_control(
			'category_padding',
			[
				'label'      => __( 'Padding', 'gpt-news-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .gpt__blog-meta-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Margin
		$this->add_responsive_control(
			'category_margin',
			[
				'label'      => __( 'Margin', 'gpt-news-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .gpt__blog-meta-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Border radius
		$this->add_responsive_control(
			'category_border_radius',
			[
				'label'      => __( 'Border Radius', 'gpt-news-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .gpt__blog-meta-category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Normal and Hover Color
		$this->start_controls_tabs( 'category_tabs' );

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'textdomain' ),
			]
		);

		$this->add_control( 'category_color', [
			'label'     => __( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt__blog-meta-category' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'category_bg_color', [
			'label'     => __( 'Background Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt__blog-meta-category' => 'background-color: {{VALUE}}',
			],
		] );

		$this->end_controls_tab();


		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'textdomain' ),
			]
		);

		$this->add_control( 'category_hover_color', [
			'label'     => __( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt__blog-meta-category:hover' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'category_hover_bg_color', [
			'label'     => __( 'Background Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt__blog-meta-category:hover' => 'background-color: {{VALUE}}',
			],
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
				'{{WRAPPER}} .gpt-post__item, {{WRAPPER}} .gpt__post-list' => 'background: {{VALUE}}',
			],
		] );

		// Overlay Color
		$this->add_control(
			'blog_overlay_color',
			[
				'label'     => __( 'Overlay Color', 'gpt-news-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt__post-list .gpt__feature-image:after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => 'list'
				]
			]
		);

		$this->add_responsive_control(
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

		// Margin
		$this->add_responsive_control(
			'blog_margin',
			[
				'label'      => __( 'Margin', 'gpt-news-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .gpt-post__item, {{WRAPPER}} .gpt__post-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'blog_border',
				'label'    => __( 'Border', 'gpt-news-core' ),
				'selector' => '{{WRAPPER}} .gpt-post__item',
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
				'name'     => 'blog_shadow_hover',
				'label'    => __( 'Hover Box Shadow', 'gpt-news-core' ),
				'selector' => '{{WRAPPER}} .gpt-post__item, {{WRAPPER}} .gpt__post-list',
			]
		);

		// Blog Footer Border Color
		$this->add_control( 'blog_footer_border_color', [
			'label'     => __( 'Footer Border Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-post__footer' => 'border-top-color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();

	}

	protected function render() {

		$settings   = $this->get_settings_for_display();
		$post_cat   = $settings['post_cat'];
		$post_count = $settings['post_count'];


		$this->add_render_attribute( 'wrapper', 'class', [
			'gpt-post-items blog-grid',
		] );


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

		// Include
		if ( $settings['include'] ) {
			$_tax_query = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'slug',
					'terms'    => explode( ',', $settings['include'] ),
				)
			);
		}

		// Exclude
		if ( $settings['exclude'] ) {
			$_tax_query = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'slug',
					'terms'    => explode( ',', $settings['exclude'] ),
					'operator' => 'NOT IN'
				)
			);
		}

		$paged = 1;
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		}
		if ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		}


		$query = array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => 5, // Total number of posts to fetch
			'paged'          => $paged,
			'tax_query'      => $_tax_query,
			'orderby'        => $settings['orderby'],
			'order'          => $settings['order'],
			'offset'         => $settings['offset'],
		);

		$gpt_query = new \WP_Query( $query );
		?>

		<div class="blog-post-items">
			<div class="row g-4">
				<?php
				if ( $gpt_query->have_posts() ) :
					$count = 0; // Counter to track posts
					?>

					<?php while ( $gpt_query->have_posts() ) : $gpt_query->the_post(); ?>

					<?php
					// Display first two posts in separate columns
					if ( $count < 1 ) : ?>
						<div class="col-lg-6 col-md-12">
							<div class="blog-grid">
								<div class="blog-grid__image">
									<a href="<?php the_permalink(); ?>">
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) );
										} else { ?>
											<img src="https://via.placeholder.com/410x290" alt="Placeholder">
										<?php } ?>
									</a>
								</div>
								<div class="blog-grid__content">
									<h3 class="blog-grid__title blog-title-hover">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>

									<div class="blog-grid__excerpt">
										<?php echo wp_trim_words( get_the_content(), $settings['content_length'], '...' ); ?>
									</div>

									<ul class="entry-meta">
										<li>
											<?php \Gpt_Theme_Helper::post_author_by(); ?>
										</li>
										<li>
											<i class="ri-calendar-2-line"></i>
											<?php \Gpt_Theme_Helper::gpt_posted_on(); ?>
										</li>
									</ul><!-- .entry-meta -->
								</div>
							</div>
						</div>

					<?php
					// Display the last two posts in the third column
					elseif ( $count == 1 ) : ?>
						<div class="col-lg-6 col-md-12">
						<div class="row">
					<?php endif; ?>

					<?php if ( $count >= 1 ) : ?>
						<div class="col-sm-6">
							<div class="blog-grid__small-list">
								<div class="blog-grid__image">
									<a href="<?php the_permalink(); ?>">
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) );
										} else { ?>
											<img src="https://via.placeholder.com/410x290" alt="Placeholder">
										<?php } ?>
									</a>
								</div>
								<div class="blog-grid__content">
									<h3 class="blog-grid__title blog-title-hover">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>
									<div class="blog-grid__meta">

										<ul class="entry-meta">
											<li>
												<i class="ri-calendar-2-line"></i>
												<?php \Gpt_Theme_Helper::gpt_posted_on(); ?>
											</li>
										</ul><!-- .entry-meta -->
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( $count == 4 ) : ?>
						</div>
						</div> <!-- Close third column after the second post -->
					<?php endif; ?>

					<?php $count ++; ?>
				<?php endwhile; ?>

					<?php
					wp_reset_postdata();
				endif;
				?>
			</div>
		</div>


		<?php

	}
}
