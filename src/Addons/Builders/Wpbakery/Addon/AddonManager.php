<?php
/**
 * We use this empty class to only get instance of WPBakeryShortCode
 * that represents addon manager.
 *
 * @note if you need place for a common functionality of every addon then use Addon class.
 * @note if you need place for a functionality of a specific addon
 * then use the addon class that you can specify in config.json
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon;

use WPBakeryShortCode;

defined( 'ABSPATH' ) || exit;

/**
 * Addon Manager class.
 *
 * @since 1.0
 */
class AddonManager extends WPBakeryShortCode {
	/**
	 * Public version of protected prepareAtts method.
	 *
	 * @since 1.0
	 */
	public function prepare_atts( array $atts ): array {
		return $this->prepareAtts( $atts );
	}
}
