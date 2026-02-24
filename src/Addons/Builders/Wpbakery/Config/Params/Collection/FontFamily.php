<?php
/**
 * This class helps add font-family configurations to our addons.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Config\Params\Collection;

use JoywpTestimonialsWpb\Addons\AbstractParamsCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class Font
 *
 * @since 1.0
 */
class FontFamily extends AbstractParamsCollection {
	/**
	 * Get collection color group.
	 *
	 * @since 1.0
	 */
	public function get_color(): string {
		return '#8B0000';
	}

	/**
	 * Get integration config.
	 *
	 * @since 1.0
	 */
	public function get_collection_params(): array {
		return [
			[
				'type'        => 'dropdown',
				'param_name'  => $this->collection->get_param_prefix(),
				'value'       => [
					'Arial'           => 'Arial, Helvetica, sans-serif',
					'Helvetica'       => 'Helvetica, Arial, sans-serif',
					'Verdana'         => 'Verdana, Geneva, sans-serif',
					'Tahoma'          => 'Tahoma, Geneva, sans-serif',
					'Trebuchet MS'    => '"Trebuchet MS", Helvetica, sans-serif',
					'Times New Roman' => '"Times New Roman", Times, serif',
					'Georgia'         => 'Georgia, serif',
					'Courier New'     => '"Courier New", Courier, monospace',
					'System UI'       => 'system-ui, sans-serif',
				],
				'heading'     => esc_html__( 'Font Family', 'joywp-testimonials-wpbakery-addons' ),
				'description' => esc_html__( 'Select font family.', 'joywp-testimonials-wpbakery-addons' ),
			],
		];
	}
}
