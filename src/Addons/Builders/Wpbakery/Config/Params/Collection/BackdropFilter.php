<?php
/**
 * This class helps add backdrop-filter configurations to our addons.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Config\Params\Collection;

use JoywpTestimonialsWpb\Addons\AbstractParamsCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class BackdropFilter
 *
 * @since 1.0
 */
class BackdropFilter extends AbstractParamsCollection {
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
					esc_html__( 'None', 'joywp-testimonials-wpbakery-addons' )       => 'none',
					esc_html__( 'Blur', 'joywp-testimonials-wpbakery-addons' )        => 'blur',
					esc_html__( 'Brightness', 'joywp-testimonials-wpbakery-addons' )  => 'brightness',
					esc_html__( 'Contrast', 'joywp-testimonials-wpbakery-addons' )    => 'contrast',
					esc_html__( 'Grayscale', 'joywp-testimonials-wpbakery-addons' )   => 'grayscale',
					esc_html__( 'Hue Rotate', 'joywp-testimonials-wpbakery-addons' )  => 'hue-rotate',
					esc_html__( 'Invert', 'joywp-testimonials-wpbakery-addons' )      => 'invert',
					esc_html__( 'Opacity', 'joywp-testimonials-wpbakery-addons' )     => 'opacity',
					esc_html__( 'Saturate', 'joywp-testimonials-wpbakery-addons' )    => 'saturate',
					esc_html__( 'Sepia', 'joywp-testimonials-wpbakery-addons' )       => 'sepia',
				],
				'heading'     => esc_html__( 'Backdrop Filter', 'joywp-testimonials-wpbakery-addons' ),
				'description' => esc_html__( 'Choose a backdrop filter type.', 'joywp-testimonials-wpbakery-addons' ),
			],
			[
				'type'        => 'joywp_number_slider',
				'value'       => '0',
				'min'         => '0',
				'max'         => '100',
				'step'        => '1',
				'heading'     => esc_html__( 'Backdrop Filter Value', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'  => $this->collection->get_param_slug( 'value' ),
				'description' => esc_html__( 'Regulate filter effect with filter value.', 'joywp-testimonials-wpbakery-addons' ),
			],
		];
	}
}
