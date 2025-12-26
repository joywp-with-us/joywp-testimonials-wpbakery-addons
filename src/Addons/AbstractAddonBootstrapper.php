<?php
/**
 * Addon bootstrapper.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons;

defined( 'ABSPATH' ) || exit;

/**
 * Bootstrap addon.
 *
 * @since 1.0
 */
abstract class AbstractAddonBootstrapper {
	/**
	 * Class entry point.
	 *
	 * @since 1.0
	 */
	public function bootstrap( string $addons_name, array $addon_data, string $builder_slug ): void {
		$config = $this->process_addon_config( $addon_data );

		if ( ! $config ) {
			function_exists( 'wp_trigger_error' ) && wp_trigger_error( 'JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Bootstrapper::bootstrap(', 'failed to process addon ' . $addons_name . ' config file for a builder ' . $builder_slug, E_USER_WARNING );
			return;
		}

		$result = $this->process_addon_template( $addon_data, $config );
		if ( ! $result ) {
			function_exists( 'wp_trigger_error' ) && wp_trigger_error( 'JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Bootstrapper::bootstrap(', 'failed to process addon ' . $addons_name . ' template file for a builder ' . $builder_slug, E_USER_WARNING );
		}
	}

	/**
	 * Process addon config.
	 *
	 * @since 1.0
	 * @return false|array
	 */
	abstract public function process_addon_config( array $addon_data );

	/**
	 * Process addon template.
	 *
	 * @since 1.0
	 */
	abstract public function process_addon_template( array $addon_data, array $config ): bool;
}
