<?php
/**
 * Params for joywp_testimonial_profile_card_slider_wrapper testimonial param group.
 *
 * @var ConfigManager $config
 * @since 1.0
 */

use JoywpTestimonialsWpb\Addons\ConfigManager;

defined( 'ABSPATH' ) || exit;

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
			'type'        => 'joywp_number_slider',
			'heading'     => esc_html__( 'Min Height', 'joywp-testimonials-wpbakery-addons' ),
			'param_name'  => 'min_height',
			'description' => esc_html__( 'Enter the minimum height of the testimonial card.', 'joywp-testimonials-wpbakery-addons' ),
			'title'       => 'px',
			'value'       => '270',
			'min'         => '0',
			'max'         => '5000',
			'step'        => '1',
		],
	],
	$config
		->get_collection( 'border', 'testimonial' )
		->set_gap( 20 )
		->set_switcher()
		->set_color()
		->get_params(),
	$config
		->get_collection( 'background', 'testimonial' )
		->set_gap( 20 )
		->set_switcher()
		->set_color()
		->get_params(),
	$config
		->get_collection( 'box-shadow', 'testimonial' )
		->set_gap( 20 )
		->set_switcher()
		->set_color()
		->get_params(),
	$config
		->get_collection( 'box-shadow', 'testimonial' )
		->set_gap( 20 )
		->set_switcher()
		->set_color()
		->get_params(),
);
