<?php
/**
 * This class helps add position configurations to our addons.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Config\Params\Collection;

use JoywpTestimonialsWpb\Addons\AbstractParamsCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class Position
 *
 * @since 1.0
 */
class Position extends AbstractParamsCollection {
	/**
	 * Get integration config.
	 *
	 * @since 1.0
	 */
	public function get_collection_params(): array {
		return [
			[
				'type'             => 'joywp_number',
				'step'             => '0.1',
				'heading'          => esc_html__( 'Top', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'       => $this->collection->get_param_slug( 'top' ),
				'description'      => esc_html__( 'Top position', 'joywp-testimonials-wpbakery-addons' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type'             => 'joywp_number',
				'step'             => '0.1',
				'heading'          => esc_html__( 'Right', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'       => $this->collection->get_param_slug( 'right' ),
				'description'      => esc_html__( 'Right position', 'joywp-testimonials-wpbakery-addons' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type'             => 'joywp_number',
				'step'             => '0.1',
				'heading'          => esc_html__( 'Bottom', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'       => $this->collection->get_param_slug( 'bottom' ),
				'description'      => esc_html__( 'Bottom position', 'joywp-testimonials-wpbakery-addons' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type'             => 'joywp_number',
				'step'             => '0.1',
				'heading'          => esc_html__( 'Left', 'joywp-testimonials-wpbakery-addons' ),
				'param_name'       => $this->collection->get_param_slug( 'left' ),
				'description'      => esc_html__( 'Left position', 'joywp-testimonials-wpbakery-addons' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
		];
	}
}
