<?php
/**
 * Addons bootstrapper.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons;

defined( 'ABSPATH' ) || exit;

/**
 * Bootstrap addons.
 *
 * @since 1.0
 */
abstract class AbstractBootstrapper {
	/**
	 * Class entry point.
	 *
	 * @since 1.0
	 */
	public function bootstrap( array $addons ): void {
		foreach ( $addons as $addons_name => $addon_data ) {
			$config = $this->process_addon_config( $addon_data );

			if ( ! $config ) {
				function_exists( 'wp_trigger_error' ) && wp_trigger_error( 'JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Bootstrapper::bootstrap(', 'failed to process addon ' . $addons_name . ' config file', E_USER_WARNING );
				continue;
			}

			$result = $this->process_addon_template( $addon_data, $config );
			if ( ! $result ) {
				function_exists( 'wp_trigger_error' ) && wp_trigger_error( 'JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Bootstrapper::bootstrap(', 'failed to process addon ' . $addons_name . ' template file', E_USER_WARNING );
			}
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
