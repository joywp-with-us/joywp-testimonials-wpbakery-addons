<?php
/**
 * Collect addons configuration from different subdirectories.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons;

defined( 'ABSPATH' ) || exit;

/**
 * Addons Collector.
 *
 * @since 1.0
 */
class Collector {
	/**
	 * Entry point to collect addon's configuration.
	 *
	 * @since 1.0
	 */
	public function collect(): array {
		$dir_list = $this->get_dir_collector_list();

		$addons = [];

		foreach ( $dir_list as $dir_path ) {
			if ( ! is_dir( $dir_path ) ) {
				continue;
			}

			$addons = $this->get_addons_from_dir( $dir_path, $addons );
		}

		/**
		 * Filter whole plugin addons list.
		 *
		 * @since 1.0
		 */
		return (array) apply_filters( 'joywp_testimonials_addons', $addons );
	}

	/**
	 * Get list of directories where addons are located.
	 *
	 * @note we prioritize directories in the list from top to bottom
	 * So first folder has the highest priority
	 *
	 * @since 1.0
	 */
	public function get_dir_collector_list(): array {
		/**
		 * Filter addons directories sequence loader list.
		 *
		 * Here theme or plugin authors can add their own addons or override existing ones.
		 *
		 * @since 1.0
		 */
		return (array) apply_filters(
			'joywp_testimonials_addons_collector_dir_list',
			[
				get_stylesheet_directory() . '/joywp-testimonials-wpbakery-addons/addons',
				JOYWPTESTIMONIALSWPB_URI_ABSPATH . 'addons',
			]
		);
	}

	/**
	 * Get addons from a specific directory.
	 *
	 * @since 1.0
	 */
	public function get_addons_from_dir( string $dir_path, array $addons ): array {
		$addons_folder_list = glob( $dir_path . '/*', GLOB_ONLYDIR );

		foreach ( $addons_folder_list as $addon_folder ) {
			$addon_name = basename( $addon_folder );
			if ( isset( $addons[ $addon_name ] ) ) {
				continue;
			}

			$config_path = $addon_folder . '/' . $this->get_config_file_name( $addon_name, $addon_folder );
			if ( ! file_exists( $config_path ) ) {
				// no config no addon it a rule.
				continue;
			}

			$addons[ $addon_name ]['base_dir'] = $addon_folder;

			$addons[ $addon_name ]['config'] = $config_path;
		}

		return $addons;
	}

	/**
	 * Get config file name.
	 *
	 * @since 1.0
	 */
	public function get_config_file_name( string $addon_name, string $addon_folder ): string {
		/**
		 * Filter default config.json file name for a specific addon.
		 *
		 * @since 1.0
		 */
		return (string) apply_filters(
			'joywp_testimonials_addon_config_file_name',
			'config.json',
			$addon_name,
			$addon_folder
		);
	}
}
