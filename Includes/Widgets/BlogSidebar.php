<?php

namespace GpTheme\GptNewsCore\Widgets;

use Elementor\{Controls_Manager, Group_Control_Background, Group_Control_Border, Group_Control_Box_Shadow, Widget_Base, Group_Control_Typography};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class BlogSidebar extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'gpt-sidebar';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'GPT Blog Sidebar', 'gpt-news-core' );
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

		// Blog Query Type Recent, Popular, Random
		$this->add_control( 'blog_query_type', [
			'label'   => esc_html__( 'Query Type', 'gpt-news-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'recent',
			'options' => [
				'recent'  => esc_html__( 'Recent', 'gpt-news-core' ),
				'popular' => esc_html__( 'Popular', 'gpt-news-core' ),
				'random'  => esc_html__( 'Random', 'gpt-news-core' ),
			],
		] );


		$this->add_control( 'post_count', [
			'label'   => esc_html__( 'Post count', 'gpt-news-core' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => esc_html__( '5', 'gpt-news-core' ),
		] );

		// Show date meta
		$this->add_control( 'show_date_meta', [
			'label'        => esc_html__( 'Show Date Meta', 'gpt-news-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Yes', 'gpt-news-core' ),
			'label_off'    => esc_html__( 'No', 'gpt-news-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		// Show view count meta
		$this->add_control( 'show_view_count_meta', [
			'label'        => esc_html__( 'Show View Count Meta', 'gpt-news-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Yes', 'gpt-news-core' ),
			'label_off'    => esc_html__( 'No', 'gpt-news-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
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

	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$post_cat   = $settings['post_cat'];
		$post_count = $settings['post_count'];
		$query_type = $settings['blog_query_type']; // Get the query type

		$this->add_render_attribute( 'wrapper', 'class', [ 'gpt-post-items blog-grid' ] );

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

		// Determine query arguments based on selected query type
		switch ( $query_type ) {
			case 'popular':
				$query_args = array(
					'post_type'      => 'post',
					'post_status'    => 'publish',
					'posts_per_page' => $post_count,
					'tax_query'      => $_tax_query,
					'meta_key'       => 'post_views_count', // Assuming you have a meta key to track views
					'orderby'        => 'meta_value_num',    // Order by the number of views
					'order'          => 'DESC',
				);
				break;

			case 'random':
				$query_args = array(
					'post_type'      => 'post',
					'post_status'    => 'publish',
					'posts_per_page' => $post_count,
					'tax_query'      => $_tax_query,
					'orderby'        => 'rand',  // Random order
				);
				break;

			default: // 'recent' (default)
				$query_args = array(
					'post_type'      => 'post',
					'post_status'    => 'publish',
					'posts_per_page' => $post_count,
					'tax_query'      => $_tax_query,
					'orderby'        => 'date',  // Order by recent posts
					'order'          => $settings['order'],
				);
				break;
		}

		// Offset
		if ( $settings['offset'] ) {
			$query_args['offset'] = $settings['offset'];
		}

		$gpt_query = new \WP_Query( $query_args );
		?>
		<div class="blog-post-items">
			<?php if ( $gpt_query->have_posts() ) : ?>
				<?php while ( $gpt_query->have_posts() ) : $gpt_query->the_post(); ?>
					<div class="blog-list">
						<div class="blog-list__image">
							<a href="<?php the_permalink(); ?>">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'gpt-blog-list_300x185', [ 'alt' => get_the_title() ] );
								} else { ?>
									<img src="https://via.placeholder.com/410x290" alt="Placeholder">
								<?php } ?>
							</a>
						</div>
						<div class="blog-list__content">
							<h3 class="blog-list__title blog-title-hover">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>

							<div class="meta-wrapper">
								<ul class="entry-meta">
									<?php if ( $settings['show_date_meta'] ) : ?>
										<li>
											<i class="ri-calendar-2-line"></i>
											<?php \Gpt_Theme_Helper::gpt_posted_on(); ?>
<!--										</li>-->
									<?php endif; ?>
									<?php if ( $settings['show_view_count_meta'] ) : ?>
										<li>
											<i class="ri-eye-line"></i>
											<span><?php echo get_post_meta( get_the_ID(), 'post_views_count', true ); ?> Views</span>
										</li>
									<?php endif; ?>
								</ul><!-- .entry-meta -->
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>
		<?php
	}

}
