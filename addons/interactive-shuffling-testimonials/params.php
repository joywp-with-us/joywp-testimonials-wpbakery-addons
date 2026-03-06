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
	],
	$config
		->get_collection( 'button', 'shuffle' )
		->set_exclude(
			[
				'shuffle_button_button_block',
				'shuffle_button_custom_onclick',
				'shuffle_button_custom_onclick_code',
				'shuffle_button_link',
			]
		)
		->set_switcher()
		->set_gap( 20 )
		->set_color()
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
