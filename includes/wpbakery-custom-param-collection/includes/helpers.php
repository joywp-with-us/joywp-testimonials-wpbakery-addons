<?php
/**
 * Library of helper functions.
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wpbcustomparamcollection_include_template' ) ) :
	/**
	 * Include template from templates dir.
	 *
	 * @param array $variables - passed variables to the template.
	 *
	 * @return mixed
	 */
	function wpbcustomparamcollection_include_template( string $template, array $variables = [], bool $once = false ) {
        // phpcs:ignore:WordPress.PHP.DontExtract.extract_extract
		is_array( $variables ) && extract( $variables );
		if ( $once ) {
			return require_once wpbcustomparamcollection_get_template_path( $template );
		} else {
			return require wpbcustomparamcollection_get_template_path( $template );
		}
	}
endif;

if ( ! function_exists( 'wpbcustomparamcollection_get_template' ) ) :
	/**
	 * Output template from templates dir.
	 *
	 * @param array $variables - passed variables to the template.
	 */
	function wpbcustomparamcollection_get_template( string $template, array $variables = [], bool $once = false ): string {
		ob_start();
		$output = wpbcustomparamcollection_include_template( $template, $variables, $once );

		if ( 1 === $output ) {
			$output = ob_get_contents();
		}

		ob_end_clean();

		return $output;
	}
endif;

if ( ! function_exists( 'wpbcustomparamcollection_get_template_path' ) ) :
	/**
	 * Shorthand for getting to the plugin templates.
	 */
	function wpbcustomparamcollection_get_template_path( string $file ): string {
		return WPBCUSTOMPARAMCCOLECTION_TEMPLATES_DIR . '/' . $file;
	}
endif;

if ( ! function_exists( 'wpbcustomparamcollection_config' ) ) :
	/**
	 * Retrieve a configuration value from a file in the config directory.
	 *
	 * @param string $config_path The path to the configuration value, e.g. 'elements.foo'.
	 *
	 * @return mixed The configuration value.
	 */
	function wpbcustomparamcollection_config( string $config_path ) {
		static $loaded_configs = [];

		// Replace dots with slashes, except for the last dot.
		$path = str_replace( '.', '/', $config_path );

		// Check if the config file has already been loaded.
		if ( ! isset( $loaded_configs[ $path ] ) ) {
			$file_path = WPBCUSTOMPARAMCCOLECTION_CONFIG_DIR . '/' . $path . '.php';

			// Load the configuration file.
			// This will throw a fatal error if the file does not exist.
			$loaded_configs[ $path ] = include $file_path;
		}

		// Retrieve config value.
		return $loaded_configs[ $path ];
	}
endif;
