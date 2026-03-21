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
		$result = '';
		$unit   = $this->collection->get_unit();
		$top    = $atts[ $this->collection->get_param_slug( 'top' ) ];
		if ( $top ) {
			$result .= 'top: ' . esc_attr( $top ) . esc_attr( $unit ) . '; ';
		}
		$bottom = $atts[ $this->collection->get_param_slug( 'bottom' ) ];
		if ( $bottom ) {
			$result .= 'bottom: ' . esc_attr( $bottom ) . esc_attr( $unit ) . '; ';
		}
		$right = $atts[ $this->collection->get_param_slug( 'right' ) ];
		if ( $right ) {
			$result .= 'right: ' . esc_attr( $right ) . esc_attr( $unit ) . '; ';
		}
		$left = $atts[ $this->collection->get_param_slug( 'left' ) ];
		if ( $left ) {
			$result .= 'left: ' . esc_attr( $left ) . esc_attr( $unit ) . '; ';
		}

		return $result;
	}


	/**
	 * Set unit for position values.
	 *
	 * @since 1.0
	 */
	public function with_unit( string $unit ): self {
		$this->collection->unit = $unit;
		return $this;
	}
}
