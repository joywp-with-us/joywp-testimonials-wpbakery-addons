<?php
/**
 * Addons templates manager.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons;

defined( 'ABSPATH' ) || exit;

/**
 * Class manage addons template file.
 *
 * @since 1.0
 */
class TemplateManager {
	/**
	 * Get initial template file.
	 *
	 * @since 1.0
	 */
	public function validate( string $template_path ): string {
		if ( ! is_readable( $template_path ) ) {
			function_exists( 'wp_trigger_error' ) && wp_trigger_error( 'JoywpTestimonialsWpb\Addons\Builders\Wpbakery\TemplateManager::validate', 'Failed to read template file ' . $template_path, E_USER_WARNING );
			return '';
		}

		return $template_path;
	}
}
