<?php
/**
 * Abstract addon collection class.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons;

defined( 'ABSPATH' ) || exit;

/**
 * Class AbstractAddonCollection
 * We call 'Collection' specific
 * addon property that we can separate to collection (e.g., Border, Box Shadow, Image, etc.).
 *
 * @since 1.0
 */
abstract class AbstractAddonCollection {
	/**
	 * Config prefix.
	 *
	 * @since 1.0
	 */
	protected string $prefix = '';

	/**
	 * The addon instance.
	 *
	 * @since 1.0
	 */
	protected AbstractAddon $addon;

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
	 * Set addon instance.
	 *
	 * @since 1.0
	 */
	public function set_addon( AbstractAddon $addon ): void {
		$this->addon = $addon;
	}
}
