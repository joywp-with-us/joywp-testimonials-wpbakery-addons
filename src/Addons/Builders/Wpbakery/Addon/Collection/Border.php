<?php
/**
 * This class helps manage border collection in addon templates.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Collection;

use JoywpTestimonialsWpb\Addons\AbstractAddonCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class Border
 *
 * @since 1.0
 */
class Border extends AbstractAddonCollection {
	/**
	 * Render collection output.
	 *
	 * @since 1.0
	 */
	public function render( array $atts ): void {
		printf(
			'border-width: %spx; border-style: %s; border-color: %s; border-radius: %spx;',
			esc_attr( $atts[ $this->prefix . 'border_width' ] ),
			esc_attr( $atts[ $this->prefix . 'border_style' ] ),
			esc_attr( $atts[ $this->prefix . 'border_color' ] ),
			esc_attr( $atts[ $this->prefix . 'border_radius' ] )
		);
	}
}
