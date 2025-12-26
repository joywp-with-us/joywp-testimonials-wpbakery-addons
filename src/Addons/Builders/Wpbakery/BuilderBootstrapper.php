<?php
/**
 * Here we connect our plugin to specific builder with wp hook system.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery;

defined( 'ABSPATH' ) || exit;

use JoywpTestimonialsWpb\AbstractBuilderBootstrapper;
use JoywpTestimonialsWpb\Addons\ConfigManager;

/**
 * Class bootstrap builder builder.
 *
 * @since 1.0
 */
class BuilderBootstrapper extends AbstractBuilderBootstrapper {
	/**
	 * Bootstrap builder.
	 *
	 * @since 1.0
	 */
	public function bootstrap(): void {
		add_action( 'admin_init', [ $this, 'init_custom_addon_params' ] );
		add_filter( 'joywp_testimonials_get_addon_config', [ $this, 'set_icon' ], 10, 3 );
		add_filter( 'joywp_testimonials_get_addon_config', [ $this, 'set_default_configs' ], 10, 3 );
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
	 * Set icon to config.
	 *
	 * @since 1.0
	 */
	public function set_icon( array $config, string $builder_slug, array $addon_data ): array {
		if ( 'wpbakery' !== $builder_slug ) {
			return $config;
		}

		if ( ! isset( $config['icon'] ) || ! is_string( $config['icon'] ) ) {
			return $config;
		}

		$icon_path = $addon_data['base_dir'] . '/' . $config['icon'];
		if ( ! file_exists( $icon_path ) ) {
			unset( $config['icon'] );
			function_exists( 'wp_trigger_error' ) && wp_trigger_error( 'set_icon', 'Failed to locate icon file: ' . esc_html( $icon_path ), E_USER_WARNING );
			return $config;
		}

		$icon_url = joywptestimonialswpb_convert_path_to_uri( $icon_path );
		if ( $icon_url ) {
			$config['icon'] = $icon_url;
		} else {
			unset( $config['icon'] );
		}

		return $config;
	}
}
