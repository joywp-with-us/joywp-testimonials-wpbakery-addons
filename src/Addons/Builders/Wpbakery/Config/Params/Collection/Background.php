<?php
/**
 * This class helps add background configurations to our addons.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Config\Params\Collection;

use JoywpTestimonialsWpb\Addons\AbstractParamsCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class Background
 *
 * @since 1.0
 */
class Background extends AbstractParamsCollection {
	/**
	 * Get collection color group.
	 *
	 * @since 1.0
	 */
	public function get_color(): string {
		return '#8B0000';
	}

	/**
	 * Get integration config.
	 *
	 * @since 1.0
	 */
	public function get_collection_params(): array {
		return [
			[
				'type'       => 'dropdown',
				'param_name' => $this->get_param_prefix() . '_type',
				'value'      => [
					__( 'Color', 'joywp-testimonials-wpbakery-addons' )    => 'color',
					__( 'Gradient', 'joywp-testimonials-wpbakery-addons' ) => 'gradient',
				],
			],
			[
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'From', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'       => $this->collection->prefix . 'from_gradient_color',
				'description'      => esc_html__( 'Choose the starting color of the gradient.', 'joywp-testimonials-wpbakery-addons' ),
				'value'            => '#cccccc00',
				'dependency'       => [
					'element' => $this->get_param_prefix() . '_type',
					'value'   => $this->collection->prefix . 'gradient',
				],
				'edit_field_class' => 'vc_col-sm-6',
			],
			[
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'To', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'       => $this->collection->prefix . 'to_gradient_color',
				'description'      => esc_html__( 'Choose the ending color of the gradient.', 'joywp-testimonials-wpbakery-addons' ),
				'value'            => '#cccccc00',
				'dependency'       => [
					'element' => $this->get_param_prefix() . '_type',
					'value'   => 'gradient',
				],
				'edit_field_class' => 'vc_col-sm-6',
			],
			[
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Background Color', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'  => $this->get_param_prefix() . '_color',
				'description' => esc_html__( 'Choose background color.', 'joywp-testimonials-wpbakery-addons' ),
				'value'       => '#cccccc00',
				'dependency'  => [
					'element' => $this->get_param_prefix() . '_type',
					'value'   => 'color',
				],
			],
		];
	}
}
