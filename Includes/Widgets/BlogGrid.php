<?php

namespace PixelPath\PPSPassportCore\Widgets;

use Elementor\{Controls_Manager, Group_Control_Background, Group_Control_Border, Group_Control_Box_Shadow, Widget_Base, Group_Control_Typography};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class BlogGrid extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'pps-blog';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'PPS Blog Grid', 'pps-passport-core' );
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
		return [ 'pps-elements' ];
	}

	/**
	 * Get widget keywords.
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'blog', 'grid', 'post' ];
	}

	/**
	 * Register widget controls.
	 * @since 1.0.0
	 */
	protected function register_controls() {
		// Testimonial
		//=========================
		$this->start_controls_section( 'section_tab_style', [
			'label' => esc_html__( 'Blog Grid', 'pps-passport-core' ),
		] );

		// Layout
		$this->add_control( 'layout', [
			'label'   => esc_html__( 'Layout', 'pps-passport-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => '1',
			'options' => [
				'1' => esc_html__( 'Style One', 'pps-passport-core' ),
				'2' => esc_html__( 'Style Two', 'pps-passport-core' ),
				'3' => esc_html__( 'Style Three', 'pps-passport-core' ),
			]
		] );

		// Column
		$this->add_control( 'column', [
			'label'   => esc_html__( 'Column', 'pps-passport-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => '4',
			'options' => [
				'6' => esc_html__( '2 Column', 'pps-passport-core' ),
				'4' => esc_html__( '3 Column', 'pps-passport-core' ),
				'3' => esc_html__( '4 Column', 'pps-passport-core' ),
			]
		] );

		$this->add_control( 'post_count', [
			'label'   => esc_html__( 'Post count', 'pps-passport-core' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => esc_html__( '3', 'pps-passport-core' ),

		] );

		// Excerpt Show
		$this->add_control( 'excerpt_show', [
			'label'        => esc_html__( 'Show Excerpt', 'pps-passport-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Yes', 'pps-passport-core' ),
			'label_off'    => esc_html__( 'No', 'pps-passport-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );


		$this->add_control( 'content_length', [
			'label'   => __( 'Word Limit', 'pps-passport-core' ),
			'type'    => \Elementor\Controls_Manager::NUMBER,
			'min'     => 5,
			'max'     => 30,
			'step'    => 1,
			'default' => 15,
			'condition' => [
				'excerpt_show' => 'yes',
			],
		] );

		// category_show
		$this->add_control( 'category_show', [
			'label'        => esc_html__( 'Show Category', 'pps-passport-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Yes', 'pps-passport-core' ),
			'label_off'    => esc_html__( 'No', 'pps-passport-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		// Show Read More button
		$this->add_control( 'readmore_show', [
			'label'        => esc_html__( 'Show Read More Button', 'pps-passport-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Yes', 'pps-passport-core' ),
			'label_off'    => esc_html__( 'No', 'pps-passport-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_control( 'read_more_text', [
			'label'       => __( 'Read More Button text' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter button text here' ),
			'default'     => __( 'Read More', 'pps-passport-core' ),
			'label_block' => true
		] );

		$this->end_controls_section();

		// Query
		//=========================
		$this->start_controls_section( 'section_query', [
			'label' => esc_html__( 'Query', 'pps-passport-core' ),
		] );

		$this->add_control( 'post_cat', [
			'label'       => esc_html__( 'Select category', 'pps-passport-core' ),
			'type'        => Controls_Manager::SELECT2,
			'multiple'    => true,
			'label_block' => true,
			'options'     => \PPS_Helper::categories_suggester(),
			'default'     => '0'
		] );

		$this->add_control( 'order', [
			'label'   => esc_html__( 'Order', 'pps-passport-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'DESC',
			'options' => [
				'ASC'  => esc_html__( 'ASC', 'pps-passport-core' ),
				'DESC' => esc_html__( 'DESC', 'pps-passport-core' ),
			]
		] );

		$this->add_control( 'orderby', [
			'label'   => esc_html__( 'Order By', 'pps-passport-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'date',
			'options' => [
				'date'          => esc_html__( 'Date', 'pps-passport-core' ),
				'title'         => esc_html__( 'Title', 'pps-passport-core' ),
				'rand'          => esc_html__( 'Random', 'pps-passport-core' ),
				'comment_count' => esc_html__( 'Comment Count', 'pps-passport-core' ),
			]
		] );

		// Offset
		$this->add_control( 'offset', [
			'label'   => esc_html__( 'Offset', 'pps-passport-core' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => 0,
		] );

		// Exclude
		$this->add_control( 'exclude', [
			'label'   => esc_html__( 'Exclude', 'pps-passport-core' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '',
		] );

		// Include
		$this->add_control( 'include', [
			'label'   => esc_html__( 'Include', 'pps-passport-core' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '',
		] );


		$this->end_controls_section();

		// Blog Meta Style
		//====================
		$this->start_controls_section( 'background_shape', [
			'label' => __( 'Meta', 'pps-passport-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'meta_show', [
			'label'        => __( 'Show Post meta', 'pps-passport-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'pps-passport-core' ),
			'label_off'    => __( 'No', 'pps-passport-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'meta_text_typography',
			'label'    => __( 'Typography', 'pps-passport-core' ),
			'selector' => '{{WRAPPER}} .blog-grid--two .entry-meta li, {{WRAPPER}} .blog-grid--two .entry-meta li a',
		] );

		$this->add_control( 'meta_text_color', [
			'label'     => __( 'Color', 'pps-passport-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .blog-grid--two .entry-meta li, {{WRAPPER}} .blog-grid--two .entry-meta li a' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'date_title_color_hover', [
			'label'     => __( 'Hover Color', 'pps-passport-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .blog-grid--two .entry-meta li a:hover' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'meta_icon_color', [
			'label'     => __( 'Icon Color', 'pps-passport-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .blog-grid--two .entry-meta li i' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();

		// Title Style
		//=====================
		$this->start_controls_section( 'name_section', [
			'label' => __( 'Title', 'pps-passport-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => __( 'Typography', 'pps-passport-core' ),
			'selector' => '{{WRAPPER}} .blog-grid__title',
		] );

		$this->add_control( 'title_color', [
			'label'     => __( 'Color', 'pps-passport-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .blog-grid__title a' => 'color: {{VALUE}}',
			],
		] );


		// Hover Color
		$this->add_control( 'title_hover_color', [
			'label'     => __( 'Hover Background Color', 'pps-passport-core' ),
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
			'label' => __( 'Content', 'pps-passport-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'content_typography',
			'label'    => __( 'Typography', 'pps-passport-core' ),
			'selector' => '{{WRAPPER}} .blog-grid__excerpt',
		] );

		$this->add_control( 'content_color', [
			'label'     => __( 'Color', 'pps-passport-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .blog-grid__excerpt' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();

		// Style Slider Control Section
		//================================
		$this->start_controls_section( 'blog_section', [
			'label' => __( 'Blog Container', 'pps-passport-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'blog_bg_color', [
			'label'     => __( 'Background Color', 'pps-passport-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .blog-grid--two' => 'background: {{VALUE}}',
			],
		] );


		$this->add_responsive_control(
			'blog_padding',
			[
				'label'      => __( 'Padding', 'pps-passport-core' ),
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
				'label'      => __( 'Margin', 'pps-passport-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .pps-grid--two' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'blog_border',
				'label'    => __( 'Border', 'pps-passport-core' ),
				'selector' => '{{WRAPPER}} .blog-grid--two',
			]
		);

		$this->add_control(
			'blog_border_radius',
			[
				'label'      => __( 'Border Radius', 'pps-passport-core' ),
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
				'label'    => __( 'Hover Box Shadow', 'pps-passport-core' ),
				'selector' => '{{WRAPPER}} .blog-grid--two',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings   = $this->get_settings_for_display();
		$post_cat   = $settings['post_cat'];
		$post_count = $settings['post_count'];
		$meta_show = $settings['meta_show'];


		$this->add_render_attribute( 'wrapper', 'class', [
			'pps-post-items blog-grid',
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
			'posts_per_page' => $post_count, // Total number of posts to fetch
			'paged'          => $paged,
			'tax_query'      => $_tax_query,
			'orderby'        => $settings['orderby'],
			'order'          => $settings['order'],
			'offset'         => $settings['offset'],
		);

		$pps_query = new \WP_Query( $query );
		?>

		<div class="blog-post-items">
			<div class="row g-4">
				<?php if ( $pps_query->have_posts() ) : ?>

					<?php while ( $pps_query->have_posts() ) : $pps_query->the_post(); ?>
						<div class="col-sm-6 col-lg-<?php echo $settings['column'] ?> col-md-4">
							<?php require  __DIR__ . '/templates/blog/blog-style-'. $settings['layout'].'.php'; ?>
						</div>


				<?php endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
		</div>


		<?php

	}
}
