<?php
/**
 * Addon Bootstrapper for WPBakery.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon;

defined( 'ABSPATH' ) || exit;

use JoywpTestimonialsWpb\Addons\AbstractAddonBootstrapper;
use JoywpTestimonialsWpb\Addons\ConfigManager;
use JoywpTestimonialsWpb\Addons\TemplateManager;
use WP_Exception;
use WPBakeryShortCode;

/**
 * Class register builder addons.
 *
 * @since 1.0
 */
class AddonBootstrapper extends AbstractAddonBootstrapper {
	/**
	 * Get addon config.
	 *
	 * @since 1.0
	 */
	public function get_addon_config( array $addon_data ): array {
		$config_manager = new ConfigManager();
		try {
			$config = $config_manager->
			set_addon_data( $addon_data )->
			get_file_content()->
			decode()->
			set_icon()->
			set_params()->
			get_config();
		} catch ( WP_Exception $e ) {
			function_exists( 'wp_trigger_error' ) && wp_trigger_error( 'process_config', 'Failed to process addon ' . $addon_data['config'] . ' config file: ' . $e->getMessage(), E_USER_WARNING );
			return [];
		}

		return $this->localize_config( $config );
	}

	/**
	 * Get addon template.
	 *
	 * @since 1.0
	 */
	public function get_addon_template( array $addon_data, array $config ): string {
		$template_manager = new TemplateManager();

		if ( ! isset( $config['template'] ) || ! is_string( $config['template'] ) ) {
			return false;
		}

		$template_path = $addon_data['base_dir'] . '/' . $config['template'];

		return $template_manager->validate( $template_path );
	}

	/**
	 * Process addon template.
	 *
	 * @since 1.0
	 */
	public function init_addon( array $addon_data, array $config, string $template ): bool {
		$addon_manager = $this->get_addon_manager( $config, false );

		$addon = ( new Addon() )
			->set_addon_slug( $config['base'] )
			->set_config( $config )
			->set_template( $template )
			->set_addon_manager( $addon_manager )
			->set_addon_base_dir( $addon_data['base_dir'] );

		$result = $this->map_addon( $this->config );

		if ( ! $result ) {
			return false;
		}

		add_shortcode( $config['base'], [ $addon, 'render_addon' ] );

		return shortcode_exists( $config['base'] );
	}

	/**
	 * We need process wpbakery map system for addons configuration.
	 * It creates options for ui in builder for addon editing.
	 *
	 * @since 1.0
	 */
	public function map_addon( array $config ): bool {
		try {
			$result = wpb_map( $config );
		} catch ( Exception $e ) {
			return false;
		}

		return $result;
	}

	/**
	 * Get addon manager class instance.
	 *
	 * @param array $config addon config.
	 *
	 * @since 1.0
	 */
	public function get_addon_manager( array $config, bool $is_container ): WPBakeryShortCode {
		if ( $is_container ) {
			$instance = new AddonManager( $config );
		} else {
			$instance = new AddonContainerManager( $config );
		}

		return $instance;
	}
}
