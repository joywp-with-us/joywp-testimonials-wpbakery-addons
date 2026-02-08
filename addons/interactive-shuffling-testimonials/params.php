<?php
/**
 * Params for interactive-shuffling-restimonials addon.
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
			'param_name'  => 'top_heading',
			'heading'     => esc_html__( 'Top Heading', 'joywp-testimonials-wpbakery-addons' ),
			'description' => esc_html__( 'Top heading above testimonials', 'joywp-testimonials-wpbakery-addons' ),
			'scope'       => [
				'use_menubar' => 'false',
				'use_media'   => 'false',
			],
		],
		[
			'type'       => 'param_group',
			'group'      => esc_html__( 'Testimonials', 'chargewp-timeline-addons-for-wpbakery' ),
			'heading'    => esc_html__( 'Testimonials Items', 'chargewp-timeline-addons-for-wpbakery' ),
			'param_name' => 'items',
			'params'     => array_merge(
				[
					[
						'type'        => 'dropdown',
						'param_name'  => 'size',
						'heading'     => esc_html__( 'Size', 'joywp-testimonials-wpbakery-addons' ),
						'description' => esc_html__( 'Card size', 'joywp-testimonials-wpbakery-addons' ),
						'value'       => [
							esc_html__( 'Small', 'joywp-testimonials-wpbakery-addons' ) => 'small',
							esc_html__( 'Medium', 'joywp-testimonials-wpbakery-addons' ) => 'medium',
							esc_html__( 'Large', 'joywp-testimonials-wpbakery-addons' ) => 'large',
						],
					],
					[
						'type'        => 'textfield',
						'param_name'  => 'title',
						'heading'     => esc_html__( 'Title', 'joywp-testimonials-wpbakery-addons' ),
						'description' => esc_html__( 'Title of testimonial, here you can put the job title of the person', 'joywp-testimonials-wpbakery-addons' ),
					],
					[
						'type'        => 'joywp_wysiwyg',
						'param_name'  => 'testimonial',
						'heading'     => esc_html__( 'Testimonial', 'joywp-testimonials-wpbakery-addons' ),
						'description' => esc_html__( 'Testimonial content', 'joywp-testimonials-wpbakery-addons' ),
						'scope'       => [
							'use_menubar' => 'false',
							'use_media'   => 'false',
						],
					],
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
				get_params_collection( 'image' )->
				set_exclude( [ 'caption', 'add_caption', 'img_link_large', 'style', 'border_color', 'alignment', 'onclick', 'link', 'img_link_target' ] )->
				set_dependency(
					[
						'element' => 'add_image',
						'value'   => 'true',
					]
				)->
				get_params(),
				[
					[
						'type'       => 'colorpicker',
						'param_name' => 'quot_color',
						'heading'    => esc_html__( 'Color of quotation marks', 'joywp-testimonials-wpbakery-addons' ),
					],
				],
			),
		],
	],
);
