<?php
/**
 * Params for testimonial-card-with-image addon.
 *
 * @var ConfigManager $config
 * @since 1.0
 */

use JoywpTestimonialsWpb\Addons\ConfigManager;

return array_merge(
	[
		[
			'type'        => 'joywp_wysiwyg',
			'heading'     => esc_html__( 'Testimonial', 'joywp-testimonials-wpbakery-addons' ),
			'description' => esc_html__( 'Enter testimonial text.', 'joywp-testimonials-wpbakery-addons' ),
			'param_name'  => 'testimonial',
			'value'       => '',
			'scope'       => [
				'use_menubar' => 'false',
				'use_media'   => 'false',
			],
		],
		[
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Testimonial Background', 'chargewp-timeline-addons-for-wpbakery' ),
			'param_name'  => 'testimonial_background',
			'description' => esc_html__( 'Select background color for testimonial block.', 'chargewp-timeline-addons-for-wpbakery' ),
			'value'       => '#ffffff',
		],
		[
			'type'        => 'joywp_number',
			'heading'     => esc_html__( 'Width', 'joywp-testimonials-wpbakery-addons' ),
			'param_name'  => 'width',
			'description' => esc_html__( 'Enter width for testimonial card.', 'joywp-testimonials-wpbakery-addons' ),
			'title'       => esc_html__( 'px', 'joywp-testimonials-wpbakery-addons' ),
			'value'       => '310',
			'min'         => '100',
			'max'         => '1000',
			'step'        => '1',
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
			'value'       => '',
			'group'       => esc_html__( 'Quotes', 'joywp-testimonials-wpbakery-addons' ),
		],
		[
			'type'        => 'joywp_number',
			'heading'     => esc_html__( 'Size', 'joywp-testimonials-wpbakery-addons' ),
			'param_name'  => 'quotes_size',
			'description' => esc_html__( 'Enter size for quotes.', 'joywp-testimonials-wpbakery-addons' ),
			'title'       => esc_html__( 'px', 'joywp-testimonials-wpbakery-addons' ),
			'value'       => '50',
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
			'heading'     => esc_html__( 'Color', 'chargewp-timeline-addons-for-wpbakery' ),
			'param_name'  => 'quotes_color',
			'description' => esc_html__( 'Select color for quotes.', 'chargewp-timeline-addons-for-wpbakery' ),
			'group'       => esc_html__( 'Quotes', 'joywp-testimonials-wpbakery-addons' ),
			'dependency'  => [
				'element' => 'add_quotes',
				'value'   => 'true',
			],
		],
	],
	$config
		->get_collection( 'font-family' )
		->set_additional_params( [ 'group' => __( 'Quotes', 'joywp-testimonials-wpbakery-addons' ) ] )
		->set_dependency(
			[
				'element' => 'add_quotes',
				'value'   => 'true',
			]
		)
		->get_params(),
	[
		[
			'type'        => 'joywp_switcher',
			'param_name'  => 'add_image',
			'heading'     => esc_html__( 'Add Image', 'joywp-testimonials-wpbakery-addons' ),
			'description' => esc_html__( 'Add image to the testimonial card.', 'joywp-testimonials-wpbakery-addons' ),
			'group'       => esc_html__( 'Image', 'joywp-testimonials-wpbakery-addons' ),
			'options'     => [
				'true' => [
					'label' => '',
					'on'    => __( 'Yes', 'joywp-testimonials-wpbakery-addons' ),
					'off'   => __( 'No', 'joywp-testimonials-wpbakery-addons' ),
				],
			],
			'value'       => '',
		],
	],
	$config->
	get_collection( 'image' )->
	set_exclude( [ 'caption', 'add_caption', 'img_link_large', 'style', 'border_color' ] )->
	set_additional_params( [ 'group' => __( 'Image', 'joywp-testimonials-wpbakery-addons' ) ] )->
	set_dependency(
		[
			'element' => 'add_image',
			'value'   => 'true',
		]
	)->
	get_params(),
	[
		[
			'type'        => 'joywp_switcher',
			'param_name'  => 'add_name',
			'heading'     => esc_html__( 'Add Name', 'joywp-testimonials-wpbakery-addons' ),
			'description' => esc_html__( 'Add block with name and surname.', 'joywp-testimonials-wpbakery-addons' ),
			'options'     => [
				'true' => [
					'label' => '',
					'on'    => __( 'Yes', 'joywp-testimonials-wpbakery-addons' ),
					'off'   => __( 'No', 'joywp-testimonials-wpbakery-addons' ),
				],
			],
			'value'       => '',
			'group'       => esc_html__( 'Name', 'joywp-testimonials-wpbakery-addons' ),
		],
		[
			'type'        => 'joywp_wysiwyg',
			'heading'     => esc_html__( 'Name', 'joywp-testimonials-wpbakery-addons' ),
			'description' => esc_html__( 'Enter testimonial author name.', 'joywp-testimonials-wpbakery-addons' ),
			'param_name'  => 'name',
			'value'       => '',
			'scope'       => [
				'use_menubar' => 'false',
				'use_media'   => 'false',
			],
			'dependency'  => [
				'element' => 'add_name',
				'value'   => 'true',
			],
			'group'       => esc_html__( 'Name', 'joywp-testimonials-wpbakery-addons' ),
		],
		[
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Background', 'chargewp-timeline-addons-for-wpbakery' ),
			'param_name'  => 'name_block_background',
			'description' => esc_html__( 'Select background color for name block.', 'chargewp-timeline-addons-for-wpbakery' ),
			'value'       => '#ffffff',
			'dependency'  => [
				'element' => 'add_name',
				'value'   => 'true',
			],
			'group'       => esc_html__( 'Name', 'joywp-testimonials-wpbakery-addons' ),
		],
		[
			'type'        => 'joywp_switcher',
			'param_name'  => 'add_pointer',
			'heading'     => esc_html__( 'Add Pointer', 'joywp-testimonials-wpbakery-addons' ),
			'description' => esc_html__( 'Add pointer arrow to the testimonial image from testimonial text.', 'joywp-testimonials-wpbakery-addons' ),
			'options'     => [
				'true' => [
					'label' => '',
					'on'    => __( 'Yes', 'joywp-testimonials-wpbakery-addons' ),
					'off'   => __( 'No', 'joywp-testimonials-wpbakery-addons' ),
				],
			],
			'value'       => '',
			'group'       => esc_html__( 'Pointer', 'joywp-testimonials-wpbakery-addons' ),
		],
		[
			'type'        => 'joywp_number',
			'heading'     => esc_html__( 'Size', 'joywp-testimonials-wpbakery-addons' ),
			'param_name'  => 'pointer_size',
			'description' => esc_html__( 'Enter size for pointer.', 'joywp-testimonials-wpbakery-addons' ),
			'title'       => esc_html__( 'px', 'joywp-testimonials-wpbakery-addons' ),
			'value'       => '25',
			'min'         => '1',
			'max'         => '50',
			'step'        => '1',
			'group'       => esc_html__( 'Pointer', 'joywp-testimonials-wpbakery-addons' ),
			'dependency'  => [
				'element' => 'add_pointer',
				'value'   => 'true',
			],
		],
		[
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Color', 'chargewp-timeline-addons-for-wpbakery' ),
			'param_name'  => 'pointer_color',
			'description' => esc_html__( 'Select color for pointer.', 'chargewp-timeline-addons-for-wpbakery' ),
			'value'       => '#000000',
			'group'       => esc_html__( 'Pointer', 'joywp-testimonials-wpbakery-addons' ),
			'dependency'  => [
				'element' => 'add_pointer',
				'value'   => 'true',
			],
		],
		[
			'type'        => 'joywp_number',
			'heading'     => esc_html__( 'Positioning', 'joywp-testimonials-wpbakery-addons' ),
			'param_name'  => 'pointer_position',
			'description' => esc_html__( 'Enter positioning for pointer (from left side).', 'joywp-testimonials-wpbakery-addons' ),
			'title'       => esc_html__( '%', 'joywp-testimonials-wpbakery-addons' ),
			'value'       => '25',
			'min'         => '0',
			'max'         => '100',
			'step'        => '1',
			'group'       => esc_html__( 'Pointer', 'joywp-testimonials-wpbakery-addons' ),
			'dependency'  => [
				'element' => 'add_pointer',
				'value'   => 'true',
			],
		],
	],
	$config->get_collection( 'border' )->get_params(),
	$config->get_collection( 'box-shadow' )->get_params(),
);
