<?php
namespace PixelPath\PPSPassportCore\Widgets;

use Elementor\{Controls_Manager, Group_Control_Background, Group_Control_Typography, Repeater, Widget_Base};
use PPS_Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor heading widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class Title extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve heading widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'pps_title';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve heading widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'PPS Title', 'pps-passport-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve heading widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-t-letter';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the heading widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'pps-elements' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'heading', 'title', 'text' ];
	}

	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
//	public function get_script_depends() {
//
//		return [ 'fastdom',  'splittext', 'liquidSplitText'];
//	}

	/**
	 * Register heading widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_section_title',
			array(
				'label' => __( 'Title', 'hub-elementor-elementor' ),
			)
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'pps-passport-core' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'rows' => '2',
				'default' => 'Add Your Heading Text Here',
				'label_block' => true,
			]
		);

		// Link
		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'nofollow' => true,
				],
				'label_block' => true,
			]
		);


		$this->add_control(
			'tag',
			[
				'label' => esc_html__( 'Element Tag', 'pps-passport-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label' => __( 'Alignment', 'pps-passport-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'pps-passport-core' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'pps-passport-core' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'pps-passport-core' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justify', 'pps-passport-core' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ld-fancy-heading' => 'text-align: {{VALUE}}',
				],
				'toggle' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_style_section',
			[
				'label' => __( 'Title', 'pps-passport-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Color
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'pps-passport-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pps-section-title' => 'color: {{VALUE}}',
				],
			]
		);

		// Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .pps-section-title',
			]
		);


		$this->end_controls_section();

	}

	/**
	 * Render heading widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		// Wrapper
		$this->add_render_attribute( 'wrapper', 'class', 'pps-section-title-wrapper' );

		// Link
		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'link', $settings['link'] );
		}

		?>

		<div <?php  $this->print_render_attribute_string('wrapper') ?> >
			<?php if ( ! empty( $settings['link']['url'] ) ) : ?>
				<a <?php $this->print_render_attribute_string( 'link' ); ?>>
			<?php endif; ?>
				<<?php echo esc_attr( $settings['tag'] ); ?> class="pps-section-title">
					<?php echo esc_html( $settings['title'] ); ?>
				</<?php echo esc_attr( $settings['tag'] ); ?>>
			<?php if ( ! empty( $settings['link']['url'] ) ) : ?>
				</a>
			<?php endif; ?>
			<span class="title-border"></span>
		</div>

		<?php
	}

}
