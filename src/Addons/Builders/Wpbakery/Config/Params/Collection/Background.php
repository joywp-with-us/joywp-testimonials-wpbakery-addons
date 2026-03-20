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
	 * Get integration config.
	 *
	 * @since 1.0
	 */
	public function get_collection_params(): array {
		return [
			[
				'type'       => 'dropdown',
				'param_name' => $this->collection->get_param_slug( 'type' ),
				'value'      => [
					__( 'Color', 'joywp-testimonials-wpbakery-addons' )    => 'color',
					__( 'Gradient', 'joywp-testimonials-wpbakery-addons' ) => 'gradient',
					__( 'Image', 'joywp-testimonials-wpbakery-addons' ) => 'image',
				],
			],
			[
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'From', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'       => $this->collection->get_param_slug( 'from_gradient_color' ),
				'description'      => esc_html__( 'Choose the starting color of the gradient.', 'joywp-testimonials-wpbakery-addons' ),
				'value'            => '#cccccc00',
				'dependency'       => [
					'element' => $this->collection->get_param_slug( 'type' ),
					'value'   => 'gradient',
				],
				'edit_field_class' => 'vc_col-sm-6',
			],
			[
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'To', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'       => $this->collection->get_param_slug( 'to_gradient_color' ),
				'description'      => esc_html__( 'Choose the ending color of the gradient.', 'joywp-testimonials-wpbakery-addons' ),
				'value'            => '#cccccc00',
				'dependency'       => [
					'element' => $this->collection->get_param_slug( 'type' ),
					'value'   => 'gradient',
				],
				'edit_field_class' => 'vc_col-sm-6',
			],
			[
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Background Color', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'  => $this->collection->get_param_slug( 'color' ),
				'description' => esc_html__( 'Choose background color.', 'joywp-testimonials-wpbakery-addons' ),
				'value'       => '#cccccc00',
				'dependency'  => [
					'element' => $this->collection->get_param_slug( 'type' ),
					'value'   => 'color',
				],
			],
			[
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Image source', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'  => $this->collection->get_param_slug( 'image_source' ),
				'value'       => [
					esc_html__( 'Media library', 'joywp-testimonials-wpbakery-addons' ) => 'media_library',
					esc_html__( 'External link', 'joywp-testimonials-wpbakery-addons' ) => 'external_link',
				],
				'std'         => 'media_library',
				'description' => esc_html__( 'Select image source.', 'joywp-testimonials-wpbakery-addons' ),
				'dependency'  => [
					'element' => $this->collection->get_param_slug( 'type' ),
					'value'   => 'image',
				],
			],
			[
				'type'        => 'attach_image',
				'heading'     => esc_html__( 'Image', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'  => $this->collection->get_param_slug( 'image' ),
				'value'       => '',
				'description' => esc_html__( 'Select image from media library.', 'joywp-testimonials-wpbakery-addons' ),
				'dependency'  => [
					'element' => $this->collection->get_param_slug( 'image_source' ),
					'value'   => 'media_library',
				],
			],
			[
				'type'        => 'textfield',
				'heading'     => esc_html__( 'External link', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'  => $this->collection->get_param_slug( 'custom_src' ),
				'description' => esc_html__( 'Select external link.', 'joywp-testimonials-wpbakery-addons' ),
				'dependency'  => [
					'element' => $this->collection->get_param_slug( 'image_source' ),
					'value'   => 'external_link',
				],
			],
			[
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Image Size', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'  => $this->collection->get_param_slug( 'image_size' ),
				'description' => esc_html__( 'Select image size.', 'joywp-testimonials-wpbakery-addons' ),
				'value'       => [
					'Auto'    => 'auto',
					'Contain' => 'contain',
					'Cover'   => 'cover',
					'Custom'  => 'custom',
				],
				'dependency'  => [
					'element' => $this->collection->get_param_slug( 'type' ),
					'value'   => 'image',
				],
			],
			[
				'type'             => 'joywp_number',
				'heading'          => esc_html__( 'Image Width', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'       => $this->collection->get_param_slug( 'img_width' ),
				'edit_field_class' => 'vc_col-sm-6',
				'description'      => esc_html__( 'Enter image width in pixels.', 'joywp-testimonials-wpbakery-addons' ),
				'title'            => 'px',
				'dependency'       => [
					'element' => $this->collection->get_param_slug( 'image_size' ),
					'value'   => 'custom',
				],
			],
			[
				'type'             => 'joywp_number',
				'heading'          => esc_html__( 'Image Height', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'       => $this->collection->get_param_slug( 'img_height' ),
				'description'      => esc_html__( 'Enter image height in px.', 'joywp-testimonials-wpbakery-addons' ),
				'title'            => 'px',
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'       => [
					'element' => $this->collection->get_param_slug( 'image_size' ),
					'value'   => 'custom',
				],
			],
			[
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Image position', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'  => $this->collection->get_param_slug( 'image_position' ),
				'description' => esc_html__( 'Select image position.', 'joywp-testimonials-wpbakery-addons' ),
				'value'       => [
					''             => 'default',
					'Center'       => 'center',
					'Top'          => 'top',
					'Bottom'       => 'bottom',
					'Left'         => 'left',
					'Right'        => 'right',
					'Right Top'    => 'right top',
					'Left Top'     => 'left top',
					'Right Bottom' => 'right bottom',
					'Left Bottom'  => 'left bottom',
				],
				'dependency'  => [
					'element' => $this->collection->get_param_slug( 'type' ),
					'value'   => 'image',
				],
			],
			[
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Image repeat', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'  => $this->collection->get_param_slug( 'image_repeat' ),
				'description' => esc_html__( 'Select image repeat.', 'joywp-testimonials-wpbakery-addons' ),
				'value'       => [
					'No Repeat'         => 'no-repeat',
					'Repeat'            => 'repeat',
					'Repeat Horizontal' => 'repeat-x',
					'Repeat Vertical'   => 'repeat-y',
				],
				'dependency'  => [
					'element' => $this->collection->get_param_slug( 'type' ),
					'value'   => 'image',
				],
			],
		];
	}
}
