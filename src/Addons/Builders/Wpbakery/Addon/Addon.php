<?php
/**
 * Wpbakery addon.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon;

use WPBakeryShortCode;

defined( 'ABSPATH' ) || exit;

/**
 * Wpbakery Addon class.
 *
 * @since 1.0
 */
class Addon {
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
	 * Addon attributes.
	 *
	 * Attributes - options values
	 * that use can pass when edit addon.
	 *
	 * @since 1.0
	 */
	public array $addon_atts;

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
	 * Addon manager class instance.
	 *
	 * @since 1.0
	 */
	public WPBakeryShortCode $addon_manager;

	/**
	 * External assets prefix.
	 *
	 * @since 1.0
	 */
	public string $external_assets_prefix = 'joywp';

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
	 * Set WPBakeryShortCode.
	 *
	 * @since 1.0
	 */
	public function set_addon_manager( WPBakeryShortCode $addon_manager ): Addon {
		$this->addon_manager = $addon_manager;
		return $this;
	}

	/**
	 * Addon initialization.
	 *
	 * @since 1.0
	 */
	public function init_addon(): void {
		add_shortcode( $this->addon_slug, [ $this, 'render_addon' ] );
	}

	/**
	 * Render addon.
	 *
	 * @since 1.0
	 */
	public function render_addon( array $atts ): string {
		$this->addon_atts = $atts;

		$atts = vc_map_get_attributes( $this->addon_manager->getShortcode(), $atts );

		$this->id = uniqid( $this->addon_slug . '-' );

		$this->enqueue_addon_assets();

		ob_start();
		$output = require_once $this->template;
		if ( 1 === $output ) {
			$output = ob_get_contents();
		}
		ob_end_clean();

		return $output;
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
	 * Here we combine initial markup attributes that has our addon wrapper
	 * with all attributes that should contain regular addon
	 * and output them escaped and ready to use in our addon wrapper.
	 *
	 * @param array $initial_markup_atts wrapper attributes that has our initial addon markup.
	 * @since 1.0
	 */
	public function output_addon_wrapper_attributes( array $initial_markup_atts = [] ): void {
		$classes = $this->get_wrapper_classes( $initial_markup_atts );

		unset( $initial_markup_atts['class'] );
		$addon_wrapper_attributes['class']                          = $classes;
		$addon_wrapper_attributes['id']                             = empty( $this->addon_atts['el_id'] ) ? [] : $this->addon_atts['el_id'];
		$addon_wrapper_attributes[ $this->get_data_attribute_id() ] = $this->id;

		$addon_wrapper_attributes = array_merge( $addon_wrapper_attributes, $initial_markup_atts );

		foreach ( $addon_wrapper_attributes as $name => $value ) {
			if ( ! empty( $value ) ) {
				echo ' ' . esc_attr( $name ) . '="' . esc_attr( $value ) . '"';
			}
		}
	}

	/**
	 * Get data attribute id.
	 *
	 * @since 1.0
	 */
	public function get_data_attribute_id(): string {
		return 'data-joywp-addon-id';
	}

	/**
	 * Get classes for addon wrapper.
	 *
	 * @param array $initial_markup_atts wrapper attributes that has our initial addon markup.
	 * @since 1.0
	 */
	public function get_wrapper_classes( array $initial_markup_atts ): string {
		$classes  = empty( $this->addon_atts['css'] ) ? '' : vc_shortcode_custom_css_class( $this->addon_atts['css'], ' ' );
		$classes .= empty( $this->addon_atts['el_class'] ) ? '' : $this->addon_manager->getExtraClass( $this->addon_atts['el_class'] );
		$classes .= empty( $this->addon_atts['css_animation'] ) ? '' : $this->addon_manager->getCSSAnimation( $this->addon_atts['css_animation'] );
		$classes .= empty( $initial_markup_atts['class'] ) ? '' : ' ' . $initial_markup_atts['class'];

		return $classes;
	}

	/**
	 * Output uniq id with data attribute that we can use in our styles.
	 *
	 * @since 1.0
	 */
	public function output_style_addon_id(): void {
		echo '[' . esc_attr( $this->get_data_attribute_id() ) . '="' . esc_attr( $this->id ) . '"]';
	}

	/**
	 * We use it when want to get output template addon shortcode
	 * that was already integrated in current addon.
	 *
	 * @param string $integrated_prefix we use this prefix to find integrated shortcode atts,
	 * that contains our current shortcode atts.
	 *
	 * @since 1.0
	 */
	public function get_integrated_shortcode_output( array $atts, string $integrated_slug, string $integrated_prefix ): string {
		$data = vc_map_integrate_parse_atts( $this->addon_slug, $integrated_slug, $atts, $integrated_prefix );
		if ( $data ) {
			$integrated_shortcode = vc_manager()->vc()->getShortCode( 'vc_icon' );
			if ( is_object( $integrated_shortcode ) ) {
				return $integrated_shortcode->render( array_filter( $data ) );
			}
		}

		return '';
	}

	/**
	 * We have a set of libs that help us work with addon attributes.
	 * To access them we use this method.
	 *
	 * @since 1.0
	 */
	public function get_atts_lib( string $lib_name ): object {
		$lib_name  = str_replace( '-', '', ucwords( $lib_name, '-' ) );
		$lib_class = 'JoywpWpbTimeline\\Shortcodes\\ShortcodeAttsLib\\' . $lib_name;

		return new $lib_class();
	}
}
