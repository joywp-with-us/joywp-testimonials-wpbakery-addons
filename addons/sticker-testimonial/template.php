<?php
/**
 * The template for displaying joywp-sticker-testimonial addon output.
 *
 * @since 1.0
 * @var array $atts
 * @var JoywpTestimonialsWpb\Addons\AbstractAddon $addon
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="joywp-sticker-testimonial-wrapper">
    <div class="joywp-sticker-testimonial" role="figure" aria-label="Testimonial">
        <span class="joywp-sticker-testimonial__quote joywp-sticker-testimonial__quote--open" aria-hidden="true">"</span>
        <div class="joywp-sticker-testimonial__image" aria-hidden="true">
            <div class="joywp-sticker-testimonial__clip"></div>
            <img src="https://placehold.co/100" alt="Testimonial author photo">
        </div>
        <div class="joywp-sticker-testimonial__text">
            <?php
            echo wp_kses_post( $atts['testimonial'] );
            ?>
        </div>
        <div class="joywp-sticker-testimonial__source">
            <div class="joywp-sticker-testimonial__source-label">
                Testimonial Source
        <span class="joywp-sticker-testimonial__quote joywp-sticker-testimonial__quote--close" aria-hidden="true">"</span>
            </div>
        </div>
    </div>
</div>

<style>
    .joywp-sticker-testimonial-wrapper *,
    .joywp-sticker-testimonial-wrapper *::before,
    .joywp-sticker-testimonial-wrapper *::after {
        box-sizing: border-box;
        font-family: "Montserrat", sans-serif;
    }

    .joywp-sticker-testimonial-wrapper {
        --border-overflow: 30px;
        --border-width: 8px;
        --border-radius: 50px;
        --triangle-height: 70px;

        padding-top: var(--border-overflow);
        padding-bottom: calc(var(--border-overflow) + var(--triangle-height));

        container-type: inline-size;
    }

    .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial {
        width: 100%;
        background: #ffca52;

        padding: 4em 3em;
        position: relative;
        display: flex;
        align-items: flex-end;
        flex-wrap: wrap;

        box-shadow: 0 2px 2px hsl(0deg 0% 0% / 0.075),
        0 3px 3px hsl(0deg 0% 0% / 0.075),
        0 5px 5px hsl(0deg 0% 0% / 0.075),
        0 9px 9px hsl(0deg 0% 0% / 0.075),
        0 17px 17px hsl(0deg 0% 0% / 0.075);
    }

    .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial::after {
        content: "";

        border: var(--border-width) solid navy;
        border-radius: var(--border-radius);

        height: calc(100% + var(--border-overflow) * 2);
        width: 90%;

        top: calc(0px - var(--border-overflow));
        left: 5%;

        position: absolute;
        z-index: -1;
    }

    .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial::before {
        content: "";

        position: absolute;
        top: calc(100% + var(--border-overflow));
        left: calc(10% + var(--border-radius));

        z-index: 1;
        width: 0;
        height: 0;

        border-style: solid;
        border-width: var(--triangle-height) min(calc(var(--triangle-height) * 3 / 2), 40cqw) 0 0;
        border-color: navy transparent transparent transparent;
    }

    .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__quote {
        position: absolute;
        font-size: 3em;
        width: 40px;
        height: 40px;
        background: navy;
        color: #fff;
        text-align: center;
        line-height: 1.25;
    }

    .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__quote--open {
        top: 0;
        left: 0;
    }

    .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__quote--close {
        bottom: 0;
        right: 0;
    }

    .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__text {
        width: 60%;
        min-width: 3ch;
        display: inline-block;
    }

    .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__source {
        width: 40%;
        height: 100%;
        position: relative;
    }

    .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__source-label {
        display: inline-block;
        position: relative;
        font-weight: bold;
        font-size: 1.15em;
        margin-left: 1rem;
        text-align: right;
    }

    .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__source-label::before {
        content: "\2014";
        display: inline;
        margin-right: 5px;
    }

    .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__image {
        transform: rotate(-5deg);
        position: absolute;
        top: 0.5em;
        right: 1.5em;
    }

    .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__image img {
        border: 10px solid #fff;
        margin: 0;
        padding: 0;
        display: block;
    }

    .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__clip {
        border: 2px solid #222;
        border-right: none;
        height: 75px;
        width: 20px;
        position: absolute;
        right: 30%;
        top: -15%;
        border-radius: 25px;
    }

    .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__clip::before {
        content: "";
        position: absolute;
        top: -1px;
        right: 0;
        height: 10px;
        width: 16px;
        border: 2px solid #222;
        border-bottom: none;
        border-top-left-radius: 25px;
        border-top-right-radius: 25px;
        z-index: 99;
    }

    .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__clip::after {
        content: "";
        position: absolute;
        bottom: -1px;
        right: 0;
        height: 40px;
        width: 16px;
        border: 2px solid #222;
        border-top: none;
        border-bottom-left-radius: 25px;
        border-bottom-right-radius: 25px;
        z-index: 99;
    }

    @container (max-width: 450px) {
        .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial {
            --triangle-height: 40px;
            --border-radius: 20px;

            padding: 100px 1em 3.5em 1em;
            flex-direction: column;
            align-items: flex-start;
        }

        .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__image {
            transform-origin: top right;
            transform: scale(0.7) translateX(0.5em) rotate(-5deg);
        }

        .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__clip {
            top: -20%;
        }

        .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__text {
            word-break: break-all;
        }

        .joywp-sticker-testimonial-wrapper .joywp-sticker-testimonial__source-label {
            margin-left: 0;
            margin-top: 1em;
            font-size: 0.9em;
            text-align: left;
            word-break: break-all;
        }
    }
</style>
