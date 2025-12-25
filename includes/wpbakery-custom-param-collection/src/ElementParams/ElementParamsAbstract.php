<?php
/**
 * Base abstract class for custom element params.
 *
 * @see https://kb.wpbakery.com/docs/developers-how-tos/create-new-param-type
 */

namespace WpbCustomParamCollection\ElementParams;

defined( 'ABSPATH' ) || exit;

/**
 * ElementParamsAbstract class.
 */
abstract class ElementParamsAbstract {
	/**
	 * Element params templates folder.
	 */
	public string $element_params_templates_folder = 'element-params';

	/**
	 * Param slug.
	 */
	public string $param_slug;

	/**
	 * List of param attributes and their default values.
	 */
	public array $param_defaults;

	/**
	 * Attributes common for all params.
	 */
	public array $common_attrs = [
		'param_name' => '',
		'class'      => '',
	];

	/**
	 * ElementParamsAbstract constructor.
	 */
	public function __construct( string $param_slug, array $param_defaults ) {
		$this->param_slug     = $param_slug;
		$this->param_defaults = $param_defaults;
	}

	/**
	 * Check if initially attr not set then set default values.
	 */
	public function get_default_settings( array $settings ): array {
		$values = [];

		foreach ( $this->get_param_default_attr_list() as $name => $default_value ) {
			$values[ $name ] = $settings[ $name ] ?? $default_value;
		}

		return $values;
	}

	/**
	 * Get specific param settings.
	 * This method can be overridden in child classes to provide specific settings for each param type.
	 */
	public function get_specific_param_settings( array $settings ): array {
		return $settings;
	}

	/**
	 * Get param default attr list.
	 */
	public function get_param_default_attr_list(): array {
		return $this->add_common_param_defaults( $this->param_defaults );
	}

	/**
	 * Add common param defaults.
	 */
	public function add_common_param_defaults( array $defaults ): array {
		return array_merge( $defaults, $this->common_attrs );
	}

	/**
	 * Param output.
	 *
	 * @param mixed $value
	 */
	public function param_output( array $settings_initial, $value ): string {
		$settings = $this->get_default_settings( $settings_initial );
		$settings = $this->get_specific_param_settings( $settings );

		$output = wpbcustomparamcollection_get_template(
			$this->get_param_template_name(),
			[
				'value'            => $value,
				'initial_settings' => $settings,
				'settings'         => $settings,
				'_this'            => $this,
			]
		);

		return $this->attach_styles_to_param_output( $output );
	}

	/**
	 * Attach param styles to param output.
	 */
	public function attach_styles_to_param_output( string $output ): string {
		$file_name = str_replace( '_', '-', $this->param_slug );

		$path        = '/css/params/' . $file_name . '.css';
		$param_style = WPBCUSTOMPARAMCCOLECTION_ASSETS_DIR . $path;

		if ( ! file_exists( $param_style ) ) {
			return $output;
		}

        // phpcs:ignore:WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		$output .= '<style>' . file_get_contents( $param_style ) . '</style>';

		return $output;
	}

	/**
	 * Get param slug.
	 */
	public function get_param_slug(): string {
		return $this->param_slug;
	}

	/**
	 * Get param template name.
	 */
	public function get_param_template_name(): string {
		$file_name = str_replace( '_', '-', $this->get_param_slug() );
		return $this->element_params_templates_folder . '/' . $file_name . '.php';
	}

	/**
	 * Get param classes.
	 */
	public function get_param_classes( array $settings ): string {
		$class_list = [
			'wpb_vc_param_value',
			$settings['param_name'],
			$settings['type'],
			$settings['class'],
		];

		return implode( ' ', $class_list );
	}
}
