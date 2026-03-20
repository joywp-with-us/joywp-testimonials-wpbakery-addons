<?php
/**
 * Params for joywp_sticker_testimonial addon.
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
			'value'       => '',
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
		->get_collection( 'font-family', 'main' )
		->set_additional_params( [ 'group' => __( 'Quotes', 'joywp-testimonials-wpbakery-addons' ) ] )
		->set_dependency(
			[
				'element' => 'add_quotes',
				'value'   => 'true',
			]
		)
		->get_params(),
);
