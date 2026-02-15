<?php
/**
 * This class helps manage font-family collection in addon templates.
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
class FontFamily extends AbstractAddonCollection {
	/**
	 * Render collection output.
	 *
	 * @since 1.0
	 */
	public function render( array $atts ): void {
		printf(
			'font-family: %s;',
			esc_attr( $atts[ $this->prefix . 'font_family' ] )
		);
	}
}
