<?php
/**
 * Bootstrap WPBakery addons.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery;

defined( 'ABSPATH' ) || exit;

use JoywpTestimonialsWpb\Addons\AbstractBootstrapper;
use JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\AddonManager;
use JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\AddonContainerManager;
use JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Addon;
use JoywpTestimonialsWpb\Addons\JsonTranslator;
use JoywpTestimonialsWpb\Addons\ConfigManager;
use JoywpTestimonialsWpb\Addons\TemplateManager;
use Exception;
use WP_Exception;
use WPBakeryShortCode;

/**
 * Class register builder addons.
 *
 * @since 1.0
 */
class Bootstrapper extends AbstractBootstrapper {
	/**
	 * Constructor.
	 *
	 * @since 1.0
	 */
	public function __construct() {
		add_action( 'admin_init', [ $this, 'init_custom_addon_params' ] );
	}

	/**
	 * Initialize custom addon params.
	 * We initialize here 3-party library that create custom
	 * addon params that wpbakery initially missing.
	 *
	 * @since 1.0
	 */
	public function init_custom_addon_params(): void {
		add_filter(
			'wpcustomparamcollection_get_param_prefix',
			function ( $prefix_list ) {
				$prefix_list[] = 'joywp';
				return $prefix_list;
			}
		);

		if ( ! class_exists( 'Wpbackery_Custom_Param_Collection' ) ) {
			include_once JOYWPTESTIMONIALSWPB_INCLUDES_DIR . '/wpbakery-custom-param-collection/wpbakery-custom-param-collection.php';
		}
	}

	/**
	 * Process addon config.
	 *
	 * @since 1.0
	 * @return false|array
	 */
	public function process_addon_config( array $addon_data ) {
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
			return false;
		}

		$config = $this->localize_config( $config );

		$result = $this->map_addon( $config );

		if ( ! $result ) {
			return false;
		}

		return $config;
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
	 * Localize addon config.
	 *
	 * @since 1.0
	 */
	public function localize_config( array $config ): array {
		$json_translator = new JsonTranslator();
		$json_translator->generate_php_localizer( $config );
		return $json_translator->localize( $config );
	}

	/**
	 * Process addon template.
	 *
	 * @since 1.0
	 */
	public function process_addon_template( array $addon_data, array $config ): bool {
		$template_manager = new TemplateManager();

		if ( ! isset( $config['template'] ) || ! is_string( $config['template'] ) ) {
			return false;
		}

		$template_path = $addon_data['base_dir'] . '/' . $config['template'];

		$template = $template_manager->validate( $template_path );
		if ( ! $template ) {
			return false;
		}

		$addon_manager = $this->get_addon_manager( $config, false );

		( new Addon() )
			->set_addon_slug( $config['base'] )
			->set_config( $config )
			->set_template( $template )
			->set_addon_manager( $addon_manager )
			->set_addon_base_dir( $addon_data['base_dir'] )
			->init_addon();

		return shortcode_exists( $config['base'] );
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
