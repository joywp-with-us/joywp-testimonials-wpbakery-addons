<?php
/**
 * The template for displaying testimonial-card-with-image output.
 *
 * @since 1.0
 * @var array $atts
 * @var JoywpTestimonialsWpb\Addons\Builders\Wpbakery\Addon\Addon $_this
 */

?>

<div>
	<figure class="joywp-testimonial-card-with-image-quote-card joywp-testimonial-card-with-image-color-text-dark">
		<div class="joywp-testimonial-card-with-image-quote-text joywp-testimonial-card-with-image-color-bg-light">
            <?php echo wp_kses_post( $atts['testimonial'] ); ?>
			<div class="joywp-testimonial-card-with-image-quote-arrow joywp-testimonial-card-with-image-border-top-light"></div>
		</div>
		<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample3.jpg" alt="sample3">
		<div class="joywp-testimonial-card-with-image-quote-author joywp-testimonial-card-with-image-color-bg-light joywp-testimonial-card-with-image-color-text-black">
			<div>
                <?php echo esc_html( $atts['name'] ); ?>
                <span>
                    <?php echo esc_html( $atts['surname'] ); ?>
                </span>
            </div>
		</div>
	</figure>
</div>

<style>
	.joywp-testimonial-card-with-image-color-bg-light { background-color: #ffffff; }
	.joywp-testimonial-card-with-image-color-text-dark { color: #333333; }
	.joywp-testimonial-card-with-image-color-text-black { color: #000000; }

	.joywp-testimonial-card-with-image-border-top-light { border-top-color: #ffffff; }

	/* -----------------------------------
	ELEMENT
	----------------------------------- */
	.joywp-testimonial-card-with-image-quote-card {
		font-family: 'Raleway', Arial, sans-serif;
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

	.joywp-testimonial-card-with-image-quote-text::before,
	.joywp-testimonial-card-with-image-quote-text::after {
		font-family: 'FontAwesome';
		font-style: normal;
		font-size: 50px;
		opacity: 0.3;
		position: absolute;
		pointer-events: none;
	}

	.joywp-testimonial-card-with-image-quote-text::before {
		content: "\201C";
		top: 25px;
		left: 20px;
	}

	.joywp-testimonial-card-with-image-quote-text::after {
		content: "\201D";
		right: 20px;
		bottom: 0;
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
		text-transform: uppercase;
	}

	.joywp-testimonial-card-with-image-quote-author div {
		opacity: 0.8;
		font-weight: 800;
	}

	.joywp-testimonial-card-with-image-quote-author div span {
		font-weight: 400;
		text-transform: none;
		padding-left: 5px;
	}
</style>
