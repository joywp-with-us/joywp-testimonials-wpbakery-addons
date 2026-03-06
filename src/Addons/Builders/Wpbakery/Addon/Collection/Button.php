<?php
/**
 * This class helps manage button collection in addon templates.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Collection;

use JoywpTestimonialsWpb\Addons\AbstractAddonCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class Button
 *
 * @since 1.0
 */
class Button extends AbstractAddonCollection {


	/**
	 * Get render collection output.
	 *
	 * @since 1.0
	 */
	public function get_render_output( array $atts ): string {
		return $this->addon->get_integrated_addon_output( 'vc_btn', $this->collection->remove_prefix( $atts ) );
	}
}
