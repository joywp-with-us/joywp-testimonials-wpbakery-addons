<?php
/**
 * Params for interactive-shuffling-testimonials addon.
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
			'type'                 => 'dropdown',
			'heading'              => esc_html__( 'Shuffle Button', 'joywp-testimonials-wpbakery-addons' ),
			'param_name'           => 'select_button',
			'wcp_group_margin_top' => '20',
			'value'                => [
				esc_html__( 'None', 'joywp-testimonials-wpbakery-addons' ) => 'none',
				esc_html__( 'Fancy', 'joywp-testimonials-wpbakery-addons' ) => 'fancy',
				esc_html__( 'Builder', 'joywp-testimonials-wpbakery-addons' ) => 'builder',
			],
			'wcp_group'            => true,
			'wcp_group_color'      => '#B8860B',
		],
		[
			'type'            => 'textfield',
			'heading'         => esc_html__( 'Text', 'joywp-testimonials-wpbakery-addons' ),
			'param_name'      => 'button_text',
			'wcp_group'       => true,
			'wcp_group_color' => '#B8860B',
			'dependency'      => [
				'element' => 'select_button',
				'value'   => 'fancy',
			],
		],
		[
			'type'            => 'joywp_switcher',
			'param_name'      => 'is_button_animated',
			'heading'         => esc_html__( 'Click Burst', 'joywp-testimonials-wpbakery-addons' ),
			'description'     => esc_html__( 'Enable burst animation for button click.', 'joywp-testimonials-wpbakery-addons' ),
			'options'         => [
				'true' => [
					'on'  => __( 'Yes', 'joywp-testimonials-wpbakery-addons' ),
					'off' => __( 'No', 'joywp-testimonials-wpbakery-addons' ),
				],
			],
			'dependency'      => [
				'element' => 'select_button',
				'value'   => [
					'fancy',
					'builder',
				],
			],
			'wcp_group'       => true,
			'wcp_group_color' => '#B8860B',
		],
	],
	$config
		->get_collection( 'button', 'shuffle' )
		->set_dependency(
			[
				'element' => 'select_button',
				'value'   => 'builder',
			]
		)
		->set_additional_params(
			[
				'wcp_group'       => true,
				'wcp_group_color' => '#B8860B',
			]
		)
		->set_exclude(
			[
				'shuffle_button_button_block',
				'shuffle_button_custom_onclick',
				'shuffle_button_custom_onclick_code',
				'shuffle_button_link',
			]
		)
		->get_params(),
	[
		[
			'type'       => 'param_group',
			'group'      => esc_html__( 'Testimonials', 'chargewp-timeline-addons-for-wpbakery' ),
			'heading'    => esc_html__( 'Testimonials Items', 'chargewp-timeline-addons-for-wpbakery' ),
			'param_name' => 'items',
			'params'     => $config->get_additional_params( 'group.php' ),
		],
	],
);
