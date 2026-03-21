<?php
/**
 * Params for joywp_sticker_testimonial addon.
 *
 * @var ConfigManager $config
 * @since 1.0
 */

use JoywpTestimonialsWpb\Addons\ConfigManager;

defined( 'ABSPATH' ) || exit;

$params = array_merge(
	[
		[
			'type'        => 'joywp_wysiwyg',
			'param_name'  => 'testimonial',
			'heading'     => esc_html__( 'Testimonial', 'joywp-testimonials-wpbakery-addons' ),
			'description' => esc_html__( 'Add the testimonial content.', 'joywp-testimonials-wpbakery-addons' ),
			'scope'       => [
				'use_menubar' => 'false',
				'use_media'   => 'false',
			],
		],
		[
			'type'        => 'joywp_wysiwyg',
			'param_name'  => 'source',
			'heading'     => esc_html__( 'Testimonial Source', 'joywp-testimonials-wpbakery-addons' ),
			'description' => esc_html__( 'Add the testimonial source.', 'joywp-testimonials-wpbakery-addons' ),
			'scope'       => [
				'use_menubar' => 'false',
				'use_media'   => 'false',
			],
		],
		[
			'type'        => 'joywp_switcher',
			'param_name'  => 'add_quotes',
			'heading'     => esc_html__( 'Add Quotes', 'joywp-testimonials-wpbakery-addons' ),
			'description' => esc_html__( 'Add quotes before and after testimonial text.', 'joywp-testimonials-wpbakery-addons' ),
			'options'     => [
				'true' => [
					'label' => '',
					'on'    => __( 'Yes', 'joywp-testimonials-wpbakery-addons' ),
					'off'   => __( 'No', 'joywp-testimonials-wpbakery-addons' ),
				],
			],
			'group'       => esc_html__( 'Quotes', 'joywp-testimonials-wpbakery-addons' ),
		],
		[
			'type'        => 'joywp_number',
			'heading'     => esc_html__( 'Size', 'joywp-testimonials-wpbakery-addons' ),
			'param_name'  => 'quotes_size',
			'description' => esc_html__( 'Enter size for quotes.', 'joywp-testimonials-wpbakery-addons' ),
			'title'       => esc_html__( 'px', 'joywp-testimonials-wpbakery-addons' ),
			'value'       => '40',
			'min'         => '10',
			'max'         => '100',
			'step'        => '1',
			'group'       => esc_html__( 'Quotes', 'joywp-testimonials-wpbakery-addons' ),
			'dependency'  => [
				'element' => 'add_quotes',
				'value'   => 'true',
			],
		],
		[
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Color', 'joywp-testimonials-wpbakery-addons' ),
			'param_name'  => 'quotes_color',
			'description' => esc_html__( 'Select color for quotes.', 'joywp-testimonials-wpbakery-addons' ),
			'group'       => esc_html__( 'Quotes', 'joywp-testimonials-wpbakery-addons' ),
			'dependency'  => [
				'element' => 'add_quotes',
				'value'   => 'true',
			],
		],
	],
	$config
		->get_collection( 'font-family', 'quotes' )
		->set_additional_params( [ 'group' => __( 'Quotes', 'joywp-testimonials-wpbakery-addons' ) ] )
		->set_dependency(
			[
				'element' => 'add_quotes',
				'value'   => 'true',
			]
		)
		->get_params(),
	$config
		->get_collection( 'background', 'quotes' )
		->set_additional_params( [ 'group' => __( 'Quotes', 'joywp-testimonials-wpbakery-addons' ) ] )
		->set_switcher()
		->set_color()
		->set_dependency(
			[
				'element' => 'add_quotes',
				'value'   => 'true',
			]
		)
		->get_params(),
	[
		[
			'type'            => 'joywp_number',
			'heading'         => esc_html__( 'Size', 'joywp-testimonials-wpbakery-addons' ),
			'param_name'      => 'quote_background_size',
			'description'     => esc_html__( 'Enter size for quotes background.', 'joywp-testimonials-wpbakery-addons' ),
			'title'           => esc_html__( 'px', 'joywp-testimonials-wpbakery-addons' ),
			'value'           => '40',
			'min'             => '1',
			'max'             => '100',
			'step'            => '1',
			'group'           => esc_html__( 'Quotes', 'joywp-testimonials-wpbakery-addons' ),
			'dependency'      => [
				'element' => 'quotes_add_background',
				'value'   => 'true',
			],
			'wcp_group'       => true,
			'wcp_group_color' => '#d8ccff',
		],
		[
			'type'            => 'joywp_number',
			'heading'         => esc_html__( 'Vertical Align', 'joywp-testimonials-wpbakery-addons' ),
			'param_name'      => 'quotes_line_height',
			'description'     => esc_html__( 'Vertical align content inside block quotes', 'joywp-testimonials-wpbakery-addons' ),
			'min'             => '0.1',
			'max'             => '10',
			'step'            => '0.1',
			'group'           => esc_html__( 'Quotes', 'joywp-testimonials-wpbakery-addons' ),
			'dependency'      => [
				'element' => 'quotes_add_background',
				'value'   => 'true',
			],
			'wcp_group'       => true,
			'wcp_group_color' => '#d8ccff',
		],
		[
			'type'        => 'joywp_switcher',
			'param_name'  => 'add_clip',
			'heading'     => esc_html__( 'Add Clip', 'joywp-testimonials-wpbakery-addons' ),
			'description' => esc_html__( 'Add image clip.', 'joywp-testimonials-wpbakery-addons' ),
			'options'     => [
				'true' => [
					'label' => '',
					'on'    => __( 'Yes', 'joywp-testimonials-wpbakery-addons' ),
					'off'   => __( 'No', 'joywp-testimonials-wpbakery-addons' ),
				],
			],
			'group'       => esc_html__( 'Clip', 'joywp-testimonials-wpbakery-addons' ),
		],
		[
			'type'             => 'joywp_number',
			'heading'          => esc_html__( 'X Positions', 'joywp-testimonials-wpbakery-addons' ),
			'param_name'       => 'clip_right',
			'description'      => esc_html__( 'Enter horizontal position for image clip.', 'joywp-testimonials-wpbakery-addons' ),
			'value'            => '30',
			'min'              => '-100',
			'max'              => '100',
			'step'             => '1',
			'group'            => esc_html__( 'Clip', 'joywp-testimonials-wpbakery-addons' ),
			'dependency'       => [
				'element' => 'add_clip',
				'value'   => 'true',
			],
			'edit_field_class' => 'vc_col-sm-6',
		],
		[
			'type'             => 'joywp_number',
			'heading'          => esc_html__( 'Y Positions', 'joywp-testimonials-wpbakery-addons' ),
			'param_name'       => 'clip_top',
			'description'      => esc_html__( 'Enter vertical position for image clip.', 'joywp-testimonials-wpbakery-addons' ),
			'value'            => '-15',
			'min'              => '-100',
			'max'              => '100',
			'step'             => '1',
			'group'            => esc_html__( 'Clip', 'joywp-testimonials-wpbakery-addons' ),
			'dependency'       => [
				'element' => 'add_clip',
				'value'   => 'true',
			],
			'edit_field_class' => 'vc_col-sm-6',
		],
	],
	$config
		->get_collection( 'border', 'clip' )
		->set_additional_params( [ 'group' => __( 'Clip', 'joywp-testimonials-wpbakery-addons' ) ] )
		->set_color()
		->set_gap( 20 )
		->set_exclude( [ 'clip_border_radius' ] )
		->set_dependency(
			[
				'element' => 'add_clip',
				'value'   => 'true',
			]
		)
		->get_params(),
	$config
		->get_collection( 'image', 'main' )
		->set_exclude( [ 'main_image_caption', 'main_image_add_caption', 'main_image_alignment', 'main_image_onclick', 'main_image_link' ] )
		->set_additional_params( [ 'group' => __( 'Image', 'joywp-testimonials-wpbakery-addons' ) ] )
		->set_switcher()
		->get_params(),
);

return $params;
