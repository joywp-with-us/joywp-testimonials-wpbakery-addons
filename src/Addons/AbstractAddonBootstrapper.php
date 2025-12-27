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
	 * Builder slug.
	 *
	 * @since 1.0
	 */
	public string $builder_slug;

	/**
	 * Class entry point.
	 *
	 * @since 1.0
	 */
	public function bootstrap( string $addons_name, array $addon_data, string $builder_slug ): void {
		$this->builder_slug = $builder_slug;

		$this->config = $this->get_addon_config( $addon_data, $builder_slug );

		if ( ! $this->config ) {
			function_exists( 'wp_trigger_error' ) && wp_trigger_error( 'JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Bootstrapper::bootstrap(', 'failed to get addon ' . $addons_name . ' config file for a builder ' . $builder_slug, E_USER_WARNING );
			return;
		}

		$this->template = $this->get_addon_template( $addon_data, $this->config, $builder_slug );
		if ( ! $this->template ) {
			function_exists( 'wp_trigger_error' ) && wp_trigger_error( 'JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Bootstrapper::bootstrap(', 'failed to get addon ' . $addons_name . ' template file for a builder ' . $builder_slug, E_USER_WARNING );
		}

		$result = $this->init_addon( $addon_data, $this->config, $this->template );
		if ( ! $result ) {
			function_exists( 'wp_trigger_error' ) && wp_trigger_error( 'JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Bootstrapper::bootstrap(', 'failed to init addon ' . $addons_name . ' for a builder ' . $builder_slug, E_USER_WARNING );
		}
	}

	/**
	 * Addon initialization.
	 *
	 * @since 1.0
	 */
	abstract public function init_addon( array $addon_data, array $config, string $template ): bool;

	/**
	 * Get addon config.
	 *
	 * @since 1.0
	 */
	public function get_addon_config( array $addon_data, string $builder_slug ): array {
		$config_manager = new ConfigManager();
		try {
			$config = $config_manager->
			set_addon_data( $addon_data )->
			get_file_content()->
			decode()->
			set_params()->
			get_config();
		} catch ( WP_Exception $e ) {
			function_exists( 'wp_trigger_error' ) && wp_trigger_error( 'process_config', 'Failed to process addon ' . $addon_data['config'] . ' config file: ' . $e->getMessage(), E_USER_WARNING );
			return [];
		}

		$config = $this->localize_config( $config );

		return apply_filters( 'joywp_testimonials_get_addon_config', $config, $builder_slug, $addon_data );
	}

	/**
	 * Get addon template.
	 *
	 * @since 1.0
	 */
	public function get_addon_template( array $addon_data, array $config, string $builder_slug ): string {
		$template_manager = new TemplateManager();

		if ( ! isset( $config['template'] ) || ! is_string( $config['template'] ) ) {
			return false;
		}

		$template_path = $addon_data['base_dir'] . '/' . $config['template'];
		$template      = $template_manager->validate( $template_path );

		return apply_filters( 'joywp_testimonials_get_addon_template', $template, $builder_slug, $addon_data );
	}

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
