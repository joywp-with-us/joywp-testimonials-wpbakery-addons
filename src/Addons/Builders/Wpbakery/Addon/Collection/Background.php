<?php
/**
 * This class helps manage background collection in addon templates.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Collection;

use JoywpTestimonialsWpb\Addons\AbstractAddonCollection;
use JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Addon;

defined( 'ABSPATH' ) || exit;

/**
 * Class Background
 *
 * @extends AbstractAddonCollection<Addon>
 *
 * @since 1.0
 */
class Background extends AbstractAddonCollection {
	/**
	 * Get render collection output.
	 *
	 * @since 1.0
	 */
	public function get_render_output( array $atts ): string {
		$output = '';
		switch ( $atts[ $this->collection->get_param_slug( 'type' ) ] ) {
			case 'color':
				$output = sprintf(
					'background-color: %s;',
					esc_attr( $atts[ $this->collection->get_param_slug( 'color' ) ] )
				);
				break;
			case 'gradient':
				$output = sprintf(
					'background: linear-gradient(to right, %s, %s);',
					esc_attr( $atts[ $this->collection->get_param_slug( 'from_gradient_color' ) ] ),
					esc_attr( $atts[ $this->collection->get_param_slug( 'to_gradient_color' ) ] )
				);
				break;
			case 'image':
				$output .= $this->get_image_css_style( $atts );
				$output .= $this->get_image_css_size( $atts );
				$output .= $this->get_image_css_repeat( $atts );
				$output .= $this->get_image_css_position( $atts );

				break;
		}

		return $output;
	}

	/**
	 * Get background-image CSS style.
	 *
	 * @since 1.0
	 */
	public function get_image_css_style( array $atts ): string {
		if ( 'external_link' === $atts[ $this->collection->get_param_slug( 'image_source' ) ] ) {
			$url = $atts[ $this->collection->get_param_slug( 'custom_src' ) ];
		} else {
			$url = wp_get_attachment_url( $atts[ $this->collection->get_param_slug( 'image' ) ] );
		}

		return sprintf(
			'background-image: url("%s");',
			esc_url( $url )
		);
	}

	/**
	 * Get background-size CSS size.
	 *
	 * @since 1.0
	 */
	public function get_image_css_size( array $atts ): string {
		switch ( $atts[ $this->collection->get_param_slug( 'image_size' ) ] ) {
			case 'cover':
				return 'background-size: cover;';
			case 'contain':
				return 'background-size: contain;';
			case 'custom':
				$width  = $this->get_size( 'img_width', $atts );
				$height = $this->get_size( 'img_height', $atts );

				if ( 'auto' === $width && 'auto' === $height ) {
					return '';
				}

				return sprintf(
					'background-size: %s %s;',
					esc_attr( $width ),
					esc_attr( $height )
				);
		}

		return '';
	}

	/**
	 * Get custom background size.
	 *
	 * @since 1.0
	 */
	public function get_size( string $size_name, array $atts ): string {
		$size = 'auto';
		if ( '' !== $atts[ $this->collection->get_param_slug( $size_name ) ] ) {
			$size = $atts[ $this->collection->get_param_slug( $size_name ) ] . 'px';
		}

		return $size;
	}

	/**
	 * Get background-repeat CSS repeat.
	 *
	 * @since 1.0
	 */
	public function get_image_css_repeat( array $atts ): string {
		$repeat = $atts[ $this->collection->get_param_slug( 'image_repeat' ) ] ?? 'no-repeat';

		return sprintf(
			'background-repeat: %s;',
			esc_attr( $repeat )
		);
	}

	/**
	 * Get background-position CSS position.
	 *
	 * @since 1.0
	 */
	public function get_image_css_position( array $atts ): string {

		if ( ! $atts[ $this->collection->get_param_slug( 'image_position' ) ] ) {
			return '';
		}

		$position = $atts[ $this->collection->get_param_slug( 'image_position' ) ] ?? 'center';
		return sprintf(
			'background-position: %s;',
			esc_attr( $position )
		);
	}
}
