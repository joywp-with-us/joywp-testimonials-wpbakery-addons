<?php
/**
 * Plugin settings manager.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Settings;

defined( 'ABSPATH' ) || exit;

/**
 * Class SettingsManager
 *
 * @since 1.0
 */
class SettingsManager {
	/**
	 * Initialize settings manager.
	 *
	 * @since 1.0
	 */
	public function init(): void {
		$deactivation_feedback = new DeactivationFeedback();
		$deactivation_feedback->init();
	}
}
