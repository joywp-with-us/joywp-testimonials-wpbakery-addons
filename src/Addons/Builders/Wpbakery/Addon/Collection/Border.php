<?php
/**
 * This class helps manage border collection in addon templates.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Collection;

use JoywpTestimonialsWpb\Addons\AbstractAddonCollection;
use JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Addon;

defined( 'ABSPATH' ) || exit;

/**
 * Class Border
 *
 * @extends AbstractAddonCollection<Addon>
 *
 * @since 1.0
 */
class Border extends AbstractAddonCollection {
	/**
	 * Get render collection output.
	 *
	 * @since 1.0
	 */
	public function get_render_output( array $atts ): string {
		return joywptestimonialswpb_get_template(
			'collections/border.php',
			[
				'width'  => $atts[ $this->collection->get_param_slug( 'width' ) ],
				'style'  => $atts[ $this->collection->get_param_slug( 'style' ) ],
				'color'  => $atts[ $this->collection->get_param_slug( 'color' ) ],
				'radius' => $atts[ $this->collection->get_param_slug( 'radius' ) ],
			]
		);
	}
}
