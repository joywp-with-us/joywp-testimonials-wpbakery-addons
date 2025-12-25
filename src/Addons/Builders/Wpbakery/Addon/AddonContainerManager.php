<?php
/**
 * We use this empty class to only get instance of WPBakeryShortCodesContainer.
 * that represents addon manager for container addons.
 *
 * @note this class should stay always empty.
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
class AddonContainerManager extends WPBakeryShortCodesContainer {}
