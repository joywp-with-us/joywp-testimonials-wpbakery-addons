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
class Image extends AbstractCollection {
	/**
	 * Get collection slug.
	 *
	 * @since 1.0
	 */
	public function get_slug(): string {
		return 'image';
	}

	/**
	 * Get collection name.
	 *
	 * @since 1.0
	 */
	public function get_name(): string {
		return 'image';
	}

	/**
	 * Get collection color group.
	 *
	 * @since 1.0
	 */
	public function get_color_group(): string {
		return '#8B0000';
	}

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

	/**
	 * Get integration params.
	 *
	 * @since 1.0
	 */
	public function get_params(): array {
		$params = parent::get_params();

		foreach ( $params as $key => $value ) {
			if ( isset( $value['admin_label'] ) ) {
				unset( $params[ $key ]['admin_label'] );
			}
		}

		return $params;
	}
}
