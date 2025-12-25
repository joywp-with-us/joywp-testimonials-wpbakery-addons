<?php
/**
 * Json Translator.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons;

defined( 'ABSPATH' ) || exit;

/**
 * Class setup translate addons json through wp localization api.
 *
 * @since 1.0
 */
class JsonTranslator {
	/**
	 * Recursively translate JSON data and remove translation keys.
	 */
	public function localize( array $data ): array {
		return $this->recursive_translate( $data );
	}

	/**
	 * Generate PHP localizer file for POT generation.
	 *
	 * @since 1.0
	 */
	public function generate_php_localizer( array $data ): void {
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if ( ! isset( $_GET['joywp_json_localize'] ) ) {
			return;
		}

		$file_path = $this->get_php_file_localizer_path();
		$lines     = $this->recursive_extract_strings( $data );

		$content = "<?php\n// This file is auto-generated for json translation only\n";
		foreach ( $lines as $line ) {
			$content .= $line . "\n";
		}

		joywptestimonialswpb_file_put_contents( $content, $file_path );
	}

	/**
	 * Get the path to the php file that localizes JSON strings.
	 *
	 * @since 1.0
	 */
	public function get_php_file_localizer_path(): string {
		$path_to_php_file = JOYWPTESTIMONIALSWPB_LOCALIZATION_DIR . '/json-localizer.php';
		/**
		 * Hook to change the path to the php localizer file.
		 *
		 * @since 1.0
		 */
		return apply_filters( 'joywp_testimonials_wpb_json_localizer_file_path', $path_to_php_file );
	}

	/**
	 * Internal: recursively translate JSON data
	 *
	 * @since 1.0
	 * @return string|array
	 */
	public function recursive_translate( array $data ) {
		if ( isset( $data['text'] ) && ! empty( $data['translate'] ) && isset( $data['text_domain'] ) ) {
            // phpcs:ignore:WordPress.WP.I18n.NonSingularStringLiteralText, WordPress.WP.I18n.NonSingularStringLiteralDomain
			return __( $data['text'], $data['text_domain'] );
		}

		foreach ( $data as $key => $value ) {
			if ( is_array( $value ) ) {
				$data[ $key ] = $this->recursive_translate( $value );
			}
		}

		unset( $data['text'], $data['translate'], $data['text_domain'] );

		return $data;
	}

	/**
	 * Internal: recursively extract translatable strings from JSON
	 *
	 * @since 1.0
	 */
	public function recursive_extract_strings( array $data ): array {
		$lines = [];

		if ( isset( $data['text'] ) && ! empty( $data['translate'] ) && isset( $data['text_domain'] ) ) {
			$lines[] = "__( '" . addslashes( $data['text'] ) . "', '" . $data['text_domain'] . "' );";
		}

		foreach ( $data as $value ) {
			if ( is_array( $value ) ) {
				$lines = array_merge( $lines, $this->recursive_extract_strings( $value ) );
			}
		}

		return $lines;
	}
}
