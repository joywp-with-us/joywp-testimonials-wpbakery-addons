<?php
/**
 * This class helps manage cursor collection in addon templates.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Collection;

use JoywpTestimonialsWpb\Addons\AbstractAddonCollection;
use JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Addon;

defined( 'ABSPATH' ) || exit;

/**
 * Class Cursor
 *
 * @extends AbstractAddonCollection<Addon>
 *
 * @since 1.0
 */
class Cursor extends AbstractAddonCollection {
	/**
	 * Get render collection output.
	 *
	 * @since 1.0
	 */
	public function get_render_output( array $atts ): string {
		return joywptestimonialswpb_get_template(
			'collections/cursor.php',
			[
				'type' => $atts[ $this->collection->get_param_slug( 'type' ) ] ?? '',
			]
		);
	}
}
