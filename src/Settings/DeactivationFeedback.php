<?php
/**
 * Plugin deactivation feedback functionality.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Settings;

use JoywpTestimonialsWpb\Utils\Api;

defined( 'ABSPATH' ) || exit;

/**
 * Class DeactivationFeedback
 *
 * @since 1.0
 */
class DeactivationFeedback {
	/**
	 * Initialize plugin deactivation feedback functionality.
	 *
	 * @since 1.0
	 */
	public function init(): void {
		add_action(
			'current_screen',
			function (): void {
				if ( ! $this->is_plugins_screen() ) {
					return;
				}

				add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_feedback_dialog_style' ] );
				add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_feedback_dialog_scripts' ] );
			}
		);

		add_action( 'wp_ajax_joywp_testimonials_wpb_deactivate_feedback', [ $this, 'ajax_plugin_deactivate_feedback' ] );
	}

	/**
	 * Enqueue feedback dialog scripts.
	 *
	 * Registers the feedback dialog scripts and enqueues them.
	 *
	 * @since 1.0
	 */
	public function enqueue_feedback_dialog_scripts(): void {
		add_action( 'admin_footer', [ $this, 'print_deactivate_feedback_dialog' ] );

		wp_register_script(
			'joywp-testimonials-wpb-deactivation-feedback',
			JOYWPTESTIMONIALSWPB_URI . '/assets/js/settings/deactivation-popup.js',
			[
				'jquery',
			],
			JOYWPTESTIMONIALSWPB_VERSION,
			true
		);

		wp_enqueue_script( 'joywp-testimonials-wpb-deactivation-feedback' );
	}

	/**
	 * Enqueue feedback dialog style.
	 *
	 * Registers the feedback dialog styles and enqueues them.
	 *
	 * @since 1.0
	 */
	public function enqueue_feedback_dialog_style(): void {
		wp_register_style(
			'joywp-testimonials-wpb-deactivation-feedback',
			JOYWPTESTIMONIALSWPB_URI . '/assets/css/settings/deactivation-popup.css',
			[],
			JOYWPTESTIMONIALSWPB_VERSION
		);

		wp_enqueue_style( 'joywp-testimonials-wpb-deactivation-feedback' );
	}


	/**
	 * Print deactivate feedback dialog.
	 *
	 * Display a dialog box to ask the user why he deactivated plugin.
	 *
	 * @since 1.0
	 */
	public function print_deactivate_feedback_dialog(): void {
		joywptestimonialswpb_include_template(
			'settings/deactivation-popup.php'
		);
	}

	/**
	 * Ajax plugin deactivate feedback.
	 *
	 * Send the user feedback when plugin is deactivated.
	 *
	 * @since 1.0
	 */
	public function ajax_plugin_deactivate_feedback(): void {
		if ( ! isset( $_POST['_wpnonce'], $_POST['reason_key'] ) ) {
			wp_send_json_error();
		}

		if ( ! current_user_can( 'activate_plugins' ) ) {
			wp_send_json_error();
		}

        //phpcs:disable WordPress.Security.ValidatedSanitizedInput
		if ( ! wp_verify_nonce( $_POST['_wpnonce'], '_joywp_deactivate_feedback_action' ) ) {
			wp_send_json_error();
		}

		$reason_key = wp_kses_post_deep( wp_unslash( $_POST['reason_key'] ) );

		$reason_text = '';
		$details_key = $reason_key . '_details';
		if ( isset( $_POST[ $details_key ] ) ) {
			$reason_text = wp_kses_post_deep( wp_unslash( $_POST[ $details_key ] ) );
		}

		$reason_text = wp_kses_post_deep( wp_unslash( $reason_text ) );
        //phpcs:enable WordPress.Security.ValidatedSanitizedInput

		Api::send_feedback( $reason_key, $reason_text );

		wp_send_json_success();
	}

	/**
	 * Check if the current screen is the wp plugins page screen.
	 *
	 * @since 1.0
	 */
	public function is_plugins_screen(): bool {
		return in_array( get_current_screen()->id, [ 'plugins', 'plugins-network' ], true );
	}
}
