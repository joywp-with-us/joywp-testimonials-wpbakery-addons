<?php
/**
 * This class helps add border box-shadow to our addons.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Config\Params\Collection;

use JoywpTestimonialsWpb\Addons\AbstractParamsCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class Border
 *
 * @since 1.0
 */
class BoxShadow extends AbstractParamsCollection {
	/**
	 * Get collection slug.
	 *
	 * @since 1.0
	 */
	public function get_slug(): string {
		return 'box_shadow';
	}

	/**
	 * Get collection name.
	 *
	 * @since 1.0
	 */
	public function get_name(): string {
		return 'shadow';
	}

	/**
	 * Get collection color group.
	 *
	 * @since 1.0
	 */
	public function get_color(): string {
		return '#6b7280';
	}

	/**
	 * Get integration config.
	 *
	 * @since 1.0
	 */
	public function get_collection_params(): array {
		return [
			[
				'type'        => 'joywp_number_slider',
				'value'       => '0',
				'min'         => '0',
				'max'         => '100',
				'step'        => '1',
				'heading'     => esc_html__( 'Horizontal Size', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'  => $this->prefix . $this->get_slug() . '_horizontal',
				'title'       => esc_html__( 'px', 'joywp-testimonials-wpbakery-addons' ),
				'description' => esc_html__( 'Set custom horizontal size for box shadow.', 'joywp-testimonials-wpbakery-addons' ),
			],
			[
				'type'        => 'joywp_number_slider',
				'value'       => '0',
				'min'         => '0',
				'max'         => '100',
				'step'        => '1',
				'heading'     => esc_html__( 'Vertical Size', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'  => $this->prefix . $this->get_slug() . '_vertical',
				'title'       => esc_html__( 'px', 'joywp-testimonials-wpbakery-addons' ),
				'description' => esc_html__( 'Set custom vertical size for box shadow.', 'joywp-testimonials-wpbakery-addons' ),
			],
			[
				'type'        => 'joywp_number_slider',
				'value'       => '0',
				'min'         => '0',
				'max'         => '100',
				'step'        => '1',
				'heading'     => esc_html__( 'Blur Effect', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'  => $this->prefix . $this->get_slug() . '_blur',
				'title'       => esc_html__( 'px', 'joywp-testimonials-wpbakery-addons' ),
				'description' => esc_html__( 'Set custom blur effect for box shadow.', 'joywp-testimonials-wpbakery-addons' ),
			],
			[
				'type'        => 'joywp_number_slider',
				'value'       => '0',
				'min'         => '0',
				'max'         => '100',
				'step'        => '1',
				'heading'     => esc_html__( 'Spread Radius', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'  => $this->prefix . $this->get_slug() . '_spread',
				'title'       => esc_html__( 'px', 'joywp-testimonials-wpbakery-addons' ),
				'description' => esc_html__( 'Set custom spread radius for box shadow.', 'joywp-testimonials-wpbakery-addons' ),
			],
			[
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Color', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'  => $this->prefix . $this->get_slug() . '_color',
				'description' => esc_html__( 'Select custom color for box shadow.', 'joywp-testimonials-wpbakery-addons' ),
			],
		];
	}
}
