<?php
/**
 * This class helps manage backdrop-filter collection in addon templates.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Collection;

use JoywpTestimonialsWpb\Addons\AbstractAddonCollection;
use JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Addon;

defined( 'ABSPATH' ) || exit;

/**
 * Class BackdropFilter
 *
 * @extends AbstractAddonCollection<Addon>
 *
 * @since 1.0
 */
class BackdropFilter extends AbstractAddonCollection {
	/**
	 * Get render collection output.
	 *
	 * @since 1.0
	 */
	public function get_render_output( array $atts ): string {
		$type  = $atts[ $this->collection->get_param_slug( 'type' ) ] ?? 'none';
		$value = $atts[ $this->collection->get_param_slug( 'value' ) ] ?? '0';

		if ( ! $type || 'none' === $type ) {
			return '';
		}

		if ( 'blur' === $type ) {
			$unit = 'px';
		} elseif ( 'hue-rotate' === $type ) {
			$unit = 'deg';
		} else {
			$unit = '%';
		}

		return joywptestimonialswpb_get_template(
			'collections/backdrop-filter.php',
			[
				'type'  => $type,
				'value' => $value,
				'unit'  => $unit,
			]
		);
	}
}
