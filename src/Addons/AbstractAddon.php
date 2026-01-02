<?php
/**
 * Abstract addon class.
 * Functionality that common for all addons builders.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons;

use JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Addon;

defined( 'ABSPATH' ) || exit;

/**
 * Abstract addon class.
 *
 * @since 1.0
 */
abstract class AbstractAddon {
	/**
	 * Addon slug.
	 *
	 * @since 1.0
	 */
	public string $addon_slug;

	/**
	 * Addon template file.
	 *
	 * @since 1.0
	 */
	public string $template;

	/**
	 * Addon config.
	 *
	 * @since 1.0
	 */
	public array $config;

	/**
	 * Addon base dir.
	 *
	 * @since 1.0
	 */
	public string $base_dir;

	/**
	 * Addon id.
	 * It's uniq id that we use only for our plugin addons.
	 *
	 * @since 1.0
	 */
	public string $id;

	/**
	 * Addon attributes.
	 *
	 * Attributes - builder ui addon options values that user set when edit addon.
	 *
	 * @since 1.0
	 */
	public array $atts;

	/**
	 * Builder slug.
	 *
	 * @since 1.0
	 */
	public string $builder_slug;

	/**
	 * Set builder slug.
	 *
	 * @since 1.0
	 */
	public function set_builder_slug( string $builder_slug ): Addon {
		$this->builder_slug = $builder_slug;
		return $this;
	}

	/**
	 * Set addon slug.
	 *
	 * @since 1.0
	 */
	public function set_addon_slug( string $addon_slug ): Addon {
		$this->addon_slug = $addon_slug;
		return $this;
	}

	/**
	 * Set addon template.
	 *
	 * @since 1.0
	 */
	public function set_template( string $template ): Addon {
		$this->template = $template;
		return $this;
	}

	/**
	 * Set addon config.
	 *
	 * @since 1.0
	 */
	public function set_config( array $config ): Addon {
		$this->config = $config;
		return $this;
	}

	/**
	 * Set addon base dir.
	 *
	 * @since 1.0
	 */
	public function set_addon_base_dir( string $base_dir ): Addon {
		$this->base_dir = $base_dir;
		return $this;
	}

	/**
	 * Render addon.
	 *
	 * @since 1.0
	 */
	public function render_addon( array $atts ): string {
		$addon = $this;
		$atts  = apply_filters( 'joywp_testimonials_atts_render_addon', $atts, $addon );

		$addon->atts = $atts;
		$addon->id   = uniqid( $addon->addon_slug . '-' );

		$addon->enqueue_addon_assets();

		ob_start();
		$output = require_once $addon->template;
		if ( 1 === $output ) {
			$output = ob_get_contents();
		}
		ob_end_clean();

		return apply_filters( 'joywp_testimonials_render_addon_output', $output, $addon );
	}

	/**
	 * Get path to addon asset.
	 *
	 * @since 1.0
	 */
	public function get_addon_asset_path( string $file_path ): string {
		return $this->base_dir . '/' . $file_path;
	}

	/**
	 * Enqueue addon dependency assets.
	 * Assets can be inner and external.
	 *
	 * @since 1.0
	 */
	public function enqueue_addon_assets(): void {
		if ( empty( $this->config['assets'] ) ) {
			return;
		}

		$this->enqueue_addon_inner_assets( $this->config['assets'] );
		$this->enqueue_addon_external_assets( $this->config['assets'] );
	}

	/**
	 * Enqueue addon dependency inner assets.
	 *
	 * @since 1.0
	 */
	public function enqueue_addon_inner_assets( array $assets ): void {
		if ( empty( $assets['inner'] ) ) {
			return;
		}

		foreach ( $assets['inner'] as $type => $assets_data ) {
			if ( empty( $assets_data['file'] ) ) {
				continue;
			}

			$this->enqueue_single_inner_asset( $type, $assets_data );
		}
	}

	/**
	 * Enqueue addon dependency external assets.
	 *
	 * @since 1.0
	 */
	public function enqueue_addon_external_assets( array $assets ): void {
		if ( empty( $assets['external'] ) ) {
			return;
		}

		foreach ( $assets['external'] as $type => $assets_data ) {
			if ( empty( $assets_data['url'] ) ) {
				continue;
			}

			$this->enqueue_single_external_asset( $type, $assets_data );
		}
	}

	/**
	 * Enqueue single external addon asset.
	 *
	 * @since 1.0
	 */
	public function enqueue_single_external_asset( string $type, array $asset ): void {
		$options    = $this->extract_asset_options( $asset );
		$asset_name = $this->external_assets_prefix . '-' . $asset['url'];

		if ( 'js' === $type ) {
			wp_enqueue_script( $asset_name, $asset['url'], $options['deps'], JOYWPTESTIMONIALSWPB_VERSION, $options['args'] );
		} elseif ( 'css' === $type ) {
			wp_enqueue_style( $asset_name, $asset['url'], $options['deps'], JOYWPTESTIMONIALSWPB_VERSION, $options['media'] );
		}
	}

	/**
	 * Enqueue single inner addon asset.
	 *
	 * @since 1.0
	 */
	public function enqueue_single_inner_asset( string $type, array $asset ): void {
		$path = $this->get_addon_asset_path( $asset['file'] );
		if ( ! file_exists( $path ) ) {
			return;
		}

		$options = $this->extract_asset_options( $asset );
		$url     = joywptestimonialswpb_convert_path_to_uri( $path );

		$asset_name = $this->addon_slug . '-' . $asset['file'];

		if ( 'js' === $type ) {
			wp_enqueue_script( $asset_name, $url, $options['deps'], JOYWPTESTIMONIALSWPB_VERSION, $options['args'] );
		} elseif ( 'css' === $type ) {
			wp_enqueue_style( $asset_name, $url, $options['deps'], JOYWPTESTIMONIALSWPB_VERSION, $options['media'] );
		}
	}

	/**
	 * Extract asset enqueue arguments from the shortcode configuration settings
	 *
	 * @since 1.0
	 */
	private function extract_asset_options( array $asset ): array {
		return [
			'deps'  => $asset['deps'] ?? [],
			'args'  => $asset['args'] ?? [],
			'media' => $asset['media'] ?? 'all',
		];
	}

	/**
	 * Get data attribute id.
	 *
	 * @since 1.0
	 */
	public function get_data_attribute_id(): string {
		return 'data-' . JOYWPTESTIMONIALSWPB_PLUGIN_SLUG . '-shortcode-id';
	}

	/**
	 * Output uniq id with data attribute that we can use in our styles.
	 *
	 * @since 1.0
	 */
	public function output_style_shortcode_id(): void {
		echo '[' . esc_attr( $this->get_data_attribute_id() ) . '="' . esc_attr( $this->id ) . '"]';
	}
}
