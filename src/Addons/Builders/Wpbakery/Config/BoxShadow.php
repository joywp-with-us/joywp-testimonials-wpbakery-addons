<?php
/**
 * This class helps add border box-shadow to our addons.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Config;

defined( 'ABSPATH' ) || exit;

/**
 * Class Border
 *
 * @since 1.0
 */
class BoxShadow {

	/**
	 * Config prefix.
	 */
	protected string $prefix = '';

	/**
	 * Set config prefix.
	 *
	 * @since 1.0
	 */
	public function set_prefix( string $prefix ): Border {
		$this->prefix = $prefix . '_';
		return $this;
	}

	/**
	 * Get integration config.
	 *
	 * @since 1.0
	 */
	public function get_config(): array {
		return [
			[
				'type'                 => 'joywp_switcher',
				'wcp_group'            => true,
				'wcp_group_color'      => '#6b7280',
				'param_name'           => $this->prefix . 'add_box_shadow',
				'wcp_group_margin_top' => '20',
				'heading'              => esc_html__( 'Add Shadow', 'joywp-testimonials-wpbakery-addons' ),
				'description'          => esc_html__( 'Set box shadow configurations.', 'joywp-testimonials-wpbakery-addons' ),
				'options'              => [
					'true' => [
						'label' => '',
						'on'    => __( 'Yes', 'joywp-testimonials-wpbakery-addons' ),
						'off'   => __( 'No', 'joywp-testimonials-wpbakery-addons' ),
					],
				],
				'value'                => '',
			],
			[
				'type'            => 'joywp_number_slider',
				'wcp_group'       => true,
				'wcp_group_color' => '#6b7280',
				'value'           => '0',
				'min'             => '0',
				'max'             => '100',
				'step'            => '1',
				'heading'         => esc_html__( 'Horizontal Size', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'      => $this->prefix . 'box_shadow_horizontal',
				'title'           => esc_html__( 'px', 'joywp-testimonials-wpbakery-addons' ),
				'description'     => esc_html__( 'Set custom horizontal size for box shadow.', 'joywp-testimonials-wpbakery-addons' ),
				'dependency'      => [
					'element' => $this->prefix . 'add_box_shadow',
					'value'   => 'true',
				],
			],
			[
				'type'            => 'joywp_number_slider',
				'wcp_group'       => true,
				'wcp_group_color' => '#6b7280',
				'value'           => '0',
				'min'             => '0',
				'max'             => '100',
				'step'            => '1',
				'heading'         => esc_html__( 'Vertical Size', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'      => $this->prefix . 'box_shadow_vertical',
				'title'           => esc_html__( 'px', 'joywp-testimonials-wpbakery-addons' ),
				'description'     => esc_html__( 'Set custom vertical size for box shadow.', 'joywp-testimonials-wpbakery-addons' ),
				'dependency'      => [
					'element' => $this->prefix . 'add_box_shadow',
					'value'   => 'true',
				],
			],
			[
				'type'            => 'joywp_number_slider',
				'wcp_group'       => true,
				'wcp_group_color' => '#6b7280',
				'value'           => '0',
				'min'             => '0',
				'max'             => '100',
				'step'            => '1',
				'heading'         => esc_html__( 'Blur Effect', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'      => $this->prefix . 'box_shadow_blur',
				'title'           => esc_html__( 'px', 'joywp-testimonials-wpbakery-addons' ),
				'description'     => esc_html__( 'Set custom blur effect for box shadow.', 'joywp-testimonials-wpbakery-addons' ),
				'dependency'      => [
					'element' => $this->prefix . 'add_box_shadow',
					'value'   => 'true',
				],
			],
			[
				'type'            => 'joywp_number_slider',
				'wcp_group'       => true,
				'wcp_group_color' => '#6b7280',
				'value'           => '0',
				'min'             => '0',
				'max'             => '100',
				'step'            => '1',
				'heading'         => esc_html__( 'Spread Radius', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'      => $this->prefix . 'box_shadow_spread',
				'title'           => esc_html__( 'px', 'joywp-testimonials-wpbakery-addons' ),
				'description'     => esc_html__( 'Set custom spread radius for box shadow.', 'joywp-testimonials-wpbakery-addons' ),
				'dependency'      => [
					'element' => $this->prefix . 'add_box_shadow',
					'value'   => 'true',
				],
			],
			[
				'type'            => 'colorpicker',
				'wcp_group'       => true,
				'wcp_group_color' => '#6b7280',
				'heading'         => esc_html__( 'Color', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'      => $this->prefix . 'box_shadow_color',
				'description'     => esc_html__( 'Select custom color for box shadow.', 'joywp-testimonials-wpbakery-addons' ),
				'dependency'      => [
					'element' => $this->prefix . 'add_box_shadow',
					'value'   => 'true',
				],
			],
		];
	}
}
