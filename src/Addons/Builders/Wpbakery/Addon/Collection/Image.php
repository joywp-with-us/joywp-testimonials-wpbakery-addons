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
	 * Get render collection output.
	 *
	 * @since 1.0
	 */
	public function get_render_output( array $atts ): string {
		return $this->addon->get_integrated_addon_output( 'vc_single_image', $this->collection->remove_prefix( $atts ) );
	}

	/**
	 * Get image link.
	 *
	 * @since 1.0
	 */
	public function get_image_link( array $atts ): string {
		$html = $this->addon->get_integrated_addon_output( 'vc_single_image', $this->collection->remove_prefix( $atts ) );

		preg_match( '/<img.*?src=["\'](.*?)["\'].*?>/i', $html, $matches );

		return $matches[1] ?? '';
	}
}
