<?php
/**
 * Addon bootstrapper.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb;

defined( 'ABSPATH' ) || exit;

/**
 * Bootstrap addon.
 *
 * @since 1.0
 */
abstract class AbstractBuilderBootstrapper {
	/**
	 * Bootstrap builder.
	 *
	 * @since 1.0
	 */
	abstract public function bootstrap(): void;
}
