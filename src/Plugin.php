<?php
/**
 * Plugin entry point.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb;

use JoywpTestimonialsWpb\Utils\Requirement;
use JoywpTestimonialsWpb\Settings\SettingsManager;
use JoywpTestimonialsWpb\Addons\Collector;
use JoywpTestimonialsWpb\Addons\AbstractBootstrapper;

defined( 'ABSPATH' ) || exit;

/**
 * Plugin Entry Point.
 *
 * @since 1.0
 */
class Plugin {
	/**
	 * Initialize plugin.
	 *
	 * @since 1.0
	 */
	public function init(): void {
		$this->init_settings();
		$this->init_functionality();
	}

	/**
	 * Initialize plugin settings.
	 *
	 * @since 1.0
	 */
	public function init_settings(): void {
		$settings_manager = new SettingsManager();
		$settings_manager->init();
	}

	/**
	 * Initialize plugin functionality.
	 *
	 * @since 1.0
	 */
	public function init_functionality(): void {
		add_action( 'init', [ $this, 'set_up_addons' ] );
	}

	/**
	 * Add elements to dependency plugin.
	 *
	 * @since 1.0
	 */
	public function set_up_addons(): void {
		$addons_collector = new Collector();
		$addons           = $addons_collector->collect();

		if ( ! $addons ) {
			return;
		}

		$builder_list = apply_filters( 'joywp_testimonials_wpb_builder_list', [ 'wpbakery' ] );

		foreach ( $builder_list as $builder_slug ) {
			$this->setup_builder_addons( $builder_slug, $addons );
		}
	}

	/**
	 * Check if wpbakery already activated.
	 *
	 * @since 1.0
	 */
	public function is_dependency_plugin_active(): bool {
		$requirement = new Requirement();
		$requirement->plugins(
			[
				[
					'path'    => JOYWPTESTIMONIALSWPB_WPBAKERY_REQUIRED_PATH,
					'version' => JOYWPTESTIMONIALSWPB_WPBAKERY_REQUIRED_VERSION,
					'name'    => JOYWPTESTIMONIALSWPB_WPBAKERY_REQUIRED_NAME,
				],
			]
		);

		$is_active = $requirement->met();
		if ( ! $is_active ) {
			add_action(
				'admin_notices',
				function () use ( $requirement ): void {
					$requirement->print_notice();
				},
				0,
				0
			);
		}

		return $requirement->met();
	}

	/**
	 * Set up addons for a specific builder.
	 *
	 * @since 1.0
	 */
	public function setup_builder_addons( string $builder_slug, array $addons ): void {
		$bootstrapper = $this->get_builder_bootstrapper( $builder_slug );
		$bootstrapper->bootstrap( $addons );
	}

	/**
	 * Get addon bootstrapper instance for specific builder.
	 *
	 * @since 1.0
	 */
	public function get_builder_bootstrapper( string $builder_slug ): AbstractBootstrapper {
		$class = __NAMESPACE__ . '\\Addons\\Builders\\' . ucfirst( $builder_slug ) . '\\Bootstrapper';
		if ( ! class_exists( $class ) ) {
			function_exists( 'wp_trigger_error' ) && wp_trigger_error( 'JoywpTestimonialsWpb\Plugin::setup_builder_addons', 'Bootstrapper class for ' . $builder_slug . ' not found. ', E_USER_WARNING );
		}

		return new $class();
	}
}
