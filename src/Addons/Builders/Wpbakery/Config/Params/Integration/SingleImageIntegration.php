<?php
/**
 * This class helps to integrate vc_single_image addon
 * to our addons with custom parameters.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Config\Params\Integration;

defined( 'ABSPATH' ) || exit;

/**
 * Class SingleImageIntegration
 *
 * @since 1.0
 */
class SingleImageIntegration extends AbstractIntegration {
	/**
	 * Get integration addon params.
	 *
	 * @since 1.0
	 */
	public function get_integration_addon_params(): array {
		return include vc_path_dir( 'CONFIG_DIR', 'content/shortcode-vc-single-image.php' );
	}

	/**
	 * Get elements params list that we always exclude when integrate shortcode.
	 *
	 * @since 1.0
	 */
	public function get_always_exclude_params(): array {
		return [
			'title',
			'css_animation',
			'el_id',
			'el_class',
			'css',
		];
	}
}
