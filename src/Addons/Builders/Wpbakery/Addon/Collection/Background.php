<?php
/**
 * This class helps manage background collection in addon templates.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Collection;

use JoywpTestimonialsWpb\Addons\AbstractAddonCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class Background
 *
 * @since 1.0
 */
class Background extends AbstractAddonCollection {
	/**
	 * Render collection output.
	 *
	 * @since 1.0
	 */
	public function render( array $atts ): void {
		switch ( $atts[ $this->collection->prefix . 'background_type' ] ) {
			case 'color':
				printf(
					'background-color: %s;',
					esc_attr( $atts[ $this->collection->prefix . 'background_color' ] )
				);
				break;
			case 'gradient':
				printf(
					'background: linear-gradient(to right, %s, %s);',
					esc_attr( $atts[ $this->collection->prefix . 'from_gradient_color' ] ),
					esc_attr( $atts[ $this->collection->prefix . 'to_gradient_color' ] )
				);
				break;
		}
	}
}
