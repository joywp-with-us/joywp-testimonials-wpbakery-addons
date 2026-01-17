<?php
/**
 * This class helps to integrate vc_single_image addon
 * to our addons with custom parameters.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Config;

defined( 'ABSPATH' ) || exit;

/**
 * Class SingleImageIntegration
 *
 * @since 1.0
 */
class SingleImageIntegration {

	/**
	 * Parameters to exclude from integration.
	 */
	public array $exclude = [];

	/**
	 * Prefix for integrated params.
	 */
	public string $prefix = '';

	/**
	 * Set parameters to exclude from integration.
	 *
	 * @since 1.0
	 */
	public function set_exclude( array $exclude_params ): SingleImageIntegration {
		$this->exclude = $exclude_params;
		return $this;
	}

	/**
	 * Set parameters to exclude from integration.
	 *
	 * @since 1.0
	 */
	public function set_prefix( array $exclude_params ): SingleImageIntegration {
		$this->exclude = $exclude_params;
		return $this;
	}

	/**
	 * Get integration config.
	 *
	 * @since 1.0
	 */
	public function get_config(): array {
		$image_config = include vc_path_dir( 'CONFIG_DIR', 'content/shortcode-vc-single-image.php' );

		$exclude = array_merge( $this->get_always_exclude_params(), $this->exclude );

		$include_params = [ 'exclude' => $exclude ];

		$config =
			vc_map_integrate_shortcode(
				$image_config,
				'',
				'',
				$include_params
			);

		return $config;
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
	 * Add additional params to each config param set.
	 *
	 * @since 1.0
	 */
	public function add_config_params( array $init_param, array $additional_params ): array {
		foreach ( $init_param as $init_param_key => $init_param_value ) {
			$init_param[ $init_param_key ] = array_merge(
				$init_param_value,
				$additional_params
			);
		}

		return $init_param;
	}

	/**
	 * Add dependency to each config param set,
	 * keeping existing dependencies.
	 *
	 * @since 1.0
	 */
	public function add_dependency( array $init_param, array $dependency ): array {
		foreach ( $init_param as $init_param_key => $init_param_value ) {
			if ( isset( $init_param_value['dependency'] ) ) {
				$init_param[ $init_param_key ]['dependency'] = $init_param_value['dependency'];
			} else {
				$init_param[ $init_param_key ]['dependency'] = $dependency;
			}
		}

		return $init_param;
	}
}
