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
	]
);
