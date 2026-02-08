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
        'testimonial_ids' => [
            'type' => 'joywp_wysiwyg',
            'param_name' => 'top_heading',
            'heading' => esc_html__( 'Top Heading', 'joywp-testimonials-wpbakery-addons' ),
            'description' => esc_html__( 'Top heading above testimonials', 'joywp-testimonials-wpbakery-addons' ),
            'scope'       => [
                'use_menubar' => 'false',
                'use_media'   => 'false',
            ],
        ],
    ],
);
