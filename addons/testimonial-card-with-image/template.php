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
	<figure class="joywp-quote-card joywp-color-text-dark">
		<div class="joywp-quote-text joywp-color-bg-light">
			Sometimes I think the surest sign that intelligent life exists elsewhere in the universe is that none of it has tried to contact us.
			<div class="joywp-quote-arrow joywp-border-top-light"></div>
		</div>
		<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample3.jpg" alt="sample3">
		<div class="joywp-quote-author joywp-color-bg-light joywp-color-text-black">
			<div>Pelican Steve <span>- LittleThemes</span></div>
		</div>
	</figure>
</div>

<style>
	.joywp-color-bg-light { background-color: #ffffff; }
	.joywp-color-text-dark { color: #333333; }
	.joywp-color-text-black { color: #000000; }

	.joywp-border-top-light { border-top-color: #ffffff; }

	/* -----------------------------------
	ELEMENT
	----------------------------------- */
	.joywp-quote-card {
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

	.joywp-quote-card * {
		box-sizing: border-box;
		transition: all 0.35s cubic-bezier(0.25, 0.5, 0.5, 0.9);
	}

	.joywp-quote-card img {
		max-width: 100%;
		height: auto;
		display: block;
	}

	.joywp-quote-text {
		position: relative;
		padding: 25px 50px;
		font-size: 0.8em;
		font-weight: 500;
		line-height: 1.6em;
		font-style: italic;
	}

	.joywp-quote-text::before,
	.joywp-quote-text::after {
		font-family: 'FontAwesome';
		font-style: normal;
		font-size: 50px;
		opacity: 0.3;
		position: absolute;
		pointer-events: none;
	}

	.joywp-quote-text::before {
		content: "\201C";
		top: 25px;
		left: 20px;
	}

	.joywp-quote-text::after {
		content: "\201D";
		right: 20px;
		bottom: 0;
	}

	.joywp-quote-arrow {
		top: 100%;
		width: 0;
		height: 0;
		border-left: 0 solid transparent;
		border-right: 25px solid transparent;
		border-top: 25px solid;
		position: absolute;
	}

	.joywp-quote-author {
		position: absolute;
		bottom: 0;
		width: 100%;
		padding: 5px 25px;
		text-transform: uppercase;
	}

	.joywp-quote-author div {
		opacity: 0.8;
		font-weight: 800;
	}

	.joywp-quote-author div span {
		font-weight: 400;
		text-transform: none;
		padding-left: 5px;
	}
</style>
