<?php
/**
 * We use this empty class to only get instance of WPBakeryShortCodesContainer.
 * that represents addon manager for container addons.
 *
 * * @note if you need place for a common functionality of every addon then use Addon class.
 * * @note if you need place for a functionality of a specific addon
 * * then use the addon class that you can specify in config.json
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon;

use WPBakeryShortCodesContainer;

defined( 'ABSPATH' ) || exit;

/**
 * VerticalTimeline shortcode class.
 *
 * @since 1.0
 */
class AddonContainerManager extends WPBakeryShortCodesContainer {
	/**
	 * Public version of protected prepareAtts method.
	 *
	 * @since 1.0
	 */
	public function prepare_atts( array $atts ): array {
		return $this->prepareAtts( $atts );
	}
}
