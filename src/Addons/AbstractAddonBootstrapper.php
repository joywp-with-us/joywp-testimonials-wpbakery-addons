<?php
/**
 * Addon bootstrapper.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons;

defined( 'ABSPATH' ) || exit;

use JoywpTestimonialsWpb\Addons\JsonTranslator;

/**
 * Bootstrap addon.
 *
 * @since 1.0
 */
abstract class AbstractAddonBootstrapper {
	/**
	 * Addon config.
	 *
	 * @since 1.0
	 */
	public array $config;

	/**
	 * Addon template.
	 *
	 * @since 1.0
	 */
	public string $template;

	/**
	 * Class entry point.
	 *
	 * @since 1.0
	 */
	public function bootstrap( string $addons_name, array $addon_data, string $builder_slug ): void {
		$this->config = $this->get_addon_config( $addon_data );

		if ( ! $this->config ) {
			function_exists( 'wp_trigger_error' ) && wp_trigger_error( 'JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Bootstrapper::bootstrap(', 'failed to get addon ' . $addons_name . ' config file for a builder ' . $builder_slug, E_USER_WARNING );
			return;
		}

		$this->template = $this->get_addon_template( $addon_data, $this->config );
		if ( ! $this->template ) {
			function_exists( 'wp_trigger_error' ) && wp_trigger_error( 'JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Bootstrapper::bootstrap(', 'failed to get addon ' . $addons_name . ' template file for a builder ' . $builder_slug, E_USER_WARNING );
		}

		$result = $this->init_addon( $addon_data, $this->config, $this->template );
		if ( ! $result ) {
			function_exists( 'wp_trigger_error' ) && wp_trigger_error( 'JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Bootstrapper::bootstrap(', 'failed to init addon ' . $addons_name . ' for a builder ' . $builder_slug, E_USER_WARNING );
		}
	}
	/**
	 * Get addon config.
	 *
	 * @since 1.0
	 */
	abstract public function get_addon_config( array $addon_data ): array;

	/**
	 * Get addon template.
	 *
	 * @since 1.0
	 */
	abstract public function get_addon_template( array $addon_data, array $config ): string;

	/**
	 * Addon initialization.
	 *
	 * @since 1.0
	 */
	abstract public function init_addon( array $addon_data, array $config, string $template ): bool;

	/**
	 * Localize addon config.
	 *
	 * @since 1.0
	 */
	public function localize_config( array $config ): array {
		$json_translator = new JsonTranslator();
		$json_translator->generate_php_localizer( $config );
		return $json_translator->localize( $config );
	}
}
