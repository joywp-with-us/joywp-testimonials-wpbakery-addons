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
			'type'        => 'joywp_switcher',
			'param_name'  => 'is_animated',
			'heading'     => esc_html__( 'Animation', 'joywp-testimonials-wpbakery-addons' ),
			'description' => esc_html__( 'Enable animation for testimonial module.', 'joywp-testimonials-wpbakery-addons' ),
			'options'     => [
				'true' => [
					'on'  => __( 'Yes', 'joywp-testimonials-wpbakery-addons' ),
					'off' => __( 'No', 'joywp-testimonials-wpbakery-addons' ),
				],
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
						'admin_label' => true,
						'description' => esc_html__( 'Title of testimonial, here you can put the name of the person', 'joywp-testimonials-wpbakery-addons' ),
					],
					[
						'type'        => 'textfield',
						'param_name'  => 'subtitle',
						'heading'     => esc_html__( 'Subtitle', 'joywp-testimonials-wpbakery-addons' ),
						'description' => esc_html__( 'Sub title of testimonial, here you can put the job title of the person', 'joywp-testimonials-wpbakery-addons' ),
					],
					[
						'type'        => 'textarea',
						'param_name'  => 'testimonial',
						'heading'     => esc_html__( 'Testimonial', 'joywp-testimonials-wpbakery-addons' ),
						'description' => esc_html__( 'Testimonial content', 'joywp-testimonials-wpbakery-addons' ),
					],
					[
						'type'                 => 'joywp_switcher',
						'param_name'           => 'add_quot',
						'heading'              => esc_html__( 'Add Quot', 'joywp-testimonials-wpbakery-addons' ),
						'description'          => esc_html__( 'Add quotation mark to the testimonial card.', 'joywp-testimonials-wpbakery-addons' ),
						'options'              => [
							'true' => [
								'label' => '',
								'on'    => __( 'Yes', 'joywp-testimonials-wpbakery-addons' ),
								'off'   => __( 'No', 'joywp-testimonials-wpbakery-addons' ),
							],
						],
						'wcp_group'            => true,
						'wcp_group_color'      => '#006400',
						'wcp_group_margin_top' => '20',
					],
					[
						'type'            => 'colorpicker',
						'param_name'      => 'quot_color',
						'heading'         => esc_html__( 'Color of quotation marks', 'joywp-testimonials-wpbakery-addons' ),
						'value'           => '#CCCCCC00',
						'dependency'      => [
							'element' => 'add_quot',
							'value'   => 'true',
						],
						'wcp_group'       => true,
						'wcp_group_color' => '#006400',
					],
					[
						'type'                 => 'joywp_switcher',
						'param_name'           => 'add_top_accent',
						'heading'              => esc_html__( 'Add Top Accent', 'joywp-testimonials-wpbakery-addons' ),
						'description'          => esc_html__( 'Add top accent to the testimonial card.', 'joywp-testimonials-wpbakery-addons' ),
						'options'              => [
							'true' => [
								'label' => '',
								'on'    => __( 'Yes', 'joywp-testimonials-wpbakery-addons' ),
								'off'   => __( 'No', 'joywp-testimonials-wpbakery-addons' ),
							],
						],
						'wcp_group'            => true,
						'wcp_group_color'      => '#B8860B',
						'wcp_group_margin_top' => '20',
					],
				],
				$config->
				get_collection( 'background' )->
				set_dependency(
					[
						'element' => 'add_top_accent',
						'value'   => 'true',
					]
				)->
				set_additional_params(
					[
						'wcp_group'       => true,
						'wcp_group_color' => '#B8860B',
					]
				)->
				get_params(),
				[
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
						'wcp_group_margin_top' => '20',
						'wcp_group'            => true,
						'wcp_group_color'      => '#8B0000',
					],
				],
				$config->
				get_collection( 'image' )->
				set_include_only( [ 'source', 'image', 'custom_src' ] )->
				set_dependency(
					[
						'element' => 'add_image',
						'value'   => 'true',
					]
				)->
				set_additional_params(
					[
						'wcp_group'       => true,
						'wcp_group_color' => '#8B0000',
					]
				)->
				get_params(),
				$config->
				get_collection( 'border' )->
				set_dependency(
					[
						'element' => 'add_image',
						'value'   => 'true',
					]
				)->
				set_exclude( [ 'border_radius' ] )->
				get_params(),
			),
		],
	],
);
