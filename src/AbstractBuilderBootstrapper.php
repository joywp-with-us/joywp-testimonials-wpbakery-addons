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
	 * Builder slug.
	 *
	 * @since 1.0
	 */
	public string $builder_slug;

	/**
	 * Constructor.
	 *
	 * @since 1.0
	 */
	public function __construct( string $builder_slug ) {
		$this->builder_slug = $builder_slug;
	}

	/**
	 * Bootstrap builder.
	 *
	 * @since 1.0
	 */
	abstract public function bootstrap(): void;
}
