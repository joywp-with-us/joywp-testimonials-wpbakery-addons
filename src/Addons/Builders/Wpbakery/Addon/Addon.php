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
		$addon_wrapper_attributes['id']                             = empty( $this->atts['el_id'] ) ? [] : $this->atts['el_id'];
		$addon_wrapper_attributes[ $this->get_data_attribute_id() ] = $this->id;

		$addon_wrapper_attributes = array_merge( $addon_wrapper_attributes, $initial_markup_atts );

		foreach ( $addon_wrapper_attributes as $name => $value ) {
			if ( ! empty( $value ) ) {
				echo ' ' . esc_attr( $name ) . '="' . esc_attr( $value ) . '"';
			}
		}
	}

	/**
	 * Get classes for addon wrapper.
	 *
	 * @param array $initial_markup_atts wrapper attributes that has our initial addon markup.
	 * @since 1.0
	 */
	public function get_wrapper_classes( array $initial_markup_atts ): string {
		$classes  = empty( $this->atts['css'] ) ? '' : vc_shortcode_custom_css_class( $this->atts['css'], ' ' );
		$classes .= empty( $this->atts['el_class'] ) ? '' : $this->addon_manager->getExtraClass( $this->atts['el_class'] );
		$classes .= empty( $this->atts['css_animation'] ) ? '' : $this->addon_manager->getCSSAnimation( $this->atts['css_animation'] );
		$classes .= empty( $initial_markup_atts['class'] ) ? '' : ' ' . $initial_markup_atts['class'];

		return $classes;
	}

	/**
	 * We use it when want to get output template of another addon
	 * that was already integrated in current addon.
	 *
	 * @since 1.0
	 */
	public function get_integrated_addon_output( string $integrated_slug, array $atts ): string {
		$integrated_addon = vc_manager()->vc()->getShortCode( $integrated_slug );
		if ( is_object( $integrated_addon ) ) {
			return $integrated_addon->render( array_filter( $atts ) );
		}

		return '';
	}

	/**
	 * We use it when want to output template of another addon
	 * that was already integrated in current addon.
	 *
	 * @since 1.0
	 */
	public function output_integrated_addon( string $integrated_slug, array $atts ): void {
        // phpcs:ignore:WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $this->get_integrated_addon_output( $integrated_slug, $atts );
	}
}
