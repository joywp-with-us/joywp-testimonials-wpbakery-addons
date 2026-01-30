<?php
/**
 * Abstraction for integrations with other addons.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Config\Integration;

defined( 'ABSPATH' ) || exit;

/**
 * Class AbstractIntegration
 *
 * @since 1.0
 */
abstract class AbstractIntegration {
	/**
	 * Parameters to exclude from integration.
	 */
	public array $exclude = [];

	/**
	 * Prefix for integrated params.
	 */
	public string $prefix = '';

	/**
	 * Get integration config.
	 *
	 * @since 1.0
	 */
	abstract public function get_integration_config(): array;

	/**
	 * Get params list that we always exclude.
	 *
	 * @since 1.0
	 */
	public function get_always_exclude_params(): array {
		return [];
	}

	/**
	 * Set parameters to exclude from integration.
	 *
	 * @since 1.0
	 */
	public function set_exclude( array $exclude_params ): AbstractIntegration {
		$this->exclude = $exclude_params;
		return $this;
	}

	/**
	 * Set parameters to exclude from integration.
	 *
	 * @since 1.0
	 */
	public function set_prefix( array $exclude_params ): AbstractIntegration {
		$this->exclude = $exclude_params;
		return $this;
	}

	/**
	 * Get integration config.
	 *
	 * @since 1.0
	 */
	public function get_config(): array {
		$integration_config = $this->get_integration_config();

		$exclude = array_merge( $this->get_always_exclude_params(), $this->exclude );

		$include_params = [ 'exclude' => $exclude ];

		$config =
			vc_map_integrate_shortcode(
				$integration_config,
				'',
				'',
				$include_params
			);

		return $config;
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
