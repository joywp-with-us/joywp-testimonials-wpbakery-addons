<?php
/**
 * This class helps manage font family collection.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Collection;

use JoywpTestimonialsWpb\Addons\AbstractCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class Font
 *
 * @since 1.0
 */
class ParamGroup extends AbstractCollection {
	/**
	 * Get collection slug.
	 *
	 * @since 1.0
	 */
	public function get_slug(): string {
		return 'param_group';
	}

	/**
	 * Get collection name.
	 *
	 * @since 1.0
	 */
	public function get_name(): string {
		return 'param group';
	}
}
