<?php
/**
 * This class helps manage image collection in addon templates.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Collection;

use JoywpTestimonialsWpb\Addons\AbstractAddonCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class Image
 *
 * @since 1.0
 */
class Image extends AbstractAddonCollection {
	/**
	 * Render collection output.
	 *
	 * @since 1.0
	 */
	public function render( array $atts ): void {
		$this->addon->output_integrated_addon( 'vc_single_image', $atts );
	}
}
