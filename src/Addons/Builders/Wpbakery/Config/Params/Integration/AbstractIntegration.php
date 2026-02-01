<?php
/**
 * Abstraction for integrations with other addons.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Config\Params\Integration;

use JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Config\Params\AbstractParams;

defined( 'ABSPATH' ) || exit;

/**
 * Class AbstractIntegration
 *
 * @since 1.0
 */
abstract class AbstractIntegration extends AbstractParams {
	/**
	 * Get integration addon params.
	 *
	 * @since 1.0
	 */
	abstract public function get_integration_addon_params(): array;

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
		$integration_params = $this->get_integration_addon_params();

		$exclude = array_merge( $this->get_always_exclude_params(), $this->exclude );

		$include_params = [ 'exclude' => $exclude ];

		return vc_map_integrate_shortcode(
			$integration_params,
			'',
			'',
			$include_params
		);
	}
}
