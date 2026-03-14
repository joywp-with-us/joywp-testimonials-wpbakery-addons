<?php
/**
 * Api utils class.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Utils;

use WP_Error;

/**
 * Plugin API.
 *
 * Plugin API utils class is responsible for communicating with plugin remote servers.
 *
 * @since 1.0
 */
class Api {
	/**
	 * API URL
	 *
	 * @since 1.0
	 */
	private static string $api_url = 'https://api.joywp.com';

	/**
	 * Endpoint's library
	 *
	 * @since 1.0
	 */
	private static array $endpoint_lib = [
		'plugin_deactivation_feedback' => 'plugin-deactivation-feedback',
	];

	/**
	 * We call endpoint here the full path for a specific API request.
	 *
	 * @since 1.0
	 */
	private static function get_endpoint( string $endpoint_slug ): string {

		if ( ! isset( self::$endpoint_lib[ $endpoint_slug ] ) ) {
			return '';
		}

		return self::$api_url . '/' . self::$endpoint_lib[ $endpoint_slug ];
	}

	/**
	 * Send Feedback.
	 *
	 * Fires a request to the plugin server with the feedback data
	 *
	 * @since 1.0
	 * @return array|WP_Error The response of the request.
	 */
	public static function send_feedback( string $feedback_key, string $feedback_text ) {
		$plugin_slug = basename( dirname( JOYWPTESTIMONIALSWPB_PLUGIN_FILE ) );
		$theme       = wp_get_theme();

		$endpoint = self::get_endpoint( 'plugin_deactivation_feedback' );

		if ( '' === $endpoint ) {
			return new WP_Error( 'invalid_endpoint', __( 'The API endpoint is invalid.', 'joywp-testimonials-wpbakery-addons' ) );
		}

		return wp_remote_post(
			self::get_endpoint( 'plugin_deactivation_feedback' ),
			[
				'timeout' => 30,
				'body'    => [
					'plugin'            => $plugin_slug,
					'plugin_version'    => JOYWPTESTIMONIALSWPB_VERSION,
					'wp_version'        => get_bloginfo( 'version' ),
					'php_version'       => phpversion(),
					'theme'             => $theme->get( 'Name' ),
					'theme_version'     => $theme->get( 'Version' ),
					'wp_bakery_version' => defined( 'WPB_VC_VERSION' ) ? WPB_VC_VERSION : '',
					'reason'            => $feedback_key,
					'reason_text'       => $feedback_text,
				],
			]
		);
	}
}
