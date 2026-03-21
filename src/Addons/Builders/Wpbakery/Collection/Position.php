<?php
/**
 * This class manages position collection.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Collection;

use JoywpTestimonialsWpb\Addons\AbstractCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class Position
 *
 * @since 1.0
 */
class Position extends AbstractCollection {

	/**
	 * Unit for position values.
	 *
	 * @since 1.0
	 */
	public string $unit = 'px';

	/**
	 * Get collection slug.
	 *
	 * @since 1.0
	 */
	public function get_slug(): string {
		return 'position';
	}

	/**
	 * Get collection name.
	 *
	 * @since 1.0
	 */
	public function get_name(): string {
		return 'position';
	}

	/**
	 * Get unit for position values.
	 *
	 * @since 1.0
	 */
	public function get_unit(): string {
		return $this->unit;
	}
}
