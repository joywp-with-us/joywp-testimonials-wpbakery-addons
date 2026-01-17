<?php
/**
 * Here we connect our plugin to specific builder with wp hook system.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery;

defined( 'ABSPATH' ) || exit;

use JoywpTestimonialsWpb\AbstractBuilderBootstrapper;
use JoywpTestimonialsWpb\Addons\AbstractAddon;

/**
 * Class bootstrap builder builder.
 *
 * @since 1.0
 */
class BuilderBootstrapper extends AbstractBuilderBootstrapper {
	/**
	 * Bootstrap builder.
	 *
	 * @since 1.0
	 */
	public function bootstrap(): void {
		add_action( 'admin_init', [ $this, 'init_custom_addon_params' ] );
		add_filter( 'joywp_testimonials_get_addon_config', [ $this, 'set_icon' ], 10, 3 );
		add_filter( 'joywp_testimonials_get_addon_config', [ $this, 'set_common_params' ], 10, 2 );
		add_filter( 'joywp_testimonials_atts_render_addon', [ $this, 'set_addon_default_atts' ], 10, 2 );
		add_filter( 'joywp_testimonials_render_addon_output', [ $this, 'add_addon_output_default_wrapper' ], 10, 2 );
	}

	/**
	 * Initialize custom addon params.
	 * We initialize here 3-party library that create custom
	 * addon params that wpbakery initially missing.
	 *
	 * @since 1.0
	 */
	public function init_custom_addon_params(): void {
		add_filter(
			'wpcustomparamcollection_get_param_prefix',
			function ( $prefix_list ) {
				$prefix_list[] = 'joywp';
				return $prefix_list;
			}
		);

		if ( ! class_exists( 'Wpbackery_Custom_Param_Collection' ) ) {
			include_once JOYWPTESTIMONIALSWPB_INCLUDES_DIR . '/wpbakery-custom-param-collection/wpbakery-custom-param-collection.php';
		}
	}

	/**
	 * Set icon to config.
	 *
	 * @since 1.0
	 */
	public function set_icon( array $config, string $builder_slug, array $addon_data ): array {
		if ( $this->builder_slug !== $builder_slug ) {
			return $config;
		}

		if ( ! isset( $config['icon'] ) || ! is_string( $config['icon'] ) ) {
			return $config;
		}

		$icon_path = $addon_data['base_dir'] . '/' . $config['icon'];
		if ( ! file_exists( $icon_path ) ) {
			unset( $config['icon'] );
			function_exists( 'wp_trigger_error' ) && wp_trigger_error( 'set_icon', 'Failed to locate icon file: ' . esc_html( $icon_path ), E_USER_WARNING );
			return $config;
		}

		$icon_url = joywptestimonialswpb_convert_path_to_uri( $icon_path );
		if ( $icon_url ) {
			$config['icon'] = $icon_url;
		} else {
			unset( $config['icon'] );
		}

		return $config;
	}

	/**
	 * Set params that we will have for every addon.
	 */
	public function set_common_params( array $config, string $builder_slug ): array {
		if ( $this->builder_slug !== $builder_slug ) {
			return $config;
		}

		if ( function_exists( 'vc_config' ) && method_exists( vc_config(), 'get_css_animation' ) ) {
			$css_animation_param = [ vc_config()->get_css_animation() ];
		} else {
			$css_animation_param = [ vc_map_add_css_animation() ];
		}

		$css_animation_param[0]['wcp_group']            = true;
		$css_animation_param[0]['wcp_group_color']      = '#769e9f';
		$css_animation_param[0]['wcp_group_margin_top'] = '20';

		$config['params'] = array_merge(
			$config['params'],
			$css_animation_param,
			[
				[
					'type'              => 'joywp_divider',
					'param_name'        => 'advanced_divider',
					'title'             => __( 'Advanced', 'joywp-testimonials-wpbakery-addons' ),
					'title_description' => __( 'Advanced addon settings section', 'joywp-testimonials-wpbakery-addons' ),
					'color'             => '#d1d5db',
				],
				[
					'type'            => 'el_id',
					'heading'         => esc_html__( 'Element ID', 'joywp-testimonials-wpbakery-addons' ),
					'param_name'      => 'el_id',
					// translators: %1$s: link to w3c specification, %2$s: closing anchor tag.
					'description'     => sprintf( esc_html__( 'Enter element ID (Note: make sure it is unique and valid according to %1$sw3c specification%2$s).', 'joywp-testimonials-wpbakery-addons' ), '<a href="https://www.w3schools.com/tags/att_global_id.asp" target="_blank">', '</a>' ),
					'wcp_group'       => true,
					'wcp_group_color' => '#d1d5db',
				],
				[
					'type'            => 'textfield',
					'heading'         => esc_html__( 'Extra class name', 'joywp-testimonials-wpbakery-addons' ),
					'param_name'      => 'el_class',
					'description'     => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'joywp-testimonials-wpbakery-addons' ),
					'wcp_group'       => true,
					'wcp_group_color' => '#d1d5db',
				],
				[
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'joywp-testimonials-wpbakery-addons' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'joywp-testimonials-wpbakery-addons' ),
				],
			]
		);

		return $config;
	}

	/**
	 * Set default attributes for addon.
	 *
	 * @since 1.0
	 */
	public function set_addon_default_atts( array $atts, AbstractAddon $addon ): array {
		if ( $this->builder_slug !== $addon->builder_slug ) {
			return $atts;
		}

		$atts = $addon->get_addon_manager()->prepare_atts( $atts );

		return vc_map_get_attributes( $addon->addon_manager->getShortcode(), $atts );
	}

	/**
	 * Add default wrapper each wpbakery to addon.
	 *
	 * @since 1.0
	 */
	public function add_addon_output_default_wrapper( string $output, AbstractAddon $addon ): string {
		if ( $this->builder_slug !== $addon->builder_slug ) {
			return $output;
		}

		return joywptestimonialswpb_get_template(
			'builders/wpbakery/addon-wrapper-output.php',
			[
				'element_class' => $addon->addon_slug,
				'output'        => $output,
				'addon'         => $addon,
			]
		);
	}
}
