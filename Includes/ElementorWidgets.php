<?php

namespace PixelPath\PPSPassportCore;

use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

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
//		add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'before_enqueue_scripts' ] );
//		add_action( 'wp_enqueue_scripts', [ $this, 'before_enqueue_scripts' ] );
//		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'after_register_scripts' ] );
		add_filter( 'elementor/icons_manager/additional_tabs', [ $this, 'remix_icons' ] );
	}

	/**
	 * Register Categories for Elementor
	 *
	 * @param $elements_manager
	 */

	public function register_categories( $elements_manager ) {
		$elements_manager->add_category(
			'pps-elements',
			[
				'title' => __( 'PPS Elements', 'pps-passport-core' ),
				'icon'  => 'fa fa-plug',
			]
		);
	}

	/**
	 * Register widgets
	 */

	public function register_widgets() {
		$widget_manager = Plugin::instance()->widgets_manager;

		foreach ( glob( PPS_CORE_PATH . 'Includes/Widgets/*.php' ) as $file ) {
			$base  = basename( str_replace( '.php', '', $file ) );
			$class = ucwords( str_replace( '-', ' ', $base ) );
			$class = str_replace( ' ', '_', $class );
			$class = sprintf( '\PixelPath\PPSPassportCore\Widgets\%s', $class );

			if ( class_exists( $class ) ) {
				$widget_manager->register( new $class );
			}
		}
	}


	/**
	 * Register addon by file name
	 */
	public function register_modules_addon() {
		foreach ( glob( PPS_CORE_PATH . 'Includes/Elementor/*.php' ) as $file ) {
			$base  = basename( str_replace( '.php', '', $file ) );
			$class = ucwords( str_replace( '-', ' ', $base ) );
			$class = str_replace( ' ', '_', $class );
			$class = sprintf( '\PixelPath\PPSPassportCore\Elementor\%s', $class );

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
//		wp_register_script( 'countUp', PPS_SCRIPTS . '/countUp.min.js', array( 'jquery' ), PPS_CORE_VERSION, true );

	}

	/**
	 * Enqueue Scripts
	 * @return void
	 */

	public function before_enqueue_scripts() {
		wp_enqueue_script( 'pps-elementor', PPS_SCRIPTS . '/elementor.js', array(
			'jquery',
			'elementor-frontend'
		), PPS_CORE_VERSION, true );
	}

	public function remix_icons( $tabs ) {

		$tabs['remix-icons'] = [
			'name'      => 'remix-icons',
			'label'     => __( 'Remix Icon', 'mpt-core' ),
			'url'       => PPS_CORE_ASSETS_URL . 'css/remixicon.css',
			'enqueue'   => [ PPS_CORE_ASSETS_URL . 'css/remixicon.css' ],
			'prefix' => 'ri-',
			'displayPrefix' => '',
			'labelIcon' => 'ri-asterisk',
			'ver'       => '1.0.0',
			'fetchJson' => PPS_CORE_ASSETS_URL . 'css/remixicons.js',
			'native'    => false,
		];

		return $tabs;

	}

}
