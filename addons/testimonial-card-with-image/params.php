<?php
/**
 * Params for testimonial-card-with-image addon.
 *
 * @since 1.0
 */

return [
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
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Name', 'joywp-testimonials-wpbakery-addons' ),
		'description' => esc_html__( 'Enter testimonial author name.', 'joywp-testimonials-wpbakery-addons' ),
		'param_name'  => 'name',
		'value'       => '',
	],
	[
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Surname', 'joywp-testimonials-wpbakery-addons' ),
		'description' => esc_html__( 'Enter testimonial author surname.', 'joywp-testimonials-wpbakery-addons' ),
		'param_name'  => 'surname',
		'value'       => '',
	],
];
