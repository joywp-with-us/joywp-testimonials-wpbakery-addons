<?php
/**
 * Library of helper functions.
 *
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'joywptestimonialswpb_include_template' ) ) :
	/**
	 * Include template from templates dir.
	 *
	 * @since 1.0
	 * @return mixed
	 */
	function joywptestimonialswpb_include_template( string $template, array $variables = [], bool $once = false ) {
        // phpcs:ignore:WordPress.PHP.DontExtract.extract_extract
		is_array( $variables ) && extract( $variables );
		if ( $once ) {
			return require_once joywptestimonialswpb_get_template_path( $template );
		} else {
			return require joywptestimonialswpb_get_template_path( $template );
		}
	}
endif;

if ( ! function_exists( 'joywptestimonialswpb_get_template' ) ) :
	/**
	 * Output template from templates dir.
	 *
	 * @since 1.0
	 */
	function joywptestimonialswpb_get_template( string $template, array $variables = [], bool $once = false ): string {
		ob_start();
		$output = joywptestimonialswpb_include_template( $template, $variables, $once );

		if ( 1 === $output ) {
			$output = ob_get_contents();
		}

		ob_end_clean();

		return $output;
	}
endif;

if ( ! function_exists( 'joywptestimonialswpb_get_template_path' ) ) :
	/**
	 * Shorthand for getting to the plugin templates.
	 *
	 * @since 1.0
	 */
	function joywptestimonialswpb_get_template_path( string $file ): string {
		return JOYWPTESTIMONIALSWPB_TEMPLATES_DIR . '/' . $file;
	}
endif;

if ( ! function_exists( 'joywptestimonialswpb_config' ) ) :
	/**
	 * Retrieve a configuration value from a file in the config directory.
	 *
	 * @return mixed The configuration value.
	 */
	function joywptestimonialswpb_config( string $config_path ) {
		static $loaded_configs = [];

		// Replace dots with slashes, except for the last dot.
		$path = str_replace( '.', '/', $config_path );

		// Check if the config file has already been loaded.
		if ( ! isset( $loaded_configs[ $path ] ) ) {
			$file_path = JOYWPTESTIMONIALSWPB_CONFIG_DIR . '/' . $path . '.php';

			// Load the configuration file.
			// This will throw a fatal error if the file does not exist.
			$loaded_configs[ $path ] = include_once $file_path;
		}

		// Retrieve config value.
		return $loaded_configs[ $path ];
	}
endif;

if ( ! function_exists( 'joywptestimonialswpb_file_put_contents' ) ) :
	/**
	 * Helper for file_put_contents with wp file system user.
	 *
	 * @since 1.0
	 */
	function joywptestimonialswpb_file_put_contents( string $content, string $file_path ): void {
		global $wp_filesystem;

		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
			WP_Filesystem();
		}

		$wp_filesystem->put_contents( $file_path, $content );
	}
endif;

if ( ! function_exists( 'joywptestimonialswpb_convert_path_to_uri' ) ) :
	/**
	 * Helper for file_put_contents with wp file system user.
	 *
	 * @since 1.0
	 */
	function joywptestimonialswpb_convert_path_to_uri( string $path ): string {
		$content_dir = wp_normalize_path( WP_CONTENT_DIR );
		$content_url = content_url();

		$path = wp_normalize_path( $path );

		if ( strpos( $path, $content_dir ) === 0 ) {
			$url = str_replace( $content_dir, $content_url, $path );
		} else {
			$url = '';
		}

		return $url;
	}
endif;
