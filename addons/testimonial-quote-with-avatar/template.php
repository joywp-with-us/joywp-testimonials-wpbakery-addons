<?php
/**
 * The template for displaying testimonial-quote-with-avatar output.
 *
 * @since 1.0
 * @var array $atts
 * @var JoywpTestimonialsWpb\Addons\AbstractAddon $addon
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="joywp-testimonial-quote-with-avatar-wrapper">
	<figure class="joywp-testimonial-quote-with-avatar-unit" role="group" aria-label="Testimonial">
		<div class="joywp-testimonial-quote-with-avatar-quote" role="note" aria-label="Testimonial quote">
			<div class="joywp-testimonial-quote-with-avatar-quote-text">
				<?php
				echo wp_kses_post( $atts['testimonial'] );
				?>
			</div>
			<?php
			if ( 'true' === $atts['add_quotes'] ) :
				?>
				<span class="joywp-testimonial-quote-with-avatar-quote-mark joywp-testimonial-quote-with-avatar-quote-mark-start" aria-hidden="true">“</span>
				<span class="joywp-testimonial-quote-with-avatar-quote-mark joywp-testimonial-quote-with-avatar-quote-mark-end" aria-hidden="true">”</span>
				<?php
			endif;
			?>
			<?php
			if ( 'true' === $atts['add_pointer'] ) :
				?>
				<div class="joywp-testimonial-quote-with-avatar-arrow" aria-hidden="true"></div>
				<?php
			endif;
			?>
		</div>
		<div class="joywp-testimonial-quote-with-avatar-footer">
			<?php
			if ( 'true' === $atts['add_image'] ) :
				?>
				<div class="joywp-testimonial-quote-with-avatar-avatar">
					<?php
					$addon->output_integrated_addon( 'vc_single_image', $atts );
					?>
				</div>
				<?php
			endif;
			?>
			<div class="joywp-testimonial-quote-with-avatar-author" aria-label="Author">
				<div class="joywp-testimonial-quote-with-avatar-author-name">
					<?php
						echo wp_kses_post( $atts['name'] )
					?>
				</div>
			</div>
		</div>
	</figure>
</div>

<style>
	<?php $addon->output_style_shortcode_id(); ?> .joywp-testimonial-quote-with-avatar-quote {
		background-color: <?php echo esc_attr( $atts['testimonial_background'] ); ?>;
		<?php
		if ( 'true' === $atts['add_border'] ) :
			?>
				border-width: <?php echo esc_attr( $atts['border_width'] ); ?>px;
				border-style: <?php echo esc_attr( $atts['border_style'] ); ?>;
				border-color: <?php echo esc_attr( $atts['border_color'] ); ?>;
				border-radius: <?php echo esc_attr( $atts['border_radius'] ); ?>px;
			<?php
		endif;
		?>
	}
	<?php $addon->output_style_shortcode_id(); ?> .joywp-testimonial-quote-with-avatar-wrapper {
		max-width: <?php echo esc_attr( $atts['width'] ); ?>%;
	}
	<?php
	if ( 'true' === $atts['add_quotes'] ) :
		$addon->output_style_shortcode_id();
		?>
		.joywp-testimonial-quote-with-avatar-quote-mark {
			font-size: <?php echo esc_attr( $atts['quotes_size'] ); ?>px;
			color: <?php echo esc_attr( $atts['quotes_color'] ); ?>;
			font-family: <?php echo esc_attr( $atts['font_family'] ); ?>;
		}
		<?php
	endif;
	$addon->output_style_shortcode_id();
	?>
	.joywp-testimonial-quote-with-avatar-footer {
		margin-top: <?php echo esc_attr( $atts['gap'] ); ?>px;
	}
	<?php
	if ( 'true' === $atts['add_pointer'] ) :
		$addon->output_style_shortcode_id();
		?>
		.joywp-testimonial-quote-with-avatar-arrow {
			left: <?php echo esc_attr( $atts['pointer_position'] ); ?>%;
			border-right: <?php echo esc_attr( $atts['pointer_size'] ); ?>px solid transparent;
			border-top: <?php echo esc_attr( $atts['pointer_size'] ); ?>px solid <?php echo esc_attr( $atts['pointer_color'] ); ?>;
		}
		<?php
	endif;
	?>
</style>

<style>
	.joywp-testimonial-quote-with-avatar-wrapper{
		overflow: hidden;
		display:flex;
		flex-wrap:wrap;
		max-width:100%;
	}

	.joywp-testimonial-quote-with-avatar-unit {
		width:100%;
	}

	.joywp-testimonial-quote-with-avatar-unit,
	.joywp-testimonial-quote-with-avatar-unit *{
		box-sizing:border-box;
		transition:all 0.35s cubic-bezier(0.25, 0.5, 0.5, 0.9);
	}

	/* Quote */
	.joywp-testimonial-quote-with-avatar-quote{
		position:relative;
		padding:25px 50px 30px;
	}

	.joywp-testimonial-quote-with-avatar-quote-text{
		position:relative;
		z-index:1;
	}

	.joywp-testimonial-quote-with-avatar-quote-mark{
		position:absolute;
		z-index:0;
	}

	.joywp-testimonial-quote-with-avatar-quote-mark-start{
		top:25px;
		left:20px;
	}

	.joywp-testimonial-quote-with-avatar-quote-mark-end{
		right:20px;
		bottom:0;
	}

	.joywp-testimonial-quote-with-avatar-arrow{
		position:absolute;
		top:100%;
		width:0;
		height:0;
	}

	.joywp-testimonial-quote-with-avatar-footer{
		display:flex;
		gap:20px;
		padding-left:10px;
		flex-wrap:wrap;
	}

	/* Avatar */
	.joywp-testimonial-quote-with-avatar-avatar{
		border-radius:50%;
		flex-shrink:0;
	}

	/* Author */
	.joywp-testimonial-quote-with-avatar-author{
		flex:1 1 auto;
	}

	/* Responsive */
	@media (max-width:360px){
		.joywp-testimonial-quote-with-avatar-quote{
			padding:18px;
		}

		.joywp-testimonial-quote-with-avatar-avatar{
			width:72px;
			height:72px;
		}

		.joywp-testimonial-quote-with-avatar-footer{
			gap:12px;
		}

		.joywp-testimonial-quote-with-avatar-quote-mark-start{
			top:14px;
			left:12px;
		}

		.joywp-testimonial-quote-with-avatar-quote-mark-end{
			right:12px;
		}
	}
</style>
