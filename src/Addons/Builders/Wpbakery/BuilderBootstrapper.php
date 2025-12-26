<?php
/**
 * Here we connect our plugin to specific builder with wp hook system.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery;

defined( 'ABSPATH' ) || exit;

use JoywpTestimonialsWpb\AbstractBuilderBootstrapper;

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
}
