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
	 * Get collection slug.
	 *
	 * @since 1.0
	 */
	public function get_slug(): string {
		return 'border';
	}

	/**
	 * Get collection name.
	 *
	 * @since 1.0
	 */
	public function get_name(): string {
		return 'border';
	}

	/**
	 * Render collection output.
	 *
	 * @since 1.0
	 */
	public function render( array $atts ): void {
		if ( ! isset( $atts[ $this->prefix . 'add_border' ] ) || 'true' !== $atts[ $this->prefix . 'add_border' ] ) {
			return;
		}

		printf(
			'border-width: %spx; border-style: %s; border-color: %s; border-radius: %spx;',
			esc_attr( $atts[ $this->prefix . 'border_width' ] ),
			esc_attr( $atts[ $this->prefix . 'border_style' ] ),
			esc_attr( $atts[ $this->prefix . 'border_color' ] ),
			esc_attr( $atts[ $this->prefix . 'border_radius' ] )
		);
	}
}
