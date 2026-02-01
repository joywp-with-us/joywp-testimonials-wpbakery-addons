<?php
/**
 * This class helps to integrate vc_single_image addon
 * to our addons with custom parameters.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Config\Params\Collection;

defined( 'ABSPATH' ) || exit;

/**
 * Class SingleImageIntegration
 *
 * @since 1.0
 */
class Image extends AbstractParamsCollectionIntegration {
	/**
	 * Get integration addon params.
	 *
	 * @since 1.0
	 */
	public function get_collection_params(): array {
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
