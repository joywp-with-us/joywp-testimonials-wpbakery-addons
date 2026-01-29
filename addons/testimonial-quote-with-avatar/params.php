<?php
/**
 * Params for testimonial-quote-with-avatar addon.
 *
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

return [
	[
		'type'        => 'joywp_wysiwyg',
		'heading'     => esc_html__( 'Testimonial', 'joywp-testimonials-wpbakery-addons' ),
		'description' => esc_html__( 'Enter testimonial text.', 'joywp-testimonials-wpbakery-addons' ),
		'param_name'  => 'testimonial',
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
	],
	[
		'type'        => 'joywp_number',
		'heading'     => esc_html__( 'Width', 'joywp-testimonials-wpbakery-addons' ),
		'param_name'  => 'width',
		'description' => esc_html__( 'Enter width for testimonial card.', 'joywp-testimonials-wpbakery-addons' ),
		'title'       => esc_html__( '%', 'joywp-testimonials-wpbakery-addons' ),
		'value'       => '100',
		'min'         => '1',
		'max'         => '100',
		'step'        => '1',
	],
];
