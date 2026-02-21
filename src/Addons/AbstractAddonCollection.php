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
abstract class AbstractAddonCollection extends AbstractCollection {
	/**
	 * The addon instance.
	 *
	 * @since 1.0
	 */
	protected AbstractAddon $addon;

	/**
	 * Set addon instance.
	 *
	 * @since 1.0
	 */
	public function set_addon( AbstractAddon $addon ): void {
		$this->addon = $addon;
	}
}
