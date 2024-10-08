<?php

namespace GpTheme\GptNewsCore;

use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'GOTOXELEMENTOR_CORE_URL', plugins_url( '/', __FILE__ ) );
define( 'GOTOXELEMENTOR_CORE_PATH', plugin_dir_path( __FILE__ ) );
define( 'GOTOXELEMENTOR_CORE_FILE', __FILE__ );


class ElementorWidgets {
	// Properties

	/**
	 * Instance
	 * @var ElementorWidgets
	 */
	private static $instance = null;

	/**
	 * Get instance
	 * @return ElementorWidgets
	 */

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * ElementorWidgets constructor.
	 */

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init_addons' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_categories' ] );
		add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'before_enqueue_scripts' ] );
//		add_action( 'wp_enqueue_scripts', [ $this, 'before_enqueue_scripts' ] );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'after_register_scripts' ] );
		add_action( 'elementor/icons_manager/additional_tabs', [ $this, 'remixicon_icons' ] );
	}

	/**
	 * Register Categories for Elementor
	 *
	 * @param $elements_manager
	 */

	public function register_categories( $elements_manager ) {
		$elements_manager->add_category(
			'gpt-elements',
			[
				'title' => __( 'GPT Elements', 'gpt-news-core' ),
				'icon'  => 'fa fa-plug',
			]
		);
	}

	/**
	 * Register widgets
	 */

	public function register_widgets() {
		$widget_manager = Plugin::instance()->widgets_manager;

		foreach ( glob( GPT_CORE_PATH . 'Includes/Widgets/*.php' ) as $file ) {
			$base  = basename( str_replace( '.php', '', $file ) );
			$class = ucwords( str_replace( '-', ' ', $base ) );
			$class = str_replace( ' ', '_', $class );
			$class = sprintf( '\GpTheme\GptNewsCore\Widgets\%s', $class );

			if ( class_exists( $class ) ) {
				$widget_manager->register( new $class );
			}
		}
	}


	/**
	 * Register addon by file name
	 */
	public function register_modules_addon() {
		foreach ( glob( GPT_CORE_PATH . 'Includes/Elementor/*.php' ) as $file ) {
			$base  = basename( str_replace( '.php', '', $file ) );
			$class = ucwords( str_replace( '-', ' ', $base ) );
			$class = str_replace( ' ', '_', $class );
			$class = sprintf( '\GpTheme\GptNewsCore\Elementor\%s', $class );

			if ( class_exists( $class ) ) {
				new $class;
			}
		}
	}

	/**
	 * Init Addons
	 */

	public function init_addons() {
		/**
		 * Check if Elementor installed and activated
		 * @see https://developers.elementor.com/creating-an-extension-for-elementor/
		 */
		if ( ! did_action( 'elementor/loaded' ) ) {
			return;
		}

		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
//		$this->register_modules_addon();
	}


	/**
	 * Enqueue scripts
	 */
	public function after_register_scripts() {
		wp_register_script( 'countUp', GPT_SCRIPTS . '/countUp.min.js', array( 'jquery' ), GPT_CORE_VERSION, true );
		wp_register_script( 'appear-js', GPT_SCRIPTS . '/jquery.appear.js', array( 'jquery' ), GPT_CORE_VERSION, true );
		wp_register_script( 'countTo', GPT_SCRIPTS . '/jquery.countTo.js', array( 'jquery' ), GPT_CORE_VERSION, true );

		wp_register_script( 'isotope', GPT_SCRIPTS . '/isotope.pkgd.min.js', array( 'jquery' ), GPT_CORE_VERSION, true );

		wp_enqueue_script( 'gsap', GPT_SCRIPTS . '/gsap.min.js', array(), GPT_CORE_VERSION, true );
		wp_enqueue_script( 'splittext', GPT_SCRIPTS . '/SplitText.min.js', array(), GPT_CORE_VERSION, true );
		wp_enqueue_script( 'ScrollToPlugin', GPT_SCRIPTS . '/ScrollToPlugin.min.js', array(), GPT_CORE_VERSION, true );
		wp_enqueue_script( 'ScrollTrigger', GPT_SCRIPTS . '/ScrollTrigger.min.js', array(), GPT_CORE_VERSION, true );
		wp_enqueue_script( 'WebGlGradient', GPT_SCRIPTS . '/WebGlGradient.js', array(), GPT_CORE_VERSION, true );
//		wp_enqueue_script( 'ScrollSmoother', GPT_SCRIPTS . '/ScrollSmoother.min.js', array(), GPT_CORE_VERSION, true );
//		wp_enqueue_script( 'ukiyo', GPT_SCRIPTS . '/ukiyo.min.js', array(), GPT_CORE_VERSION, true );
//		wp_enqueue_script( 'tilts', GPT_SCRIPTS . '/jquery.tilt.js', array('jquery'), GPT_CORE_VERSION, true );
	}

	/**
	 * Enqueue Scripts
	 * @return void
	 */

	public function before_enqueue_scripts() {
		wp_enqueue_script( 'gpt-elementor', GPT_SCRIPTS . '/elementor.js', array(
			'jquery',
			'elementor-frontend'
		), GPT_CORE_VERSION, true );
	}

	public function remixicon_icons( $tabs ) {

		$tabs['gpt-font-remix'] = [
			'name'          => 'gpt-font-remix',
			'label'         => __( 'Remix Icon', 'gpt-news-core' ),
			'url'           => GPT_CORE_ASSETS_URL . '/css/remixicon.css',
			'enqueue'       => [GPT_CORE_ASSETS_URL . '/css/remixicon.css'],
			'prefix'        => '', // Prefix in your icon font
			'displayPrefix' => '',
			'labelIcon'     => 'ri-asterisk', // One of the icons to display as a label
			'ver'           => '1.0.0',
			'fetchJson'     => GPT_CORE_ASSETS_URL . '/js/icons.json', // Optional, for icon names
			'native'        => false,
		];

		return $tabs;

	}

}
