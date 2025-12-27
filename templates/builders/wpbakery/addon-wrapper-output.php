<?php
/**
 * The template for wpbakery addon wrapper output.
 *
 * @var string $output
 * @var \JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Addon $addon
 * @var string $element_class
 * @since 1.0
 */

?>

<div <?php $addon->output_addon_wrapper_attributes( [ 'class' => $element_class ] ); ?>>
	<?php echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div>
