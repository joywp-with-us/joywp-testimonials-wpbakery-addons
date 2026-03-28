<?php
/**
 * Params for joywp_testimonial_profile_card_slider_wrapper addon.
 *
 * @var ConfigManager $config
 * @since 1.0
 */

use JoywpTestimonialsWpb\Addons\ConfigManager;

defined( 'ABSPATH' ) || exit;

return array_merge(
	[
		[
			'type'        => 'joywp_number_slider',
			'param_name'  => 'height',
			'heading'     => __( 'Min Height', 'joywp-testimonials-wpb' ),
			'description' => __( 'Enter the minimum height of whole block', 'joywp-testimonials-wpb' ),
			'value'       => 400,
			'max'         => 5000,
		],
		[
			'type'        => 'joywp_switcher',
			'param_name'  => 'is_fancy_background',
			'heading'     => esc_html__( 'Fancy Background', 'joywp-testimonials-wpbakery-addons' ),
			'description' => esc_html__( 'Enable special fancy background.', 'joywp-testimonials-wpbakery-addons' ),
			'options'     => [
				'true' => [
					'on'  => __( 'Yes', 'joywp-testimonials-wpbakery-addons' ),
					'off' => __( 'No', 'joywp-testimonials-wpbakery-addons' ),
				],
			],
		],
		[
			'type'        => 'joywp_number_slider',
			'param_name'  => 'slider_controls_width',
			'heading'     => __( 'Controls Width', 'joywp-testimonials-wpbakery-addons' ),
			'description' => __( 'Enter the width of slider controls', 'joywp-testimonials-wpbakery-addons' ),
			'value'       => 15,
			'max'         => 100,
			'group'       => __( 'Slider', 'joywp-testimonials-wpb' ),
		],
		[
			'type'        => 'joywp_number_slider',
			'param_name'  => 'slider_controls_height',
			'heading'     => __( 'Controls Height', 'joywp-testimonials-wpbakery-addons' ),
			'description' => __( 'Enter the height of slider controls', 'joywp-testimonials-wpbakery-addons' ),
			'value'       => 15,
			'max'         => 100,
			'group'       => __( 'Slider', 'joywp-testimonials-wpb' ),
		],
	],
	$config
		->get_collection( 'border', 'slider_controls' )
		->set_gap( 20 )
		->set_switcher(
			[
				'heading'     => __( 'Enable Controls Border', 'joywp-testimonials-wpbakery-addons' ),
				'description' => __( 'Activate configurations for controls border.', 'joywp-testimonials-wpbakery-addons' ),
			]
		)
		->set_color()
		->set_additional_params(
			[
				'group' => __( 'Slider', 'joywp-testimonials-wpbakery-addons' ),
			]
		)
		->get_params(),
	$config
		->get_collection( 'cursor', 'slider_controls' )
		->set_gap( 20 )
		->set_switcher(
			[
				'heading'     => __( 'Enable Controls Cursor', 'joywp-testimonials-wpbakery-addons' ),
				'description' => __( 'Activate custom cursor for controls.', 'joywp-testimonials-wpbakery-addons' ),
			]
		)
		->set_color()
		->set_additional_params(
			[
				'group' => __( 'Slider', 'joywp-testimonials-wpbakery-addons' ),
			]
		)
		->get_params(),
	$config
		->get_collection( 'background', 'slider_controls' )
		->set_gap( 20 )
		->set_switcher(
			[
				'heading'     => __( 'Enable Controls Background', 'joywp-testimonials-wpbakery-addons' ),
				'description' => __( 'Activate custom background for controls.', 'joywp-testimonials-wpbakery-addons' ),
			]
		)
		->set_color()
		->set_additional_params(
			[
				'group' => __( 'Slider', 'joywp-testimonials-wpbakery-addons' ),
			]
		)
		->get_params(),
	$config
		->get_collection( 'box-shadow', 'main' )
		->set_gap( 20 )
		->set_switcher()
		->set_color()
		->get_params(),
);
