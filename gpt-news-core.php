<?php
/**
 * Plugin Name: GPT News Core
 * Plugin URI: https://themeforest.net/user/gptheme/portfolio
 * Description: This plugin is required for GPT Theme.
 * Version: 1.0.0
 * Author: GpTheme
 * Author URI: https://gptheme.com
 * Text domain: mpt-core
 */

use GpTheme\GptNewsCore\Admin\PostType\Footer;
use GpTheme\GptNewsCore\Admin\PostType\Project;
use GpTheme\GptNewsCore\AnimationEffect;
use GpTheme\GptNewsCore\Ajax;
use GpTheme\GptNewsCore\ElementorWidgets;

if (!defined('ABSPATH'))
	die('-1');

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('GPT_CORE_VERSION', '1.0.0');

/**
 * Constant for the plugins
 */


define('GPT_PLUGIN_URL', plugins_url() . '/mpt-core/' );
define('GPT_CORE_PATH', plugin_dir_path(__FILE__));
define('GPT_CORE_ASSETS_URL', plugins_url() . '/gpt-news-core/assets/' );
define('GPT_CORE_DIR', plugin_dir_path(__FILE__));
define('GPT_SCRIPTS', GPT_PLUGIN_URL . 'assets/js');

// Include comoposer autoload
require_once GPT_CORE_DIR . 'vendor/autoload.php';

