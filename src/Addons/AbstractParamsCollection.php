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
	 * Collection specific params.
	 *
	 * @since 1.0
	 */
	abstract public function get_collection_params(): array;

	/**
	 * The collection instance.
	 *
	 * @since 1.0
	 */
	public AbstractCollection $collection;

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
	protected bool $is_switcher = false;

	/**
	 * Set top margin for collection params.
	 *
	 * @since 1.0
	 */
	protected int $gap = 0;

	/**
	 * Set collection color group.
	 *
	 * @since 1.0
	 */
	protected bool $is_color = false;

	/**
	 * Params specific to collection switcher.
	 */
	protected array $switcher_params = [];

	/**
	 * Get the library of collections colors.
	 *
	 * @since 1.0
	 */
	public function get_color_lib(): array {
		return apply_filters(
			'joywp_testimonials_get_color_lib_collection',
			[
				'background'  => '#d8ccff',
				'border'      => '#1c1e21',
				'image'       => '#8b0000',
				'box_shadow'  => '#6b7280',
				'button'      => '#5c4db1',
				'font_family' => '#2c2c2c',
				'position'    => '#2dd4bf',
			]
		);
	}

	/**
	 * Set group color for this collection.
	 *
	 * @since 1.0
	 */
	public function get_color(): string {
		$lib = $this->get_color_lib();
		return $lib[ $this->collection->get_slug() ] ?? '#ffffff';
	}

	/**
	 * AbstractParamsCollection constructor.
	 *
	 * @since 1.0
	 */
	public function __construct( AbstractCollection $collection ) {
		$this->collection = $collection;
	}

	/**
	 * Check if we need add switcher for this collection.
	 *
	 * @since 1.0
	 */
	public function is_switcher(): bool {
		return $this->is_switcher;
	}

	/**
	 * Switcher setter.
	 *
	 * @since 1.0
	 */
	public function set_switcher( array $params = [] ): self {
		$this->switcher_params = $params;
		$this->is_switcher     = true;
		return $this;
	}

	/**
	 * Color setter.
	 *
	 * @since 1.0
	 */
	public function set_color(): self {
		$this->is_color = true;
		return $this;
	}

	/**
	 * Setter top margin for params collection.
	 *
	 * @since 1.0
	 */
	public function set_gap( int $gap ): self {
		$this->gap = $gap;
		return $this;
	}

	/**
	 * Set parameters to exclude from integration.
	 *
	 * @since 1.0
	 */
	public function set_exclude( array $exclude_params ): self {
		$this->exclude = $exclude_params;
		foreach ( $exclude_params as $key => $param_name ) {
			$exclude_params[ $key ] = $this->collection->get_param_slug( $param_name );
		}
		return $this;
	}

	/**
	 * Set parameters to include only for integration.
	 *
	 * @since 1.0
	 */
	public function set_include_only( array $include_only ): self {
		foreach ( $include_only as $key => $param_name ) {
			$this->include_only[ $key ] = $this->collection->get_param_slug( $param_name );
		}
		return $this;
	}

	/**
	 * Set additional params that we apply to each param set.
	 *
	 * @since 1.0
	 */
	public function set_additional_params( array $additional_params ): self {
		$this->additional_params = $additional_params;
		return $this;
	}

	/**
	 * Set dependency that we apply to each param set.
	 *
	 * @since 1.0
	 */
	public function set_dependency( array $dependency ): self {
		$this->dependency = $dependency;
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
		$heading     = $this->switcher_params['heading'] ?? esc_html__( 'Enable ', 'joywp-testimonials-wpbakery-addons' ) . ucfirst( $this->collection->get_name() );
		$description = $this->switcher_params['description'] ?? esc_html__( 'Activate ', 'joywp-testimonials-wpbakery-addons' ) . $this->collection->get_name() . esc_html__( ' configurations.', 'joywp-testimonials-wpbakery-addons' );
		$switcher    = [
			'type'        => 'joywp_switcher',
			'param_name'  => $this->collection->get_switcher_slug(),
			'heading'     => $heading,
			'description' => $description,
			'value'       => 'false',
			'default_set' => 'false',
			'options'     => [
				'true' => [
					'label' => '',
					'on'    => __( 'Yes', 'joywp-testimonials-wpbakery-addons' ),
					'off'   => __( 'No', 'joywp-testimonials-wpbakery-addons' ),
				],
			],
		];

		if ( $this->is_color() ) {
			$switcher['wcp_group']       = true;
			$switcher['wcp_group_color'] = $this->get_color();
		}

		return $switcher;
	}

	/**
	 * Get integration config.
	 *
	 * @since 1.0
	 */
	public function get_params(): array {
		$params = $this->get_collection_params();

		return $this->integrate_specific_params( $params );
	}

	/**
	 * Integrate specific params that we can specify in setters.
	 *
	 * @since 1.0
	 */
	protected function integrate_specific_params( array $params ): array {
		if ( $this->include_only ) {
			$params = $this->implement_include_only( $params );
		} else {
			$params = $this->implement_exclude( $params );
		}

		$params = $this->add_switcher( $params );

		$params = $this->add_params( $params );

		$params = $this->add_dependency( $params );

		$params = $this->add_gap( $params );

		return $this->add_color( $params );
	}

	/**
	 * Add switcher params to the beginning of params array.
	 *
	 * @since 1.0
	 */
	protected function add_switcher( array $params ): array {
		if ( ! $this->is_switcher() ) {
			return $params;
		}

		$switcher_param = $this->get_switcher_param();
		if ( ! $switcher_param ) {
			return $params;
		}

		foreach ( $params as $key => $param ) {
			if ( isset( $param['dependency'] ) ) {
				continue;
			}

			$params[ $key ]['dependency'] = [
				'element' => $this->collection->get_switcher_slug(),
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
	 * Add additional params to each param set.
	 *
	 * @since 1.0
	 */
	protected function add_params( array $init_param ): array {
		if ( empty( $this->additional_params ) ) {
			return $init_param;
		}

		foreach ( $init_param as $init_param_key => $init_param_value ) {
			$init_param[ $init_param_key ] = array_merge(
				$init_param_value,
				$this->additional_params
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
	protected function add_dependency( array $init_param ): array {
		if ( empty( $this->dependency ) ) {
			return $init_param;
		}

		foreach ( $init_param as $init_param_key => $init_param_value ) {
			if ( isset( $init_param_value['dependency'] ) ) {
				$init_param[ $init_param_key ]['dependency'] = $init_param_value['dependency'];
			} else {
				$init_param[ $init_param_key ]['dependency'] = $this->dependency;
			}
		}

		return $init_param;
	}

	/**
	 * Add margin top to first param in collection.
	 *
	 * @since 1.0
	 */
	protected function add_gap( array $params ): array {
		if ( empty( $this->get_gap() ) ) {
			return $params;
		}

		$params[0]['wcp_group_margin_top'] = $this->get_gap();
		return $params;
	}

	/**
	 * Check if we need add color group for this collection.
	 *
	 * @since 1.0
	 */
	public function is_color(): bool {
		return $this->is_color;
	}

	/**
	 * Add color group to each param in collection.
	 *
	 * @since 1.0
	 */
	protected function add_color( array $params ): array {
		if ( ! $this->is_color() ) {
			return $params;
		}

		foreach ( $params as $key => $param_data ) {
			$params[ $key ]['wcp_group_color'] = $this->get_color();
			$params[ $key ]['wcp_group']       = true;
		}

		return $params;
	}
}
