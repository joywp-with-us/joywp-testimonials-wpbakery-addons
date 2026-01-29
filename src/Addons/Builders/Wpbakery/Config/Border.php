<?php
/**
 * This class helps add border configurations to our addons.
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
class Border {

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
				'wcp_group_color'      => '#1c1e21',
				'param_name'           => $this->prefix . 'add_border',
				'wcp_group_margin_top' => '20',
				'heading'              => esc_html__( 'Add Border', 'joywp-testimonials-wpbakery-addons' ),
				'description'          => esc_html__( 'Set border configurations.', 'joywp-testimonials-wpbakery-addons' ),
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
				'type'            => 'dropdown',
				'param_name'      => $this->prefix . 'border_style',
				'wcp_group'       => true,
				'wcp_group_color' => '#1f2937',
				'value'           => [
					esc_html__( 'Solid', 'joywp-testimonials-wpbakery-addons' )  => 'solid',
					esc_html__( 'Dashed', 'joywp-testimonials-wpbakery-addons' ) => 'dashed',
					esc_html__( 'Dotted', 'joywp-testimonials-wpbakery-addons' ) => 'dotted',
					esc_html__( 'Double', 'joywp-testimonials-wpbakery-addons' ) => 'double',
					esc_html__( 'Groove', 'joywp-testimonials-wpbakery-addons' ) => 'groove',
					esc_html__( 'Ridge', 'joywp-testimonials-wpbakery-addons' )  => 'ridge',
					esc_html__( 'Inset', 'joywp-testimonials-wpbakery-addons' )  => 'inset',
					esc_html__( 'Outset', 'joywp-testimonials-wpbakery-addons' ) => 'outset',
				],
				'heading'         => esc_html__( 'Border Style', 'joywp-testimonials-wpbakery-addons' ),
				'description'     => esc_html__( 'Choose border style.', 'joywp-testimonials-wpbakery-addons' ),
				'dependency'      => [
					'element' => $this->prefix . 'add_border',
					'value'   => 'true',
				],
			],
			[
				'type'            => 'joywp_number_slider',
				'wcp_group'       => true,
				'wcp_group_color' => '#1f2937',
				'value'           => '1',
				'min'             => '0',
				'max'             => '100',
				'step'            => '1',
				'heading'         => esc_html__( 'Border Width', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'      => $this->prefix . 'border_width',
				'title'           => esc_html__( 'px', 'joywp-testimonials-wpbakery-addons' ),
				'description'     => esc_html__( 'Set custom border width in px from 0 to 10.', 'joywp-testimonials-wpbakery-addons' ),
				'dependency'      => [
					'element' => $this->prefix . 'add_border',
					'value'   => 'true',
				],
			],
			[
				'type'            => 'colorpicker',
				'wcp_group'       => true,
				'wcp_group_color' => '#1f2937',
				'heading'         => esc_html__( 'Border color', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'      => $this->prefix . 'border_color',
				'description'     => esc_html__( 'Select custom color for border.', 'joywp-testimonials-wpbakery-addons' ),
				'dependency'      => [
					'element' => $this->prefix . 'add_border',
					'value'   => 'true',
				],
			],
			[
				'type'            => 'joywp_number_slider',
				'wcp_group'       => true,
				'wcp_group_color' => '#1f2937',
				'value'           => '0',
				'min'             => '0',
				'max'             => '100',
				'step'            => '1',
				'heading'         => esc_html__( 'Border Radius', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'      => $this->prefix . 'border_radius',
				'title'           => esc_html__( 'px', 'joywp-testimonials-wpbakery-addons' ),
				'description'     => esc_html__( 'Set custom border radius in px from 0 to 100.', 'joywp-testimonials-wpbakery-addons' ),
				'dependency'      => [
					'element' => $this->prefix . 'add_border',
					'value'   => 'true',
				],
			],
		];
	}
}
