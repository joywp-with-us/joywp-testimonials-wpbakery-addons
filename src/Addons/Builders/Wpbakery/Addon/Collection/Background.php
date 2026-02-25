<?php
/**
 * This class helps manage background collection in addon templates.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Collection;

use JoywpTestimonialsWpb\Addons\AbstractAddonCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class Background
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
				if ( 'external_link' === $atts[ $this->collection->get_param_slug( 'image_source' ) ] ) {
					$url = $atts[ $this->collection->get_param_slug( 'custom_src' ) ];
				} else {
					$url = wp_get_attachment_url( $atts[ $this->collection->get_param_slug( 'image' ) ] );
				}
				$output = sprintf(
					'background-image: url("%s");',
					esc_url( $url )
				);
				break;
		}

		return $output;
	}
}
