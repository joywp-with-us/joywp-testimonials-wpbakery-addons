<?php
/**
 * This class helps to integrate button collection
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
class Button extends AbstractCollection {
	/**
	 * Get collection color group.
	 *
	 * @since 1.0
	 */
	public function get_color(): string {
		return '#8B0000';
	}

	/**
	 * Get integration addon params.
	 *
	 * @since 1.0
	 */
	public function get_collection_params(): array {
		return include vc_path_dir( 'CONFIG_DIR', 'buttons/shortcode-vc-btn.php' );
	}

	/**
	 * Get elements params list that we always exclude when integrate shortcode.
	 *
	 * @since 1.0
	 */
	public function get_always_exclude_params(): array {
		return [
			$this->collection->get_param_slug( 'css_animation' ),
			$this->collection->get_param_slug( 'el_id' ),
			$this->collection->get_param_slug( 'el_class' ),
			$this->collection->get_param_slug( 'css' ),
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
