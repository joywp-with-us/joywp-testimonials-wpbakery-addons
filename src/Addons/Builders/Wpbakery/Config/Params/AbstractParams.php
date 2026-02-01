<?php
/**
 * Abstract params class.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Config\Params;

defined( 'ABSPATH' ) || exit;

/**
 * Class AbstractParams
 *
 * @since 1.0
 */
abstract class AbstractParams {
	/**
	 * Parameters to exclude from integration.
	 */
	public array $exclude = [];

	/**
	 * Config prefix.
	 */
	protected string $prefix = '';

	/**
	 * Get integration config.
	 *
	 * @since 1.0
	 */
	abstract public function get_params(): array;

	/**
	 * Set parameters to exclude from integration.
	 *
	 * @since 1.0
	 */
	public function set_exclude( array $exclude_params ): AbstractParams {
		$this->exclude = $exclude_params;
		return $this;
	}

	/**
	 * Set parameters to exclude from integration.
	 *
	 * @since 1.0
	 */
	public function set_prefix( array $exclude_params ): AbstractParams {
		$this->exclude = $exclude_params;
		return $this;
	}

	/**
	 * Add additional params to each param set.
	 *
	 * @since 1.0
	 */
	public function add_params( array $init_param, array $additional_params ): array {
		foreach ( $init_param as $init_param_key => $init_param_value ) {
			$init_param[ $init_param_key ] = array_merge(
				$init_param_value,
				$additional_params
			);
		}

		return $init_param;
	}

	/**
	 * Add dependency to each param set,
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
