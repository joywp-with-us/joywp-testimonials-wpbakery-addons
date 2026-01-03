<?php
/**
 * The template for displaying testimonial-card-with-image output.
 *
 * @since 1.0
 * @var array $atts
 * @var JoywpTestimonialsWpb\Addons\AbstractAddon $addon
 */

?>

<div>
	<figure class="joywp-testimonial-card-with-image-quote-card">
		<div class="joywp-testimonial-card-with-image-quote-text joywp-testimonial-card-with-image-color-bg-light">
			<?php echo wp_kses_post( $atts['testimonial'] ); ?>
			<div class="joywp-testimonial-card-with-image-quote-arrow"></div>
		</div>
		<?php
		if ( 'true' === $atts['add_image'] ) :
			?>
			<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample3.jpg" alt="sample3">
			<?php
		endif;
		if ( 'true' === $atts['add_name'] ) :
			?>
			<div class="joywp-testimonial-card-with-image-quote-author joywp-testimonial-card-with-image-name-block-color-bg">
				<div>
					<?php echo wp_kses_post( $atts['name'] ); ?>
				</div>
			</div>
			<?php
		endif;
		?>
	</figure>
</div>

<style>
	<?php
	if ( 'true' === $atts['add_quotes'] ) {
		$addon->output_style_shortcode_id();
		?>
		.joywp-testimonial-card-with-image-quote-text::before,
		.joywp-testimonial-card-with-image-quote-text::after {
			font-family: 'FontAwesome';
			font-size: <?php echo esc_attr( $atts['quotes_size'] ); ?>px;
			opacity: 0.3;
			position: absolute;
			pointer-events: none;
		}
		<?php $addon->output_style_shortcode_id(); ?> .joywp-testimonial-card-with-image-quote-text::before {
			content: "\201C";
			top: 25px;
			left: 20px;
		}
		<?php $addon->output_style_shortcode_id(); ?> .joywp-testimonial-card-with-image-quote-text::after {
			content: "\201D";
			right: 20px;
			bottom: 0;
		}
		<?php
	}

	$addon->output_style_shortcode_id();
	?>
	.joywp-testimonial-card-with-image-name-block-color-bg {
		background-color: <?php echo esc_attr( $atts['name_block_background'] ?: '#ffffff' ); ?>;
	}

	/* -----------------------------------
	ELEMENT
	----------------------------------- */
	.joywp-testimonial-card-with-image-quote-card {
		position: relative;
		overflow: hidden;
		max-width: 310px;
		width: 100%;
		text-align: left;
		box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
		border-radius: 8px;
		display: flex;
		flex-direction: column;
		margin: 10px;
	}

	.joywp-testimonial-card-with-image-quote-card * {
		box-sizing: border-box;
		transition: all 0.35s cubic-bezier(0.25, 0.5, 0.5, 0.9);
	}

	.joywp-testimonial-card-with-image-quote-card img {
		max-width: 100%;
		height: auto;
		display: block;
	}

	.joywp-testimonial-card-with-image-quote-text {
		position: relative;
		padding: 25px 50px;
		font-size: 0.8em;
		font-weight: 500;
		line-height: 1.6em;
		font-style: italic;
	}

	.joywp-testimonial-card-with-image-quote-arrow {
		top: 100%;
		width: 0;
		height: 0;
		border-left: 0 solid transparent;
		border-right: 25px solid transparent;
		border-top: 25px solid;
		position: absolute;
	}

	.joywp-testimonial-card-with-image-quote-author {
		position: absolute;
		bottom: 0;
		width: 100%;
		padding: 5px 25px;
	}
</style>
