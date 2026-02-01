<?php
/**
 * Abstraction for integrations with other addons.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Config\Params\Collection;

use JoywpTestimonialsWpb\Addons\AbstractParamsCollection;

defined( 'ABSPATH' ) || exit;

/**
 * Class ParamsCollectionIntegration
 *
 * @since 1.0
 */
abstract class AbstractParamsCollectionIntegration extends AbstractParamsCollection {
	/**
	 * Parameters to exclude from integration.
	 *
	 * @since 1.0
	 */
	public array $exclude = [];

	/**
	 * Set parameters to exclude from integration.
	 *
	 * @since 1.0
	 */
	public function set_exclude( array $exclude_params ): AbstractParamsCollection {
		$this->exclude = $exclude_params;
		return $this;
	}

	/**
	 * Get params list that we always exclude.
	 *
	 * @since 1.0
	 */
	public function get_always_exclude_params(): array {
		return [];
	}

	/**
	 * Get integration params.
	 *
	 * @since 1.0
	 */
	public function get_params(): array {
		$params = $this->get_collection_params();

		$exclude = array_merge( $this->get_always_exclude_params(), $this->exclude );

		$change_fields = [ 'exclude' => $exclude ];

		return vc_map_integrate_shortcode(
			$params,
			$this->prefix,
			'',
			$change_fields
		);
	}
}
