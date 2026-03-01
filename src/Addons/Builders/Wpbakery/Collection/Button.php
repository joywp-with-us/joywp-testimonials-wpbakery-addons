<?php
/**
 * This class helps manage button collection.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Collection;

use JoywpTestimonialsWpb\Addons\AbstractCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class Button
 *
 * @since 1.0
 */
class Button extends AbstractCollection {
	/**
	 * Get collection slug.
	 *
	 * @since 1.0
	 */
	public function get_slug(): string {
		return 'button';
	}

	/**
	 * Get collection name.
	 *
	 * @since 1.0
	 */
	public function get_name(): string {
		return 'button';
	}
}
