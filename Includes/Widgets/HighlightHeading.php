<?php

namespace GpTheme\GptNewsCore\Widgets;

use Elementor\{Controls_Manager, Group_Control_Border, Group_Control_Box_Shadow, Widget_Base, Group_Control_Typography, Repeater};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Class ContactInfo
 * @package GpTheme\GptNewsCore\Widgets
 */
class HighlightHeading extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve Team widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'gpt-highlight-heading';
	}

	/**
	 * Get widget title.
	 * Retrieve Team widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'MPT Highlight Heading', 'gpt-core' );
	}

	/**
	 * Get widget icon.
	 * Retrieve Team widget icon.
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		return 'eicon-info-circle-o';
	}

	/**
	 * Get widget categories.
	 * Retrieve the list of categories the Team widget belongs to.
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories() {
		return [ 'gpt-elements' ];
	}

	/**
	 * Get widget keywords.
	 * Retrieve the list of keywords the widget belongs to.
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'highlight text', 'gpt heading' ];
	}

	/**
	 * Register widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//============================================
		// START Contact Info
		//============================================
		$this->start_controls_section( 'content_section', [
			'label' => __( 'Content', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );


		$this->add_control( 'highlight_text', [
			'label'       => __( 'Title', 'gpt-core' ),
			'type'        => Controls_Manager::WYSIWYG,
			'placeholder' => __( 'Enter Title', 'gpt-core' ),
			'default'     => __( 'I am a passionate Full-Stack WordPress Developer with a strong background in building custom themes, plugins, and dynamic websites. With expertise in both front-end and back-end development, I create seamless, high-performing WordPress solutions tailored to your needs.', 'gpt-core' ),
			'label_block' => true,
		] );

		// Tag
		$this->add_control( 'tag', [
			'label'       => __( 'Tag', 'gpt-core' ),
			'type'        => Controls_Manager::SELECT,
			'options'     => [
				'h1' => 'H1',
				'h2' => 'H2',
				'h3' => 'H3',
				'h4' => 'H4',
				'h5' => 'H5',
				'h6' => 'H6',
				'p'  => 'P',
			],
			'default'     => 'h2',
			'label_block' => true,
		] );

		// Alignment
		$this->add_control( 'alignment', [
			'label'   => __( 'Alignment', 'gpt-core' ),
			'type'    => Controls_Manager::CHOOSE,
			'options' => [
				'left'   => [
					'title' => __( 'Left', 'gpt-core' ),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'gpt-core' ),
					'icon'  => 'eicon-text-align-center',
				],
				'right'  => [
					'title' => __( 'Right', 'gpt-core' ),
					'icon'  => 'eicon-text-align-right',
				],
			],
			'default' => 'left',
			'selectors' => [
				'{{WRAPPER}} .gpt-highlight-heading' => 'text-align: {{VALUE}};',
			],
		] );

		// Spacing
		$this->add_responsive_control( 'spacing', [
			'label' => __( 'Spacing', 'gpt-core' ),
			'type'  => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', 'rem' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
				'em' => [
					'min' => 0,
					'max' => 10,
				],
				'rem' => [
					'min' => 0,
					'max' => 10,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .gpt-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		] );


		$this->end_controls_section();
		// End Content
		// =====================

		// Button
		//============================================
		$this->start_controls_section( 'button_section', [
			'label' => __( 'Button', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control( 'button_text', [
			'label'       => __( 'Button Text', 'gpt-core' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Button Text', 'gpt-core' ),
			'default'     => __( 'More About Me', 'gpt-core' ),
			'label_block' => true,
		] );

		$this->add_control( 'button_link', [
			'label'       => __( 'Button Link', 'gpt-core' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => __( 'https://your-link.com', 'gpt-core' ),
			'label_block' => true,
		] );

		$this->end_controls_section();

		//============================================
		// START TITLE STYLE
		//============================================

		// Start Name Style
		// =====================
		$this->start_controls_section( 'name_style', [
			'label' => __( 'Title', 'gpt-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'title_color', [
			'label'     => __( 'Default Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
//			'selectors' => [
//				'{{WRAPPER}} .gpt-title' => 'color: {{VALUE}};',
//			],
		] );

		// Secondary Color
		$this->add_control( 'title_highlight_color', [
			'label'     => __( 'High Light Color', 'gpt-core' ),
			'type'      => Controls_Manager::COLOR,
//			'selectors' => [
//				'{{WRAPPER}} .gpt-title' => 'background-color: {{VALUE}};',
//			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => __( 'Typography', 'gpt-core' ),
			'selector' => '{{WRAPPER}} .gpt-title',
		] );


		$this->end_controls_section();
		// End Name Style
		// =====================

	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		$tag = $settings['tag'];

		// Link
		// Wrapper
		$this->add_render_attribute( 'highlight_text', 'class', 'gpt-title' );


		// Color Attribute
		$this->add_render_attribute( 'highlight_text', 'data-bg-color',  $settings["title_color"] );
		$this->add_render_attribute( 'highlight_text', 'data-fg-color',  $settings["title_highlight_color"] );

		// Tag
		$tag = $tag ? $tag : 'h2';


		?>
		<div class="gpt-highlight-heading">
			<<?php echo $tag; ?> <?php echo $this->get_render_attribute_string( 'highlight_text' ); ?>>
				<?php echo $settings['highlight_text']; ?>
			</<?php echo $tag; ?>>

			<?php if ( ! empty( $settings['button_text'] ) ) : ?>
				<a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>" class="gpt-button">
					<?php echo $settings['button_text']; ?>
					<span class="gpt-button--icon"><i class="ri-arrow-right-up-line"></i></span>
				</a>
			<?php endif; ?>
		</div>

		<?php
	}

}