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
		return sprintf(
			'border-width: %spx; border-style: %s; border-color: %s; border-radius: %spx;',
			esc_attr( $atts[ $this->collection->get_param_slug( 'width' ) ] ),
			esc_attr( $atts[ $this->collection->get_param_slug( 'style' ) ] ),
			esc_attr( $atts[ $this->collection->get_param_slug( 'color' ) ] ),
			esc_attr( $atts[ $this->collection->get_param_slug( 'radius' ) ] )
		);
	}
}
