<?php
/**
 * Addons configuration manager.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons;

use WP_Exception;

defined( 'ABSPATH' ) || exit;

/**
 * Class manage addons configuration file.
 *
 * @since 1.0
 */
class ConfigManager {

	/**
	 * Config file path.
	 *
	 * @since 1.0
	 */
	public array $addon_data;

	/**
	 * Config file content.
	 *
	 * @since 1.0
	 */
	public string $config_file_content;

	/**
	 * Addon configuration.
	 *
	 * @since 1.0
	 */
	public array $config;

	/**
	 * Get initial configuration file.
	 *
	 * @since 1.0
	 */
	public function get_config(): array {
		return $this->config;
	}

	/**
	 * Set addon data.
	 * Here we keep initial addon data like paths to main files.
	 *
	 * @since 1.0
	 */
	public function set_addon_data( array $addon_data ): ConfigManager {
		$this->addon_data = $addon_data;
		return $this;
	}

	/**
	 * Get config file content.
	 *
	 * @since 1.0
	 * @throws WP_Exception
	 */
	public function get_file_content(): ConfigManager {
		$this->config_file_content = file_get_contents( $this->addon_data['config'] );
		if ( false === $this->config_file_content ) {
			throw new WP_Exception(
				sprintf(
					'Failed to read config file: %s',
					esc_html( $this->addon_data['config'] )
				)
			);
		}

		return $this;
	}

	/**
	 * Decode config file content.
	 *
	 * @since 1.0
	 * @throws WP_Exception
	 */
	public function decode(): ConfigManager {
		$decoded_content = json_decode( $this->config_file_content, true );
		if ( json_last_error() !== JSON_ERROR_NONE ) {
			throw new WP_Exception(
				sprintf(
					'Failed to decode JSON config file %s. Error: %s',
					esc_html( $this->addon_data['config'] ),
					esc_html( json_last_error_msg() )
				)
			);
		}

		$this->config = $decoded_content;
		return $this;
	}

	/**
	 * Set icon to config.
	 *
	 * @since 1.0
	 * @throws WP_Exception
	 */
	public function set_icon(): ConfigManager {
		if ( ! isset( $this->config['icon'] ) || ! is_string( $this->config['icon'] ) ) {
			return $this;
		}

		$icon_path = $this->addon_data['base_dir'] . '/' . $this->config['icon'];
		if ( ! file_exists( $icon_path ) ) {
			unset( $this->config['icon'] );
			throw new WP_Exception(
				'Failed to locate icon file: ' . esc_html( $icon_path )
			);
		}

		$icon_url = joywptestimonialswpb_convert_path_to_uri( $icon_path );
		if ( $icon_url ) {
			$this->config['icon'] = $icon_url;
		} else {
			unset( $this->config['icon'] );
		}

		return $this;
	}

	/**
	 * Set params to config.
	 *
	 * @since 1.0
	 * @throws WP_Exception
	 */
	public function set_params(): ConfigManager {
		if ( ! isset( $this->config['params'] ) ) {
			throw new WP_Exception(
				sprintf(
					'Failed to find params in addon config file %s.',
					esc_html( $this->addon_data['config'] ),
				)
			);
		}

		if ( is_array( $this->config['params'] ) ) {
			// params already set config directly.
			return $this;
		}

		if ( ! is_string( $this->config['params'] ) ) {
			throw new WP_Exception(
				sprintf(
					'Invalid params format in addon config file %s. Expected string or array.',
					esc_html( $this->addon_data['config'] ),
				)
			);
		}

		$params_content = $this->get_params_from_file();

		$this->config['params'] = $params_content;
		return $this;
	}

	/**
	 * Get params content from file.
	 *
	 * @throws WP_Exception
	 */
	public function get_params_from_file(): array {
		$params_path = $this->addon_data['base_dir'] . '/' . $this->config['params'];
		if ( ! file_exists( $params_path ) ) {
			unset( $this->config['params'] );
			throw new WP_Exception(
				'Failed to locate addon params file: ' . esc_html( $params_path )
			);
		}

		$extension = strtolower( pathinfo( $this->config['params'], PATHINFO_EXTENSION ) );

		switch ( $extension ) {
			case 'json':
				$params = $this->process_params_from_json( $params_path );
				break;
			case 'php':
				$params = $this->process_params_from_php( $params_path );
				break;
			default:
				throw new WP_Exception(
					sprintf(
						'Unsupported params file format: %s in addon config file %s.',
						esc_html( $extension ),
						esc_html( $this->addon_data['config'] ),
					)
				);
		}

		if ( ! is_array( $params ) ) {
			throw new WP_Exception(
				sprintf(
					'Invalid params format in PHP params file %s. Expected array.',
					esc_html( $params_path ),
				)
			);
		}

		return $params;
	}

	/**
	 * Process params from JSON file.
	 *
	 * @return mixed
	 * @throws WP_Exception
	 */
	public function process_params_from_json( string $params_path ) {
		$params_content = file_get_contents( $params_path );
		if ( false === $params_content ) {
			throw new WP_Exception(
				sprintf(
					'Failed to read addons params file: %s',
					esc_html( $this->addon_data['config'] )
				)
			);
		}

		$params_content = json_decode( $params_content, true );
		if ( json_last_error() !== JSON_ERROR_NONE ) {
			throw new WP_Exception(
				sprintf(
					'Failed to decode JSON params file %s. Error: %s',
					esc_html( $params_path ),
					esc_html( json_last_error_msg() )
				)
			);
		}
		return $params_content;
	}

	/**
	 * Process params from PHP file.
	 *
	 * @throws WP_Exception
	 * @return mixed
	 */
	public function process_params_from_php( string $params_path ) {
		return include $params_path;
	}
}
