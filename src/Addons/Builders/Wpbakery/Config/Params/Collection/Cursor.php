<?php
/**
 * This class helps add cursor configurations to our addons.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Config\Params\Collection;

use JoywpTestimonialsWpb\Addons\AbstractParamsCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class Cursor
 *
 * @since 1.0
 */
class Cursor extends AbstractParamsCollection {
	/**
	 * Get integration config.
	 *
	 * @since 1.0
	 */
	public function get_collection_params(): array {
		return [
			[
				'type'        => 'dropdown',
				'param_name'  => $this->collection->get_param_slug( 'type' ),
				'value'       => [
					esc_html__( 'Auto', 'joywp-testimonials-wpbakery-addons' )        => 'auto',
					esc_html__( 'Default', 'joywp-testimonials-wpbakery-addons' )     => 'default',
					esc_html__( 'Pointer', 'joywp-testimonials-wpbakery-addons' )     => 'pointer',
					esc_html__( 'Crosshair', 'joywp-testimonials-wpbakery-addons' )   => 'crosshair',
					esc_html__( 'Move', 'joywp-testimonials-wpbakery-addons' )        => 'move',
					esc_html__( 'Text', 'joywp-testimonials-wpbakery-addons' )        => 'text',
					esc_html__( 'Wait', 'joywp-testimonials-wpbakery-addons' )        => 'wait',
					esc_html__( 'Help', 'joywp-testimonials-wpbakery-addons' )        => 'help',
					esc_html__( 'Not Allowed', 'joywp-testimonials-wpbakery-addons' ) => 'not-allowed',
					esc_html__( 'None', 'joywp-testimonials-wpbakery-addons' )        => 'none',
					esc_html__( 'Grab', 'joywp-testimonials-wpbakery-addons' )        => 'grab',
					esc_html__( 'Grabbing', 'joywp-testimonials-wpbakery-addons' )    => 'grabbing',
					esc_html__( 'Zoom In', 'joywp-testimonials-wpbakery-addons' )     => 'zoom-in',
					esc_html__( 'Zoom Out', 'joywp-testimonials-wpbakery-addons' )    => 'zoom-out',
				],
				'heading'     => esc_html__( 'Cursor', 'joywp-testimonials-wpbakery-addons' ),
				'description' => esc_html__( 'Choose cursor style on hover.', 'joywp-testimonials-wpbakery-addons' ),
			],
		];
	}
}
