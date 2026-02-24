<?php
/**
 * Abstract addon collection class.
 *
 * @since 1.0
 */

namespace JoywpTestimonialsWpb\Addons;

defined( 'ABSPATH' ) || exit;

/**
 * Class AbstractAddonCollection
 * We call 'Collection' specific
 * addon property that we can separate to collection (e.g., Border, Box Shadow, Image, etc.).
 *
 * @since 1.0
 */
abstract class AbstractAddonCollection {
	/**
	 * The collection instance.
	 *
	 * @since 1.0
	 */
	public AbstractCollection $collection;

	/**
	 * The addon instance.
	 *
	 * @since 1.0
	 */
	protected AbstractAddon $addon;

	/**
	 * AbstractAddonCollection constructor.
	 *
	 * @since 1.0
	 */
	public function __construct( AbstractCollection $collection ) {
		$this->collection = $collection;
	}

	/**
	 * Set addon instance.
	 *
	 * @since 1.0
	 */
	public function set_addon( AbstractAddon $addon ): void {
		$this->addon = $addon;
	}

	/**
	 * Render collection output.
	 *
	 * @since 1.0
	 */
	public function is_witcher_on( array $atts ): bool {
		$switcher_slug = $this->collection->get_switcher_slug();
		return isset( $atts[ $switcher_slug ] ) && 'true' === $atts[ $switcher_slug ];
	}

	/**
	 * Render collection output.
	 *
	 * @since 1.0
	 */
	public function render( array $atts ): void {
		if ( ! $this->is_witcher_on( $atts ) ) {
			return;
		}

        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $this->get_render_output( $atts ); // on this step everything escaped already.
	}

	/**
	 * Get render collection output.
	 *
	 * @since 1.0
	 */
	public function get_render_output( array $atts ): string { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.Found
		return '';
	}
}
