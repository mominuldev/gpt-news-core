<?php

namespace GpTheme\GptNewsCore\Widgets;

use Elementor\{Controls_Manager, Group_Control_Background, Group_Control_Border, Group_Control_Box_Shadow, Widget_Base, Group_Control_Typography};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class BlogList extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'gpt-blog-list';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'GPT Blog List', 'gpt-news-core' );
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
		return [ 'blog', 'list', 'gpt' ];
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
			'type'    => Controls_Manager::SELECT,
			'default' => '4',
			'options' => [
				'3' => esc_html__( '3', 'gpt-news-core' ),
				'4' => esc_html__( '4', 'gpt-news-core' ),
			]

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
			'label'    => __( 'Typography', 'gpt-news-core' ),
			'selector' => '{{WRAPPER}} .blog-grid--two .entry-meta li, {{WRAPPER}} .blog-grid--two .entry-meta li a',
		] );

		$this->add_control( 'meta_text_color', [
			'label'     => __( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .blog-grid--two .entry-meta li, {{WRAPPER}} .blog-grid--two .entry-meta li a' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'date_title_color_hover', [
			'label'     => __( 'Hover Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .blog-grid--two .entry-meta li a:hover' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'meta_icon_color', [
			'label'     => __( 'Icon Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .blog-grid--two .entry-meta li i' => 'color: {{VALUE}}',
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
			'selector' => '{{WRAPPER}} .blog-grid__title',
		] );

		$this->add_control( 'title_color', [
			'label'     => __( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .blog-grid__title a' => 'color: {{VALUE}}',
			],
		] );


		// Hover Color
		$this->add_control( 'title_hover_color', [
			'label'     => __( 'Hover Background Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .blog-grid .blog-grid__title a' => 'background-image: linear-gradient(to bottom, {{VALUE}} 0%, {{VALUE}} 98%);',
				'{{WRAPPER}} .blog-grid:hover .blog-grid__title a' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();

		// Content Style
		//=====================
		$this->start_controls_section( 'content_section', [
			'label' => __( 'Content', 'gpt-news-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'content_typography',
			'label'    => __( 'Typography', 'gpt-news-core' ),
			'selector' => '{{WRAPPER}} .blog-grid__excerpt',
		] );

		$this->add_control( 'content_color', [
			'label'     => __( 'Color', 'gpt-news-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .blog-grid__excerpt' => 'color: {{VALUE}}',
			],
		] );

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
				'{{WRAPPER}} .blog-grid--two' => 'background: {{VALUE}}',
			],
		] );


		$this->add_responsive_control(
			'blog_padding',
			[
				'label'      => __( 'Padding', 'gpt-news-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .blog-grid__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .gpt-grid--two' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'blog_border',
				'label'    => __( 'Border', 'gpt-news-core' ),
				'selector' => '{{WRAPPER}} .blog-grid--two',
			]
		);

		$this->add_control(
			'blog_border_radius',
			[
				'label'      => __( 'Border Radius', 'gpt-news-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}}  .blog-grid--two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'blog_shadow_hover',
				'label'    => __( 'Hover Box Shadow', 'gpt-news-core' ),
				'selector' => '{{WRAPPER}} .blog-grid--two',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings   = $this->get_settings_for_display();
		$post_cat   = $settings['post_cat'];
		$post_count = $settings['post_count'];
		$meta_show  = $settings['meta_show'];


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
			'posts_per_page' => $post_count,
			'paged'          => $paged,
			'tax_query'      => $_tax_query,
			'orderby'        => $settings['orderby'],
			'order'          => $settings['order'],
			'offset'         => $settings['offset'],
		);

		$gpt_query = new \WP_Query( $query );
		?>

		<div class="blog-post-items">

			<?php
			if ( $gpt_query->have_posts() ) :
				$count = 0; // Counter to track posts
				?>

				<?php while ( $gpt_query->have_posts() ) : $gpt_query->the_post(); ?>

				<?php
				// Display first two posts in separate columns
				if ( $count < 1 ) : ?>
					<div class="blog-list-main">
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

							<?php if ( $meta_show == 'yes' ) : ?>
								<ul class="entry-meta">
									<li>
										<i class="ri-calendar-2-line"></i>
										<?php \Gpt_Theme_Helper::gpt_posted_on(); ?>
									</li>
								</ul><!-- .entry-meta -->
							<?php endif; ?>
						</div>
					</div>
				<?php
				// Display the last two posts in the third column
				elseif ( $count == 1 ) : ?>
					<div class="blog-list-wrapper">

				<?php endif; ?>

				<?php if ( $count >= 1 ) : ?>

					<div class="blog-list__small-list">
						<div class="blog-list__image">
							<a href="<?php the_permalink(); ?>">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) );
								} else { ?>
									<img src="https://via.placeholder.com/410x290" alt="Placeholder">
								<?php } ?>
							</a>
						</div>
						<div class="blog-list__content">
							<h3 class="blog-list__title blog-title-hover">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>

							<?php if ( $meta_show == 'yes' ) : ?>
								<ul class="entry-meta">
									<li>
										<i class="ri-calendar-2-line"></i>
										<?php \Gpt_Theme_Helper::gpt_posted_on(); ?>
									</li>
								</ul><!-- .entry-meta -->
							<?php endif; ?>
						</div>
					</div>

				<?php endif; ?>

				<?php if ( $count === 2 && $post_count == 3 ) : ?>

					</div> <!-- Close third column after the second post -->
				<?php elseif ( $count === 3 ) : ?>
					</div> <!-- Close third column after the second post -->
				<?php endif; ?>

				<?php $count ++; ?>
			<?php endwhile; ?>

				<?php
				wp_reset_postdata();
			endif;
			?>

		</div>


		<?php

	}
}
