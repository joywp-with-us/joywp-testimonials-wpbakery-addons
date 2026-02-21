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
	 * Get collection slug.
	 *
	 * @since 1.0
	 */
	public function get_slug(): string {
		return 'box_shadow';
	}

	/**
	 * Get collection name.
	 *
	 * @since 1.0
	 */
	public function get_name(): string {
		return 'box shadow';
	}

	/**
	 * Render collection output.
	 *
	 * @since 1.0
	 */
	public function render( array $atts ): void {
		if ( ! isset( $atts[ $this->prefix . 'add_box_shadow' ] ) || 'true' !== $atts[ $this->prefix . 'add_box_shadow' ] ) {
			return;
		}

		printf(
			'box-shadow: %spx %spx %spx %spx %s;',
			esc_attr( $atts[ $this->prefix . 'box_shadow_horizontal' ] ),
			esc_attr( $atts[ $this->prefix . 'box_shadow_vertical' ] ),
			esc_attr( $atts[ $this->prefix . 'box_shadow_blur' ] ),
			esc_attr( $atts[ $this->prefix . 'box_shadow_spread' ] ),
			esc_attr( $atts[ $this->prefix . 'box_shadow_color' ] )
		);
	}
}
