<?php
/**
 * Wpbakery addon.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon;

use WPBakeryShortCode;
use JoywpTestimonialsWpb\Addons\AbstractAddon;

defined( 'ABSPATH' ) || exit;

/**
 * Wpbakery Addon class.
 *
 * @since 1.0
 */
class Addon extends AbstractAddon {
	/**
	 * Addon attributes.
	 *
	 * Attributes - options values
	 * that user can pass when edit addon.
	 *
	 * @since 1.0
	 */
	public array $addon_atts;

	/**
	 * Addon manager class instance.
	 *
	 * @since 1.0
	 */
	public WPBakeryShortCode $addon_manager;

	/**
	 * External assets prefix.
	 *
	 * @since 1.0
	 */
	public string $external_assets_prefix = 'joywp';

	/**
	 * Set WPBakeryShortCode.
	 *
	 * @since 1.0
	 */
	public function set_addon_manager( WPBakeryShortCode $addon_manager ): Addon {
		$this->addon_manager = $addon_manager;
		return $this;
	}

	/**
	 * Render addon.
	 *
	 * @since 1.0
	 */
	public function render_addon( array $atts ): string {
		$this->addon_atts = $atts;

		$atts = vc_map_get_attributes( $this->addon_manager->getShortcode(), $atts );

		$this->id = uniqid( $this->addon_slug . '-' );

		$this->enqueue_addon_assets();

		ob_start();
		$output = require_once $this->template;
		if ( 1 === $output ) {
			$output = ob_get_contents();
		}
		ob_end_clean();

		return $output;
	}

	/**
	 * Here we combine initial markup attributes that has our addon wrapper
	 * with all attributes that should contain regular addon
	 * and output them escaped and ready to use in our addon wrapper.
	 *
	 * @param array $initial_markup_atts wrapper attributes that has our initial addon markup.
	 * @since 1.0
	 */
	public function output_addon_wrapper_attributes( array $initial_markup_atts = [] ): void {
		$classes = $this->get_wrapper_classes( $initial_markup_atts );

		unset( $initial_markup_atts['class'] );
		$addon_wrapper_attributes['class']                          = $classes;
		$addon_wrapper_attributes['id']                             = empty( $this->addon_atts['el_id'] ) ? [] : $this->addon_atts['el_id'];
		$addon_wrapper_attributes[ $this->get_data_attribute_id() ] = $this->id;

		$addon_wrapper_attributes = array_merge( $addon_wrapper_attributes, $initial_markup_atts );

		foreach ( $addon_wrapper_attributes as $name => $value ) {
			if ( ! empty( $value ) ) {
				echo ' ' . esc_attr( $name ) . '="' . esc_attr( $value ) . '"';
			}
		}
	}

	/**
	 * Get data attribute id.
	 *
	 * @since 1.0
	 */
	public function get_data_attribute_id(): string {
		return 'data-joywp-addon-id';
	}

	/**
	 * Get classes for addon wrapper.
	 *
	 * @param array $initial_markup_atts wrapper attributes that has our initial addon markup.
	 * @since 1.0
	 */
	public function get_wrapper_classes( array $initial_markup_atts ): string {
		$classes  = empty( $this->addon_atts['css'] ) ? '' : vc_shortcode_custom_css_class( $this->addon_atts['css'], ' ' );
		$classes .= empty( $this->addon_atts['el_class'] ) ? '' : $this->addon_manager->getExtraClass( $this->addon_atts['el_class'] );
		$classes .= empty( $this->addon_atts['css_animation'] ) ? '' : $this->addon_manager->getCSSAnimation( $this->addon_atts['css_animation'] );
		$classes .= empty( $initial_markup_atts['class'] ) ? '' : ' ' . $initial_markup_atts['class'];

		return $classes;
	}

	/**
	 * Output uniq id with data attribute that we can use in our styles.
	 *
	 * @since 1.0
	 */
	public function output_style_addon_id(): void {
		echo '[' . esc_attr( $this->get_data_attribute_id() ) . '="' . esc_attr( $this->id ) . '"]';
	}

	/**
	 * We use it when want to get output template addon shortcode
	 * that was already integrated in current addon.
	 *
	 * @param string $integrated_prefix we use this prefix to find integrated shortcode atts,
	 * that contains our current shortcode atts.
	 *
	 * @since 1.0
	 */
	public function get_integrated_shortcode_output( array $atts, string $integrated_slug, string $integrated_prefix ): string {
		$data = vc_map_integrate_parse_atts( $this->addon_slug, $integrated_slug, $atts, $integrated_prefix );
		if ( $data ) {
			$integrated_shortcode = vc_manager()->vc()->getShortCode( 'vc_icon' );
			if ( is_object( $integrated_shortcode ) ) {
				return $integrated_shortcode->render( array_filter( $data ) );
			}
		}

		return '';
	}
}
