<?php
/**
 * Abstract params collection class.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons;

defined( 'ABSPATH' ) || exit;

/**
 * Class AbstractParamsCollection
 * We call 'Params Collection' array of params that we correspond for some specific
 * addon property that we can separate to collection (e.g., Border, Box Shadow, Image, etc.).
 *
 * @since 1.0
 */
abstract class AbstractParamsCollection {
	/**
	 * Config prefix.
	 *
	 * @since 1.0
	 */
	protected string $prefix = '';

	/**
	 * Additional params to add to each param set.
	 *
	 * @since 1.0
	 */
	protected array $additional_params = [];

	/**
	 * Dependency to add to each param set.
	 *
	 * @since 1.0
	 */
	protected array $dependency = [];

	/**
	 * Collection specific params.
	 *
	 * @since 1.0
	 */
	abstract public function get_collection_params(): array;

	/**
	 * Get integration config.
	 *
	 * @since 1.0
	 */
	public function get_params(): array {
		$params = $this->get_collection_params();

		if ( ! empty( $this->additional_params ) ) {
			$params = $this->add_params( $params, $this->additional_params );
		}

		if ( ! empty( $this->dependency ) ) {
			$params = $this->add_dependency( $params, $this->dependency );
		}

		return $params;
	}

	/**
	 * Set prefix for params.
	 *
	 * @since 1.0
	 */
	public function set_prefix( string $prefix ): AbstractParamsCollection {
		$this->prefix = $prefix;
		return $this;
	}

	/**
	 * Set additional params that we apply to each param set.
	 *
	 * @since 1.0
	 */
	public function set_additional_params( array $additional_params ): AbstractParamsCollection {
		$this->additional_params = $additional_params;
		return $this;
	}

	/**
	 * Set dependency that we apply to each param set.
	 *
	 * @since 1.0
	 */
	public function set_dependency( array $dependency ): AbstractParamsCollection {
		$this->dependency = $dependency;
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
