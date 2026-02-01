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
	 * Builder slug.
	 *
	 * @since 1.0
	 */
	public string $builder_slug;

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
	 * Set builder slug.
	 *
	 * @since 1.0
	 */
	public function set_builder_slug( string $builder_slug ): ConfigManager {
		$this->builder_slug = $builder_slug;
		return $this;
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
			// params already set in config directly.
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

		$params = $this->get_params_from_file();

		$params = $this->set_params_defaults( $params );

		$this->config['params'] = $params;
		return $this;
	}

	/**
	 * Get params content from file.
	 *
	 * @throws WP_Exception
	 */
	public function get_params_from_file(): array {
		$path = $this->addon_data['base_dir'] . '/' . $this->config['params'];

		return $this->process_file( $path );
	}

	/**
	 * Set default values for params.
	 *
	 * @since 1.0
	 */
	public function set_params_defaults( array $params ): array {
		if ( ! isset( $this->config['defaults'] ) ) {
			return $params;
		}

		$path = $this->addon_data['base_dir'] . '/' . $this->config['defaults'];

		$defaults = $this->process_file( $path );

		foreach ( $params as $param_key => $single_param ) {
			if ( ! isset( $defaults[ $single_param['param_name'] ] ) ) {
				continue;
			}

			if ( isset( $single_param['value'] ) ) {
				$params[ $param_key ]['std'] = $defaults[ $single_param['param_name'] ];
			} else {
				$params[ $param_key ]['value'] = $defaults[ $single_param['param_name'] ];
			}
		}

		return $params;
	}

	/**
	 * Process file.
	 *
	 * @since 1.0
	 * @throws WP_Exception
	 */
	public function process_file( string $path ): array {
		if ( ! file_exists( $path ) ) {
			throw new WP_Exception(
				'Failed to locate addon file: ' . esc_html( $path )
			);
		}

		$extension = strtolower( pathinfo( $this->config['params'], PATHINFO_EXTENSION ) );

		switch ( $extension ) {
			case 'json':
				$file_data = $this->process_from_json( $path );
				break;
			case 'php':
				$file_data = $this->process_from_php( $path );
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

		if ( ! is_array( $file_data ) ) {
			throw new WP_Exception(
				sprintf(
					'Invalid params format in PHP params file %s. Expected array.',
					esc_html( $path ),
				)
			);
		}

		return $file_data;
	}

	/**
	 * Process from JSON file.
	 *
	 * @return mixed
	 * @throws WP_Exception
	 */
	public function process_from_json( string $path ) {
		$content = file_get_contents( $path );
		if ( false === $content ) {
			throw new WP_Exception(
				sprintf(
					'Failed to read addons file: %s',
					esc_html( $this->addon_data['config'] )
				)
			);
		}

		$content = json_decode( $content, true );
		if ( json_last_error() !== JSON_ERROR_NONE ) {
			throw new WP_Exception(
				sprintf(
					'Failed to decode JSON file %s. Error: %s',
					esc_html( $path ),
					esc_html( json_last_error_msg() )
				)
			);
		}
		return $content;
	}



	/**
	 * Process from PHP file.
	 *
	 * @throws WP_Exception
	 * @return mixed
	 */
	public function process_from_php( string $path ) {
		$config = $this;

		return include $path;
	}
}