// Make sure the same class is not loaded twice in free/premium versions.
if (!class_exists('GPT_Core')) {
	/**
	 * Main GPT Core Class
	 *
	 * The main class that initiates and runs the GPT Core plugin.
	 *
	 * @since 1.0.0
	 */
	final class GPT_Core
	{
		/**
		 * GPT Core Version
		 *
		 * Holds the version of the plugin.
		 *
		 * @since 1.0.0
		 *
		 * @var string The plugin version.
		 */
		const VERSION = '1.0';

		/**
		 * Minimum Elementor Version
		 *
		 * Holds the minimum Elementor version required to run the plugin.
		 *
		 * @since 1.0.0
		 *
		 * @var string Minimum Elementor version required to run the plugin.
		 */
		const MINIMUM_ELEMENTOR_VERSION = '3.3.0';

		/**
		 * Minimum PHP Version
		 *
		 * Holds the minimum PHP version required to run the plugin.
		 *
		 * @since 2.0.0
		 *
		 * @var string Minimum PHP version required to run the plugin.
		 */
		const  MINIMUM_PHP_VERSION = '5.6';

		/**
		 * Instance
		 *
		 * Holds a single instance of the `GPT_Core` class.
		 *
		 * @since 1.0.0
		 *
		 * @access private
		 * @static
		 *
		 * @var GPT_Core A single instance of the class.
		 */
		private static $_instance = null;

		/**
		 * The loader that's responsible for maintaining and registering all hooks that power
		 * the plugin.
		 *
		 * @since    1.0.0
		 * @access   protected
		 * @var      GPT_Core $loader Maintains and registers all hooks for the plugin.
		 */
		protected $loader;

		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.
		 *
		 * @return GPT_Core An instance of the class.
		 * @since 1.0.0
		 *
		 * @access public
		 * @static
		 *
		 */
		public static function instance()
		{
			if (is_null(self::$_instance)) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * Clone
		 *
		 * Disable class cloning.
		 *
		 * @return void
		 * @since 1.0.0
		 *
		 * @access protected
		 *
		 */
		public function __clone()
		{
			// Cloning instances of the class is forbidden
			_doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'mpt-core'), '2.0.0');
		}

		/**
		 * Wakeup
		 *
		 * Disable unserializing the class.
		 *
		 * @return void
		 * @since 1.0.0
		 *
		 * @access protected
		 *
		 */
		public function __wakeup()
		{
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'mpt-core'), '2.0.0');
		}

		/**
		 * Constructor
		 *
		 * Initialize the GPT Core plugins.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function __construct()
		{
			$this->core_includes();
			$this->init_hooks();
			do_action('mpt_core_loaded');

		}

		/**
		 * Include Files
		 *
		 * Load core files required to run the plugin.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function core_includes()
		{
			// Elementor custom field icons
			require_once __DIR__ . '/Includes/Icons/icons.php';
			require_once __DIR__ . '/Includes/Helper.php';

			// Elementor Widgets
			ElementorWidgets::get_instance();

		}

		/**
		 * Init Hooks
		 *
		 * Hook into actions and filters.
		 *
		 * @since 1.0.0
		 *
		 * @access private
		 */
		private function init_hooks()
		{
			add_action('init', [$this, 'i18n']);
			add_action('plugins_loaded', [$this, 'init']);
		}

		/**
		 * Load Textdomain
		 *
		 * Load plugin localization files.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function i18n()
		{
			load_plugin_textdomain('mpt-core', false, plugin_basename(dirname(__FILE__)) . '/languages');
		}

		/**
		 * Init GPT Core
		 *
		 * Load the plugin after Elementor (and other plugins) are loaded.
		 *
		 * @since 1.0.0
		 * @since 2.0.0 The logic moved from a standalone function to this class method.
		 *
		 * @access public
		 */
		public function init()
		{

			if (!did_action('elementor/loaded')) {
				add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
				return;
			}

			// Check for required Elementor version
			if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
				add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
				return;
			}

			// Check for required PHP version
			if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
				add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
				return;
			}

			// Register Widget Scripts
			add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueue_widget_styles']);
			add_action('elementor/editor/before_enqueue_scripts', [$this, 'enqueue_widget_styles']);
			add_action('wp_enqueue_scripts', [$this, 'mpt_enqueue_style']);
			add_action('admin_enqueue_scripts', [$this, 'mpt_admin_enqueue_scripts']);
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have Elementor installed or activated.
		 *
		 * @since 1.1.0
		 * @since 2.0.0 Moved from a standalone function to a class method.
		 *
		 * @access public
		 */
		public function admin_notice_missing_main_plugin()
		{
			$message = sprintf(
			/* translators: 1: GPT Core: Elementor */
				esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'mpt-core'),
				'<strong>' . esc_html__('GPT Core', 'mpt-core') . '</strong>',
				'<strong>' . esc_html__('Elementor', 'mpt-core') . '</strong>'
			);
			printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required Elementor version.
		 *
		 * @since 1.1.0
		 * @since 2.0.0 Moved from a standalone function to a class method.
		 *
		 * @access public
		 */
		public function admin_notice_minimum_elementor_version()
		{
			$message = sprintf(
			/* translators: 1: GPT Core: Elementor 3: Required Elementor version */
				esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'mpt-core'),
				'<strong>' . esc_html__('GPT Core', 'mpt-core') . '</strong>',
				'<strong>' . esc_html__('Elementor', 'mpt-core') . '</strong>',
				self::MINIMUM_ELEMENTOR_VERSION
			);
			printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required PHP version.
		 *
		 * @since 2.0.0
		 *
		 * @access public
		 */
		public function admin_notice_minimum_php_version()
		{
			$message = sprintf(
			/* translators: 1: GPT Core 2: PHP 3: Required PHP version */
				esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'mpt-core'),
				'<strong>' . esc_html__('GPT Elements', 'mpt-core') . '</strong>',
				'<strong>' . esc_html__('PHP', 'mpt-core') . '</strong>',
				self::MINIMUM_PHP_VERSION
			);
			printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
		}

		public function mpt_enqueue_style()
		{
			wp_enqueue_style('mpt-core-css', plugins_url('assets/css/app.css', __FILE__));
		}

		/**
		 * Register Widget Styles
		 *
		 * Register custom styles required to run GPT Core.
		 *
		 * @since 2.0.0
		 * @since 1.7.1 The method moved to this class.
		 *
		 * @access public
		 */

		public function enqueue_widget_styles()
		{
//			wp_enqueue_style('themify-icons', plugins_url('assets/vendors/themify-icon/themify-icons.css', __FILE__));
//			wp_enqueue_style('simpleline', plugins_url('assets/vendors/simple-line-icons//css/simple-line-icons.css', __FILE__));
//			wp_enqueue_style('feather', plugins_url('assets/vendors/feather/css/feather.css', __FILE__));
		}

		public function mpt_admin_enqueue_scripts()
		{
			wp_enqueue_style('admin', plugins_url('assets/css/admin.css', __FILE__));
		}

	}
}
// Make sure the same function is not loaded twice in free/premium versions.

if (!function_exists('mpt_core_load')) {
	/**
	 * Load GPT Core
	 *
	 * Main instance of GPT_Core.
	 *
	 * @since 1.0.0
	 * @since 1.0.0 The logic moved from this function to a class method.
	 */
	function mpt_core_load()
	{
		return GPT_Core::instance();
	}

	// Run GPT Core
	mpt_core_load();
}
