<?php
/**
 * This class helps add font configurations to our addons.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Config\Params;

defined( 'ABSPATH' ) || exit;

/**
 * Class Font
 *
 * @since 1.0
 */
class Font extends AbstractParams {
	/**
	 * Get integration config.
	 *
	 * @since 1.0
	 */
	public function get_params(): array {
		return [
			[
				'type'        => 'dropdown',
				'param_name'  => $this->prefix . 'font_family',
				'value'       => [
					'Arial',
					'Helvetica',
					'Verdana',
					'Tahoma',
					'Trebuchet MS',
					'Times New Roman',
					'Georgia',
					'Courier New',
					'System UI',
				],
				'heading'     => esc_html__( 'Font Family', 'joywp-testimonials-wpbakery-addons' ),
				'description' => esc_html__( 'Select font family.', 'joywp-testimonials-wpbakery-addons' ),
			],
		];
	}
}
