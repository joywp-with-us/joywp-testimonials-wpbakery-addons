<?php
/**
 * This class helps manage position collection in addon templates.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Collection;

use JoywpTestimonialsWpb\Addons\AbstractAddonCollection;
use JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Addon;

defined( 'ABSPATH' ) || exit;

/**
 * Class Position
 *
 * @extends AbstractAddonCollection<Addon>
 *
 * @since 1.0
 */
class Position extends AbstractAddonCollection {
	/**
	 * Get render collection output.
	 *
	 * @since 1.0
	 */
	public function get_render_output( array $atts ): string {
		return sprintf(
			'top: %spx; bottom: %s; right: %s; left: %spx;',
			esc_attr( $atts[ $this->collection->get_param_slug( 'top' ) ] ),
			esc_attr( $atts[ $this->collection->get_param_slug( 'bottom' ) ] ),
			esc_attr( $atts[ $this->collection->get_param_slug( 'right' ) ] ),
			esc_attr( $atts[ $this->collection->get_param_slug( 'left' ) ] )
		);
	}
}
