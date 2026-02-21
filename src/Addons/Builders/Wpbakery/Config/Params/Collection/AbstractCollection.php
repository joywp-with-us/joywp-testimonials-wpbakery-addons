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
abstract class AbstractCollection extends AbstractParamsCollection {
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
		$config = $this->get_collection_params();

		$params = vc_map_integrate_shortcode(
			$config,
			$this->prefix,
		);

		return $this->integrate_specific_params( $params );
	}

	/**
	 * Implement include only params.
	 *
	 * @since 1.0
	 */
	protected function implement_exclude( array $params ): array {
		$always_exclude = $this->get_always_exclude_params();
		if ( ! $this->exclude && ! $always_exclude ) {
			return $params;
		}

		foreach ( $params as $key => $param_data ) {
			if ( in_array( $param_data['param_name'], $this->exclude, true ) ) {
				unset( $params[ $key ] );
			}
			if ( in_array( $param_data['param_name'], $always_exclude, true ) ) {
				unset( $params[ $key ] );
			}
		}

		return $params;
	}
}
