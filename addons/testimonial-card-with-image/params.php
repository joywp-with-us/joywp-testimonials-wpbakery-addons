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
		'type'                 => 'joywp_switcher',
		'param_name'           => 'add_quotes',
		'heading'              => esc_html__( 'Add Quotes', 'joywp-testimonials-wpbakery-addons' ),
		'description'          => esc_html__( 'Add quotes before and after testimonial text.', 'joywp-testimonials-wpbakery-addons' ),
		'options'              => [
			'true' => [
				'label' => '',
				'on'    => __( 'Yes', 'joywp-testimonials-wpbakery-addons' ),
				'off'   => __( 'No', 'joywp-testimonials-wpbakery-addons' ),
			],
		],
		'value'                => '',
		'wcp_group'            => true,
		'wcp_group_color'      => '#006400',
		'wcp_group_margin_top' => '20',
	],
	[
		'type'            => 'joywp_number',
		'heading'         => esc_html__( 'Size', 'joywp-testimonials-wpbakery-addons' ),
		'param_name'      => 'quotes_size',
		'description'     => esc_html__( 'Enter size for quotes icons (in px).', 'joywp-testimonials-wpbakery-addons' ),
		'title'           => esc_html__( 'px', 'joywp-testimonials-wpbakery-addons' ),
		'value'           => '50',
		'min'             => '10',
		'max'             => '100',
		'step'            => '1',
		'wcp_group'       => true,
		'wcp_group_color' => '#006400',
		'dependency'      => [
			'element' => 'add_quotes',
			'value'   => 'true',
		],
	],
	[
		'type'                 => 'joywp_switcher',
		'param_name'           => 'add_image',
		'heading'              => esc_html__( 'Add Image', 'joywp-testimonials-wpbakery-addons' ),
		'description'          => esc_html__( 'Add image to the testimonial card.', 'joywp-testimonials-wpbakery-addons' ),
		'options'              => [
			'true' => [
				'label' => '',
				'on'    => __( 'Yes', 'joywp-testimonials-wpbakery-addons' ),
				'off'   => __( 'No', 'joywp-testimonials-wpbakery-addons' ),
			],
		],
		'value'                => '',
		'wcp_group'            => true,
		'wcp_group_color'      => '#ff757c',
		'wcp_group_margin_top' => '20',
	],
	[
		'type'                 => 'joywp_switcher',
		'param_name'           => 'add_name',
		'heading'              => esc_html__( 'Add Name', 'joywp-testimonials-wpbakery-addons' ),
		'description'          => esc_html__( 'Add block with name and surname.', 'joywp-testimonials-wpbakery-addons' ),
		'options'              => [
			'true' => [
				'label' => '',
				'on'    => __( 'Yes', 'joywp-testimonials-wpbakery-addons' ),
				'off'   => __( 'No', 'joywp-testimonials-wpbakery-addons' ),
			],
		],
		'value'                => '',
		'wcp_group'            => true,
		'wcp_group_color'      => '#B8860B',
		'wcp_group_margin_top' => '20',
	],
	[
		'type'            => 'joywp_wysiwyg',
		'heading'         => esc_html__( 'Name', 'joywp-testimonials-wpbakery-addons' ),
		'description'     => esc_html__( 'Enter testimonial author name.', 'joywp-testimonials-wpbakery-addons' ),
		'param_name'      => 'name',
		'value'           => '',
		'wcp_group'       => true,
		'wcp_group_color' => '#B8860B',
		'scope'           => [
			'use_menubar' => 'false',
			'use_media'   => 'false',
		],
		'dependency'      => [
			'element' => 'add_name',
			'value'   => 'true',
		],
	],
	[
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Background', 'chargewp-timeline-addons-for-wpbakery' ),
		'param_name'      => 'name_block_background',
		'description'     => esc_html__( 'Select background color for name block.', 'chargewp-timeline-addons-for-wpbakery' ),
		'value'           => '#ffffff',
		'wcp_group'       => true,
		'wcp_group_color' => '#B8860B',
		'dependency'      => [
			'element' => 'add_name',
			'value'   => 'true',
		],
	],
];
