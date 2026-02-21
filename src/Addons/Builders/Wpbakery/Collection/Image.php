<?php
/**
 * This class helps manage image collection.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Collection;

use JoywpTestimonialsWpb\Addons\AbstractCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class Image
 *
 * @since 1.0
 */
class Image extends AbstractCollection {
	/**
	 * Get collection slug.
	 *
	 * @since 1.0
	 */
	public function get_slug(): string {
		return 'image';
	}

	/**
	 * Get collection name.
	 *
	 * @since 1.0
	 */
	public function get_name(): string {
		return 'image';
	}
}
