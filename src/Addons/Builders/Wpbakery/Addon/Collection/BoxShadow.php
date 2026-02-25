<?php
/**
 * This class helps manage box-shadow collection in addon templates.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Collection;

use JoywpTestimonialsWpb\Addons\AbstractAddonCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class box_shadow
 *
 * @since 1.0
 */
class BoxShadow extends AbstractAddonCollection {
	/**
	 * Get render collection output.
	 *
	 * @since 1.0
	 */
	public function get_render_output( array $atts ): string {
		return sprintf(
			'box-shadow: %spx %spx %spx %spx %s;',
			esc_attr( $atts[ $this->collection->get_param_slug( 'horizontal' ) ] ),
			esc_attr( $atts[ $this->collection->get_param_slug( 'vertical' ) ] ),
			esc_attr( $atts[ $this->collection->get_param_slug( 'blur' ) ] ),
			esc_attr( $atts[ $this->collection->get_param_slug( 'spread' ) ] ),
			esc_attr( $atts[ $this->collection->get_param_slug( 'color' ) ] )
		);
	}
}
