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
	],
	[]
);
