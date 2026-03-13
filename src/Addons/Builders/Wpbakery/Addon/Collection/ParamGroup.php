<?php
/**
 * This class helps manage param_group
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Collection;

use JoywpTestimonialsWpb\Addons\AbstractAddonCollection;
use JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Addon;

defined( 'ABSPATH' ) || exit;

/**
 * Class ParamGroup
 *
 * @extends AbstractAddonCollection<Addon>
 *
 * @since 1.0
 */
class ParamGroup extends AbstractAddonCollection {
	/**
	 * Get items for param_group.
	 *
	 * @since 1.0
	 */
	public function get_items( array $items_atts ): array {
		$items = vc_param_group_parse_atts( $items_atts['items'] );
		$items = is_array( $items ) ? $items : [];

		return $this->set_items_id( $items, 'items' );
	}

	/**
	 * Set unique ID for each item in the list.
	 *
	 * @since 1.0
	 */
	public function set_items_id( array $item_list, string $atts_name ): array {
		$uniq = uniqid( $atts_name . '-' );
		foreach ( $item_list as $key => $item ) {
			$item_list[ $key ]['id'] = $this->addon->id . '-' . $uniq . '-' . $key;
		}

		return $item_list;
	}
}
