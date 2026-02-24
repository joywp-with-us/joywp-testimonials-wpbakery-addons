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
				'param_name' => $this->collection->get_param_prefix() . 'type',
				'value'      => [
					__( 'Color', 'joywp-testimonials-wpbakery-addons' )    => 'color',
					__( 'Gradient', 'joywp-testimonials-wpbakery-addons' ) => 'gradient',
					__( 'Image', 'joywp-testimonials-wpbakery-addons' ) => 'image',
				],
			],
			[
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'From', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'       => $this->collection->get_param_prefix() . 'from_gradient_color',
				'description'      => esc_html__( 'Choose the starting color of the gradient.', 'joywp-testimonials-wpbakery-addons' ),
				'value'            => '#cccccc00',
				'dependency'       => [
					'element' => $this->collection->get_param_prefix() . 'type',
					'value'   => 'gradient',
				],
				'edit_field_class' => 'vc_col-sm-6',
			],
			[
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'To', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'       => $this->collection->get_param_prefix() . 'to_gradient_color',
				'description'      => esc_html__( 'Choose the ending color of the gradient.', 'joywp-testimonials-wpbakery-addons' ),
				'value'            => '#cccccc00',
				'dependency'       => [
					'element' => $this->collection->get_param_prefix() . 'type',
					'value'   => 'gradient',
				],
				'edit_field_class' => 'vc_col-sm-6',
			],
			[
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Background Color', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'  => $this->collection->get_param_prefix() . '_color',
				'description' => esc_html__( 'Choose background color.', 'joywp-testimonials-wpbakery-addons' ),
				'value'       => '#cccccc00',
				'dependency'  => [
					'element' => $this->collection->get_param_prefix() . 'type',
					'value'   => 'color',
				],
			],
			[
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Image source', 'js_composer' ),
				'param_name'  => $this->collection->get_param_prefix() . 'image_source',
				'value'       => [
					esc_html__( 'Media library', 'js_composer' ) => 'media_library',
					esc_html__( 'External link', 'js_composer' ) => 'external_link',
				],
				'std'         => 'media_library',
				'description' => esc_html__( 'Select image source.', 'js_composer' ),
				'dependency'  => [
					'element' => $this->collection->get_param_prefix() . 'type',
					'value'   => 'image',
				],
			],
			[
				'type'        => 'attach_image',
				'heading'     => esc_html__( 'Image', 'js_composer' ),
				'param_name'  => $this->collection->get_param_prefix() . 'image',
				'value'       => '',
				'description' => esc_html__( 'Select image from media library.', 'js_composer' ),
				'dependency'  => [
					'element' => $this->collection->get_param_prefix() . 'image_source',
					'value'   => 'media_library',
				],
			],
			[
				'type'        => 'textfield',
				'heading'     => esc_html__( 'External link', 'js_composer' ),
				'param_name'  => $this->collection->get_param_prefix() . 'custom_src',
				'description' => esc_html__( 'Select external link.', 'js_composer' ),
				'dependency'  => [
					'element' => $this->collection->get_param_prefix() . 'image_source',
					'value'   => 'external_link',
				],
			],
		];
	}
}
