<?php
/**
 * This class helps manage position collection in addon templates.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Collection;

use JoywpTestimonialsWpb\Addons\AbstractAddonCollection;
use JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Collection\Position as PositionCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class Position
 *
 * @property PositionCollection $collection
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
		return joywptestimonialswpb_get_template(
			'collections/position.php',
			[
				'top'    => $atts[ $this->collection->get_param_slug( 'top' ) ] ?? '',
				'bottom' => $atts[ $this->collection->get_param_slug( 'bottom' ) ] ?? '',
				'right'  => $atts[ $this->collection->get_param_slug( 'right' ) ] ?? '',
				'left'   => $atts[ $this->collection->get_param_slug( 'left' ) ] ?? '',
				'unit'   => $this->collection->get_unit(),
			]
		);
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
