<?php
/**
 * Plugin Name:       JoyWP Testimonials Addons For WPBakery Page Builder
 * Plugin URI:        https://github.com/joywp-with-us/joywp-testimonials-wpbakery-addons
 * Description:       Power your WPBakery Page Builder with well-crafted testimonials addons.
 * Author:            joyWP
 * Author URI:        https://joywp.com
 * Text Domain:       joywp-testimonials-wpbakery-addons
 * Domain Path:       /languages
 * Version:           1.0
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 *
 * Requires at least: 4.9
 * Requires PHP:      7.1
 *
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

use JoywpTestimonialsWpb\Plugin;

/**
 * Main Plugin Class.
 *
 * @since 1.0
 */
class Joywp_Wpb_Testimonials {
	/**
	 * The single instance of the class.
	 *
	 * @since  1.0
	 */
	public static ?Joywp_Wpb_Testimonials $instance = null;

	/**
	 * Plugin instance.
	 *
	 * @since 1.0
	 */
	public ?Plugin $plugin = null;

	/**
	 * Initiate plugin.
	 *
	 * Ensures only one instance of plugin is loaded or can be loaded.
	 *
	 * @since 1.0
	 * @static
	 */
	public static function instance(): Joywp_Wpb_Testimonials {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Joywp_Wpb_Testimonials Constructor.
	 *
	 * @since 1.0
	 */
	public function __construct() {
		$this->define_constants();
		$this->includes();

		$this->init_hooks();

		$plugin = $this->get_plugin();

		if ( ! $plugin->is_dependency_plugin_active() ) {
			return;
		}

		$plugin->init();
	}

	/**
	 * Define plugin constants.
	 *
	 * @since 1.0
	 */
	private function define_constants(): void {
		define( 'JOYWPTESTIMONIALSWPB_VERSION', '1.0' );

		define( 'JOYWPTESTIMONIALSWPB_PLUGIN_SLUG', 'joywp-testimonials' );

		define( 'JOYWPTESTIMONIALSWPB_PLUGIN_FILE', __FILE__ );

		define( 'JOYWPTESTIMONIALSWPB_URI', plugins_url( '', JOYWPTESTIMONIALSWPB_PLUGIN_FILE ) );
		define( 'JOYWPTESTIMONIALSWPB_ASSETS_URI', plugins_url( 'assets', JOYWPTESTIMONIALSWPB_PLUGIN_FILE ) );

		define( 'JOYWPTESTIMONIALSWPB_URI_ABSPATH', __DIR__ . '/' );
		define( 'JOYWPTESTIMONIALSWPB_TEMPLATES_DIR', __DIR__ . '/templates' );
		define( 'JOYWPTESTIMONIALSWPB_INCLUDES_DIR', __DIR__ . '/includes' );
		define( 'JOYWPTESTIMONIALSWPB_ASSETS_DIR', __DIR__ . '/assets' );
		define( 'JOYWPTESTIMONIALSWPB_CONFIG_DIR', __DIR__ . '/config' );
		define( 'JOYWPTESTIMONIALSWPB_LOCALIZATION_DIR', __DIR__ . '/languages' );
	}

	/**
	 * Hook into actions and filters.
	 *
	 * @since 1.0
	 */
	private function init_hooks(): void {
		add_action( 'init', [ $this, 'init' ], 0 );
	}

	/**
	 * Get plugin instance.
	 *
	 * @since 1.0
	 */
	public function get_plugin(): Plugin {
		if ( ! $this->plugin ) {
			$this->plugin = new Plugin();
		}

		return $this->plugin;
	}

	/**
	 * Include required plugin core files.
	 *
	 * @since 1.0
	 */
	public function includes(): void {
		require_once JOYWPTESTIMONIALSWPB_INCLUDES_DIR . '/helpers.php';
		require_once __DIR__ . '/vendor/autoload.php';
	}

	/**
	 * Init plugin when WordPress Initialises.
	 *
	 * @since 1.0
	 */
	public function init(): void {
		// Before init action.
		do_action( 'before_joywp_testimonials_wpbakery_addons' );
		// Set up localization.
		$this->load_plugin_textdomain();
		// After init action.
		do_action( 'after_joywp_testimonials_wpbakery_addons' );
	}

	/**
	 * Load Localisation files.
	 *
	 * Note: the first-loaded translation file overrides any following ones
	 * if the same translation is present.
	 *
	 * @since 1.0
	 */
	public function load_plugin_textdomain(): void {
		load_plugin_textdomain(
			'joywp-testimonials-wpbakery-addons',
			false,
			JOYWPTESTIMONIALSWPB_LOCALIZATION_DIR
		);
	}
}

Joywp_Wpb_Testimonials::instance();
