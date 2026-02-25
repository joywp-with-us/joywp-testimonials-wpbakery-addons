<?php
/**
 * This class helps add border configurations to our addons.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Config\Params\Collection;

use JoywpTestimonialsWpb\Addons\AbstractParamsCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class Border
 *
 * @since 1.0
 */
class Border extends AbstractParamsCollection {
	/**
	 * Get collection color group.
	 *
	 * @since 1.0
	 */
	public function get_color(): string {
		return '#1c1e21';
	}

	/**
	 * Get integration config.
	 *
	 * @since 1.0
	 */
	public function get_collection_params(): array {
		return [
			[
				'type'        => 'dropdown',
				'param_name'  => $this->collection->get_param_slug( 'style' ),
				'value'       => [
					esc_html__( 'Solid', 'joywp-testimonials-wpbakery-addons' )  => 'solid',
					esc_html__( 'Dashed', 'joywp-testimonials-wpbakery-addons' ) => 'dashed',
					esc_html__( 'Dotted', 'joywp-testimonials-wpbakery-addons' ) => 'dotted',
					esc_html__( 'Double', 'joywp-testimonials-wpbakery-addons' ) => 'double',
					esc_html__( 'Groove', 'joywp-testimonials-wpbakery-addons' ) => 'groove',
					esc_html__( 'Ridge', 'joywp-testimonials-wpbakery-addons' )  => 'ridge',
					esc_html__( 'Inset', 'joywp-testimonials-wpbakery-addons' )  => 'inset',
					esc_html__( 'Outset', 'joywp-testimonials-wpbakery-addons' ) => 'outset',
				],
				'heading'     => esc_html__( 'Border Style', 'joywp-testimonials-wpbakery-addons' ),
				'description' => esc_html__( 'Choose border style.', 'joywp-testimonials-wpbakery-addons' ),
			],
			[
				'type'        => 'joywp_number_slider',
				'value'       => '1',
				'min'         => '0',
				'max'         => '100',
				'step'        => '1',
				'heading'     => esc_html__( 'Border Width', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'  => $this->collection->get_param_slug( 'width' ),
				'title'       => esc_html__( 'px', 'joywp-testimonials-wpbakery-addons' ),
				'description' => esc_html__( 'Set custom border width in px from 0 to 10.', 'joywp-testimonials-wpbakery-addons' ),
			],
			[
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Border color', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'  => $this->collection->get_param_slug( 'color' ),
				'description' => esc_html__( 'Select custom color for border.', 'joywp-testimonials-wpbakery-addons' ),
				'value'       => '#cccccc00',
			],
			[
				'type'        => 'joywp_number_slider',
				'value'       => '0',
				'min'         => '0',
				'max'         => '100',
				'step'        => '1',
				'heading'     => esc_html__( 'Border Radius', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'  => $this->collection->get_param_slug( 'radius' ),
				'title'       => esc_html__( 'px', 'joywp-testimonials-wpbakery-addons' ),
				'description' => esc_html__( 'Set custom border radius in px from 0 to 100.', 'joywp-testimonials-wpbakery-addons' ),
			],
		];
	}
}
