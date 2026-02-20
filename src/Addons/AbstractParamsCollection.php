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
	 * Parameters to exclude from integration.
	 *
	 * @since 1.0
	 */
	protected array $exclude = [];

	/**
	 * Parameters to include only for integration.
	 *
	 * @since 1.0
	 */
	protected array $include_only = [];

	/**
	 * Flag to determine if we need add switcher for this collection.
	 *
	 * @since 1.0
	 */
	protected bool $is_switcher = true;

	/**
	 * Set top margin for collection params.
	 *
	 * @since 1.0
	 */
	protected int $gap = 0;

	/**
	 * Get collection slug.
	 *
	 * @since 1.0
	 */
	abstract public function get_slug(): string;

	/**
	 * Get collection name.
	 *
	 * @since 1.0
	 */
	abstract public function get_name(): string;

	/**
	 * Collection specific params.
	 *
	 * @since 1.0
	 */
	abstract public function get_collection_params(): array;

	/**
	 * Set group color for this collection.
	 *
	 * @since 1.0
	 */
	abstract public function get_color_group(): string;

	/**
	 * Check if we need add switcher for this collection.
	 *
	 * @since 1.0
	 */
	public function is_switcher(): bool {
		return $this->is_switcher;
	}

	/**
	 * Remove switcher for this collection.
	 *
	 * @since 1.0
	 */
	public function remove_switcher(): AbstractParamsCollection {
		$this->is_switcher = false;
		return $this;
	}

	/**
	 * Set top margin for params collection.
	 *
	 * @since 1.0
	 */
	public function set_gap( int $gap ): AbstractParamsCollection {
		$this->gap = $gap;
		return $this;
	}

	/**
	 * Get top margin for params collection.
	 *
	 * @since 1.0
	 */
	public function get_gap(): int {
		return $this->gap;
	}

	/**
	 * Switcher specific params.
	 *
	 * @since 1.0
	 */
	public function get_switcher_param(): array {
		return [
			'type'            => 'joywp_switcher',
			'wcp_group'       => true,
			'wcp_group_color' => $this->get_color_group(),
			'param_name'      => $this->prefix . 'add_' . $this->get_slug(),
			'heading'         => esc_html__( 'Enable ', 'joywp-testimonials-wpbakery-addons' ) . ucfirst( $this->get_name() ),
			'description'     => esc_html__( 'Activate ', 'joywp-testimonials-wpbakery-addons' ) . $this->get_name() . esc_html__( ' configurations.', 'joywp-testimonials-wpbakery-addons' ),
			'options'         => [
				'true' => [
					'label' => '',
					'on'    => __( 'Yes', 'joywp-testimonials-wpbakery-addons' ),
					'off'   => __( 'No', 'joywp-testimonials-wpbakery-addons' ),
				],
			],
		];
	}

	/**
	 * Get integration config.
	 *
	 * @since 1.0
	 */
	public function get_params(): array {
		$params = $this->get_collection_params();

		if ( $this->is_switcher() ) {
			$params = $this->add_switcher( $params );
		}

		if ( ! empty( $this->additional_params ) ) {
			$params = $this->add_params( $params, $this->additional_params );
		}

		if ( ! empty( $this->dependency ) ) {
			$params = $this->add_dependency( $params, $this->dependency );
		}

		if ( $this->include_only ) {
			$params = $this->implement_include_only( $params );
		} else {
			$params = $this->implement_exclude( $params );
		}

		if ( ! empty( $this->get_gap() ) ) {
			$params = $this->add_gap( $params );
		}

		return $params;
	}

	/**
	 * Add switcher params to the beginning of params array.
	 *
	 * @since 1.0
	 */
	protected function add_switcher( array $params ): array {
		$switcher_param = $this->get_switcher_param();
		if ( ! $switcher_param ) {
			return $params;
		}

		foreach ( $params as $key => $param ) {
			if ( isset( $params[ $key ]['dependency'] ) ) {
				continue;
			}

			$params[ $key ]['dependency'] = [
				'element' => $this->prefix . 'add_' . $this->get_slug(),
				'value'   => 'true',
			];
		}

		array_unshift( $params, $switcher_param );

		return $params;
	}

	/**
	 * Implement include only logic to params.
	 *
	 * @since 1.0
	 */
	protected function implement_include_only( array $params ): array {
		$result = [];
		foreach ( $params as $param_data ) {
			if ( in_array( $param_data['param_name'], $this->include_only, true ) ) {
				$result[] = $param_data;
			}
		}

		return $result;
	}

	/**
	 * Implement exclude logic to params.
	 *
	 * @since 1.0
	 */
	protected function implement_exclude( array $params ): array {
		if ( ! $this->exclude ) {
			return $params;
		}

		foreach ( $params as $key => $param_data ) {
			if ( in_array( $param_data['param_name'], $this->exclude, true ) ) {
				unset( $params[ $key ] );
			}
		}

		return $params;
	}

	/**
	 * Set parameters to exclude from integration.
	 *
	 * @since 1.0
	 */
	public function set_exclude( array $exclude_params ): AbstractParamsCollection {
		$this->exclude = $exclude_params;
		foreach ( $exclude_params as $key => $param_name ) {
			$exclude_params[ $key ] = $this->prefix . $param_name;
		}
		return $this;
	}

	/**
	 * Set parameters to include only for integration.
	 *
	 * @since 1.0
	 */
	public function set_include_only( array $include_only ): AbstractParamsCollection {
		$this->include_only = $include_only;
		foreach ( $include_only as $key => $param_name ) {
			$include_only[ $key ] = $this->prefix . $param_name;
		}
		return $this;
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
	protected function add_params( array $init_param, array $additional_params ): array {
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
	protected function add_dependency( array $init_param, array $dependency ): array {
		foreach ( $init_param as $init_param_key => $init_param_value ) {
			if ( isset( $init_param_value['dependency'] ) ) {
				$init_param[ $init_param_key ]['dependency'] = $init_param_value['dependency'];
			} else {
				$init_param[ $init_param_key ]['dependency'] = $dependency;
			}
		}

		return $init_param;
	}

	/**
	 * Add margin top to first param in collection.
	 *
	 * @since 1.0
	 */
	protected function add_gap( array $param ): array {
		$param[0]['wcp_group_margin_top'] = $this->get_gap();
		return $param;
	}
}
