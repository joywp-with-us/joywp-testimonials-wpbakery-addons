<?php
/**
 * This class helps manage box-shadow collection in addon templates.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Collection;

use JoywpTestimonialsWpb\Addons\AbstractAddonCollection;
use JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Addon;

defined( 'ABSPATH' ) || exit;

/**
 * Class box_shadow
 *
 * @extends AbstractAddonCollection<Addon>
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
		return joywptestimonialswpb_get_template(
			'collections/box-shadow.php',
			[
				'horizontal' => $atts[ $this->collection->get_param_slug( 'horizontal' ) ] ?? '0',
				'vertical'   => $atts[ $this->collection->get_param_slug( 'vertical' ) ] ?? '0',
				'blur'       => $atts[ $this->collection->get_param_slug( 'blur' ) ] ?? '0',
				'spread'     => $atts[ $this->collection->get_param_slug( 'spread' ) ] ?? '0',
				'color'      => $atts[ $this->collection->get_param_slug( 'color' ) ] ?? '',
			]
		);
	}
}
