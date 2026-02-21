<?php
/**
 * This class helps manage background collection.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Collection;

use JoywpTestimonialsWpb\Addons\AbstractCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class Background
 *
 * @since 1.0
 */
class Background extends AbstractCollection {

	/**
	 * Get collection slug.
	 *
	 * @since 1.0
	 */
	public function get_slug(): string {
		return 'background';
	}

	/**
	 * Get collection name.
	 *
	 * @since 1.0
	 */
	public function get_name(): string {
		return 'background';
	}
}
