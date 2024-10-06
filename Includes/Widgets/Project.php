<?php

namespace GpTheme\GptNewsCore\Widgets;

use Elementor\{Group_Control_Border,
	Controls_Manager,
	Group_Control_Box_Shadow,
	Widget_Base
};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Project extends Widget_Base {

	// Constructor
//	public function __construct() {
//		parent::__construct();
//		add_action('gpt_cursor', [$this, 'render_cursor']);
//	}

	/**
	 * Get widget name.
	 * Retrieve alert widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'gpt-project';
	}

	public function get_title() {
		return __( 'MPT Project', 'gpt-core' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-photo-library';
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

		$this->start_controls_section(
			'section_query',
			[
				'label' => __( 'Project', 'gpt-core' ),
			]
		);


		// Show Category
		$this->add_control( 'show_category', [
			'label'        => esc_html__( 'Show Category', 'gpt-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Show', 'gpt-core' ),
			'label_off'    => esc_html__( 'Hide', 'gpt-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		// Show Excerpt
		$this->add_control( 'show_excerpt', [
			'label'        => esc_html__( 'Show Excerpt', 'gpt-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Show', 'gpt-core' ),
			'label_off'    => esc_html__( 'Hide', 'gpt-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		//excerpt_length
		$this->add_control( 'excerpt_length', [
			'label'       => esc_html__( 'Excerpt Length', 'gpt-core' ),
			'type'        => Controls_Manager::NUMBER,
			'default'     => 20,
			'placeholder' => esc_html__( '20', 'gpt-core' ),
		] );

		// Show Button
		$this->add_control( 'show_button', [
			'label'        => esc_html__( 'Show Button', 'gpt-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Show', 'gpt-core' ),
			'label_off'    => esc_html__( 'Hide', 'gpt-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		// Button Text
		$this->add_control( 'button_text', [
			'label'       => esc_html__( 'Button Text', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'View Project', 'gpt-core' ),
			'placeholder' => esc_html__( 'View Project', 'gpt-core' ),
		] );


		$this->end_controls_section();


		// Pagination Settings
		// =====================
		$this->start_controls_section( 'pagination_section', [
			'label' => esc_html__( 'Pagination', 'gpt-core' ),
		] );

		$this->add_control( 'pagination_type', [
			'label'   => esc_html__( 'Pagination', 'gpt-core' ),
			'type'    => Controls_Manager::SELECT,
			'options' => array(
				''          => esc_html__( 'None', 'gpt-core' ),
				'numbers'   => esc_html__( 'Numbers', 'gpt-core' ),
				'load-more' => esc_html__( 'Button', 'gpt-core' ),

			),
			'default' => '',
		] );

		$this->add_control( 'load_more_text', [
			'label'       => esc_html__( 'Load More Button Text', 'gpt-core' ),
			'description' => esc_html__( 'Input custom text to load more button', 'gpt-core' ),
			'default'     => __( 'Load More', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'condition'   => [
				'pagination_type' => 'load-more',
			],
		] );

		$this->add_control( 'loading_text', [
			'label'       => esc_html__( 'Loading Text', 'gpt-core' ),
			'description' => esc_html__( 'Input custom text to show loading', 'gpt-core' ),
			'default'     => __( 'Loading...', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'condition'   => [
				'pagination_type' => 'load-more',
			],
		] );

		$this->add_control( 'end_text', [
			'label'       => esc_html__( 'End Text', 'gpt-core' ),
			'description' => esc_html__( 'Input custom text to show end of posts', 'gpt-core' ),
			'default'     => __( 'All Projects Displayed', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'condition'   => [
				'pagination_type' => 'load-more',
			],
		] );

		$this->add_responsive_control(
			'load_btn_margin',
			[
				'label'      => __( 'Margin', 'gpt-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
					'em' => [
						'min'  => 0,
						'max'  => 10,
						'step' => 0.1,
					],
					'%'  => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .project-pagination-wrapper' => 'margin: {{TOP}}{{UNIT}};',
				],

			]
		);

		$this->end_controls_section();


		// Query Settings
		// =====================
		$this->start_controls_section( 'query_section', [
			'label' => esc_html__( 'Query', 'gpt-core' ),
		] );

		$this->add_control(
			'posts_per_page',
			[
				'label'       => esc_html__( 'Items per page', 'gpt-core' ),
				'description' => esc_html__( 'Number of items to show per page. Input "-1" to show all posts. Leave blank to use global setting.',
					'gpt-core' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => '6',
				'min'         => - 1,
				'max'         => 100,
				'step'        => 1,
			]
		);
		$this->add_control(
			'project_cat',
			[
				'label'       => esc_html__( 'Select category', 'gpt-core' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options'     => \MPT_helper::gpt_category_list( 'project_category' ),
				'default'     => '0'
			]
		);

		$this->add_control(
			'order_by',
			[
				'label'       => __( 'Order by', 'gpt-core' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'date'           => esc_html__( 'Date', 'gpt-core' ),
					'ID'             => esc_html__( 'Post ID', 'gpt-core' ),
					'author'         => esc_html__( 'Author', 'gpt-core' ),
					'title'          => esc_html__( 'Title', 'gpt-core' ),
					'modified'       => esc_html__( 'Last modified date', 'gpt-core' ),
					'parent'         => esc_html__( 'Post/page parent ID', 'gpt-core' ),
					'comment_count'  => esc_html__( 'Number of comments', 'gpt-core' ),
					'menu_order'     => esc_html__( 'Menu order/Page Order', 'gpt-core' ),
					'meta_value'     => esc_html__( 'Meta value', 'gpt-core' ),
					'meta_value_num' => esc_html__( 'Meta value number', 'gpt-core' ),
					'rand'           => esc_html__( 'Random order', 'gpt-core' ),
				],
				'default'     => 'date',
				'separator'   => 'before',
				'description' => esc_html__( "Select how to sort retrieved posts. More at ",
						'gpt-core' ) . '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.',
			]
		);

		$this->add_control(
			'order',
			[
				'label'       => __( 'Sort Order', 'gpt-core' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'ASC'  => esc_html__( 'Ascending', 'gpt-core' ),
					'DESC' => esc_html__( 'Descending', 'gpt-core' ),
				],
				'default'     => 'DESC',
				'separator'   => 'before',
				'description' => esc_html__( "Select Ascending or Descending order. More at",
						'gpt-core' ) . '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.',
			]
		);

		$this->end_controls_section();


		// Style Settings
		// =====================

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Portfolio Style', 'gpt-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-project__title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'gpt-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-project__title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .gpt-project__title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'cat_typography',
				'label'    => __( 'Category Typography', 'gpt-core' ),
				'selector' => '{{WRAPPER}} .gpt-project__category a',
			]
		);

		$this->add_control(
			'cat_color',
			[
				'label'     => __( 'Category Color', 'gpt-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-project__category a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// Style Settings
		// =====================


		// Title
		// =====================
		$this->start_controls_section(
			'portfolio_title_style_section',
			[
				'label' => __( 'Portfolio Title', 'gpt-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'portfolio_title_color',
			[
				'label'     => __( 'Color', 'gpt-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-project__title' => 'color: {{VALUE}}',
				],
			]
		);

		// End Section
		$this->end_controls_section();

		// Portfolio Container Style
		// =====================
		$this->start_controls_section(
			'portfolio_container_style_section',
			[
				'label' => __( 'Portfolio Container', 'gpt-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'portfolio_container_background',
			[
				'label'     => __( 'Background', 'gpt-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gpt-project__wrapper' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'portfolio_container_padding',
			[
				'label'      => __( 'Padding', 'gpt-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .gpt-project__info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'portfolio_container_box_shadow',
				'selector' => '{{WRAPPER}} .gpt-project__wrapper',
			]
		);

		// Border Radius
		$this->add_responsive_control(
			'portfolio_container_border_radius',
			[
				'label'      => __( 'Border Radius', 'gpt-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .gpt-project__wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'portfolio_container_border',
				'selector' => '{{WRAPPER}} .gpt-project__wrapper',
			]
		);

		// End Section
		$this->end_controls_section();


	}

	protected function render() {
		$settings = $this->get_settings_for_display();


		$cat_list = $settings['project_cat'];


		// Query
		$paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;

		$args = array(
			'post_type'      => 'project',
			'paged'          => $paged,
			'order'          => $settings['order'],
			'orderby'        => $settings['order_by'],
			'posts_per_page' => $settings['posts_per_page'],
			'post_status'    => 'publish',
		);

		if ( $settings['project_cat'] ) {
			$args['tax_query'] = array(
				array(
					'taxonomy'   => 'project_category',
					'field'      => 'slug',
					'terms'      => $cat_list,
					'hide_empty' => true,
				)
			);
		}

		$gpt_query = new \WP_Query( $args );

		$args = array(
			'hide_empty' => true,
			'taxonomy'   => 'project_category',
		);

		if ( $settings['project_cat'] ) {
			$args['slug'] = $cat_list;
		}

		$terms = get_terms( $args );

		$this->add_render_attribute( 'wrapper', 'class', [
			'products__list',
			'cursor-products',
			'at-element'
		] );

		$index     = 1;



		$project_settings = $this->project_settings( $settings );
		$this->add_render_attribute( 'wrapper', 'data-settings', wp_json_encode( $project_settings ) );
		$this->add_render_attribute( 'wrapper', 'data-at-name', 'atItemsColumnSelf' );
		$this->add_render_attribute( 'wrapper', 'data-at-selector', '.products__item' );

		if ( ! empty( $settings['pagination_type'] ) && $gpt_query->found_posts > $settings['posts_per_page'] ) {
			$this->add_render_attribute( 'wrapper', 'data-pagination', $settings['pagination_type'] );
		}
		?>

		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<?php if ( $gpt_query->have_posts() ) : ?>
				<?php while ( $gpt_query->have_posts() ) : $gpt_query->the_post(); ?>
					<?php

					$meta         = get_post_meta( get_the_ID(), 'gpt_project_options', true );
					$project_link = isset( $meta['project_link'] ) ? $meta['project_link'] : '';

					?>

					<div class="products__item toogles__item-title" data-image="<?php echo esc_attr($index); ?>" data-toogles="<?php echo esc_attr($index); ?>">
						<?php require __DIR__ . '/templates/project/style-2.php'; ?>
					</div>

					<?php $index ++; ?>
				<?php endwhile; ?>

				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'gpt-core' ); ?></p>
			<?php endif; ?>
		</div>

		<?php $this->print_pagination( $gpt_query, $settings );

		add_action('gpt_cursor', function() { ?>



			<?php if ( $gpt_query->have_posts() ) : ?>
				<?php while ( $gpt_query->have_posts() ) : $gpt_query->the_post(); ?>
					<?php
						$image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
					?>

					<div class="cursor__products">
						<div class="products__images">
							<div class="products__image" data-image="<?php echo esc_attr($index); ?>">
								<picture>
									<img src="<?php echo esc_url($image_url); ?>" alt="Responsive image"/>
								</picture>
							</div>

						</div>
					</div>
					<?php $index ++; ?>
				<?php endwhile; ?>
			<?php endif; ?>
		<?php
		});

	}


	protected function print_pagination( $gpt_query, $settings ) {
		$number          = $settings['posts_per_page'];
		$pagination_type = $settings['pagination_type'];
		$load_text       = $settings['load_more_text'];

		if ( $pagination_type !== '' && $gpt_query->found_posts > $number ) {
			?>
			<div class="container text-center">
				<div class="project-pagination-wrapper">
					<?php if ( in_array( $pagination_type, array(
						'load-more',
						'navigation',
					), true ) ) { ?>

						<?php if ( $pagination_type === 'load-more' ) { ?>
							<?php $this->gpt_ajax_more_project_post_init( $gpt_query, $settings ); ?>
							<div id="gpt-load-more-btn" class="gpt-load-more">
								<button class="gpt-btn btn-round"><?php echo esc_html( $load_text ); ?></button>
							</div>
						<?php } ?>

					<?php } elseif ( $pagination_type === 'numbers' ) { ?>
						<?php \MPT_Helper::paging_nav( $gpt_query ); ?>
					<?php } ?>

				</div>
			</div>
			<!-- /.container -->
			<?php
		}
	}

	/**
	 * Generates ajax pagination html with Load more button and localizes required script.
	 * @return string pagination html
	 */
	protected function gpt_ajax_more_project_post_init( $gpt_query, $settings ) {
		global $wp_query;

		// Queue JS
		wp_enqueue_script( 'load-more', MPT_SCRIPTS . '/project-load-more.js', array( 'jquery' ), MPT_CORE_VERSION, true );

		// What page are we on? And what is the pages limit?


		if ( is_tax( 'project_category' ) ) {
			$max = $wp_query->max_num_pages;
		} else {
			$loop = $gpt_query;
			$max  = $loop->max_num_pages;
		}

		$more_text    = $settings['load_more_text'];
		$loading_text = $settings['loading_text'];
		$end_text     = $settings['end_text'];

		// Add some parameters for the JS.
		wp_localize_script(
			'load-more',
			'gpt_var',
			array(
				'more_text'    => $more_text,
				'loading_text' => $loading_text,
				'end_text'     => $end_text,
				'nonce'        => wp_create_nonce( 'gpt-load-more-nonce' ),
				'ajaxurl'      => admin_url( 'admin-ajax.php' )
			)
		);

	}

	public function project_settings( $settings ) {

		$options = [];

		if ( $settings['order'] ) {
			$options['order'] = $settings['order'];
		}

		if ( $settings['order_by'] ) {
			$options['orderby'] = $settings['order_by'];
		}

		if ( $settings['posts_per_page'] ) {
			$options['posts_per_page'] = $settings['posts_per_page'];
		}


		// Show Category
		if ( $settings['show_category'] ) {
			$options['show_category'] = $settings['show_category'];
		}

		// Show Excerpt
		if ( $settings['show_excerpt'] ) {
			$options['show_excerpt'] = $settings['show_excerpt'];
		}

		//excerpt_length
		if ( $settings['excerpt_length'] ) {
			$options['excerpt_length'] = $settings['excerpt_length'];
		}

		// Show Button
		if ( $settings['show_button'] ) {
			$options['show_button'] = $settings['show_button'];
		}

		// Button Text
		if ( $settings['button_text'] ) {
			$options['button_text'] = $settings['button_text'];
		}

		// Post Per Page
		if ( $settings['posts_per_page'] ) {
			$options['posts_per_page'] = $settings['posts_per_page'];
		}

		// project_cat
		if ( $settings['project_cat'] ) {
			$options['project_cat'] = $settings['project_cat'];
		}

		return $options;

	}

	// Method to be called by the 'gpt_cursor' action
	public function render_cursor() {
		echo 'Hello, World!';
	}
}