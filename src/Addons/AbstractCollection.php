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
	protected string $prefix = '';

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
	 * Set config prefix.
	 *
	 * @since 1.0
	 * @return $this
	 */
	public function set_prefix( string $prefix ): self {
		$this->prefix = $prefix;
		return $this;
	}

	/**
	 * Get switcher slug for this collection.
	 *
	 * @since 1.0
	 */
	public function get_switcher_slug(): string {
		return $this->prefix . 'add_' . $this->get_slug();
	}
}
