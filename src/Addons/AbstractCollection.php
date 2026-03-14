<?php
/**
 * Abstract collection class.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons;

defined( 'ABSPATH' ) || exit;

/**
 * Class AbstractCollection
 * We call 'Collection' specific
 * addon property that we can separate to collection (e.g., Border, Box Shadow, Image, etc.).
 *
 * @since 1.0
 */
abstract class AbstractCollection {
	/**
	 * Config prefix.
	 *
	 * @since 1.0
	 */
	private string $prefix;

	/**
	 * AbstractCollection constructor.
	 *
	 * @since 1.0
	 */
	public function __construct( string $prefix ) {
		$this->prefix = $prefix . '_';
	}

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
	 * Get switcher slug for this collection.
	 *
	 * @since 1.0
	 */
	public function get_switcher_slug(): string {
		return $this->prefix . 'add_' . $this->get_slug();
	}

	/**
	 * Get param prefix for this collection.
	 *
	 * @since 1.0
	 */
	public function get_param_prefix(): string {
		return $this->prefix . $this->get_slug();
	}

	/**
	 * Get param prefix for this collection.
	 *
	 * @since 1.0
	 */
	public function get_param_slug( string $param_slug = '' ): string {
		if ( '' === $param_slug ) {
			return $this->get_param_prefix();
		} else {
			return $this->get_param_prefix() . '_' . $param_slug;
		}
	}

	/**
	 * Remove collection prefix from params atts.
	 *
	 * @since 1.0
	 */
	public function remove_prefix( array $atts ): array {
		$prefix = $this->get_param_prefix() . '_';
		$result = [];
		foreach ( $atts as $key => $value ) {
			if ( 0 === strpos( $key, $prefix ) ) {
				$new_key = substr( $key, strlen( $prefix ) );
				unset( $atts[ $key ] );
				$result[ $new_key ] = $value;
			}
		}

		return $result;
	}
}
