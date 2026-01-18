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
                Thank you. before I begin, I'd like everyone to notice that my report is in a professional, clear plastic binder...When a report looks this good, you know it'll get an A. That's a tip kids. Write it down.
            </div>

            <span class="joywp-testimonial-quote-with-avatar-quote-mark joywp-testimonial-quote-with-avatar-quote-mark-start" aria-hidden="true">“</span>
            <span class="joywp-testimonial-quote-with-avatar-quote-mark joywp-testimonial-quote-with-avatar-quote-mark-end" aria-hidden="true">”</span>

            <div class="joywp-testimonial-quote-with-avatar-arrow" aria-hidden="true"></div>
        </div>

        <img
                class="joywp-testimonial-quote-with-avatar-avatar"
                src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sq-sample17.jpg"
                alt="Portrait of Eleanor Faint"
                loading="lazy"
        />

        <div class="joywp-testimonial-quote-with-avatar-author" aria-label="Author">
            <div class="joywp-testimonial-quote-with-avatar-author-name">Eleanor Faint</div>
            <div class="joywp-testimonial-quote-with-avatar-author-meta">LIttleSnippets.net</div>
        </div>
    </figure>
</div>

<style>
    /* Wrapper: no padding/margin/background here */
    .joywp-testimonial-quote-with-avatar-wrapper{
        display:flex;
        flex-wrap:wrap;
        align-items:flex-start;
        justify-content:flex-start;
        max-width:100%;
    }

    .joywp-testimonial-quote-with-avatar-unit{
        font-family: Arial, sans-serif;
        position:relative;
        overflow:hidden;
        width:100%;
        color:#333333;
        text-align:left;
        box-shadow:none !important;
    }

    .joywp-testimonial-quote-with-avatar-unit .joywp-testimonial-quote-with-avatar-unit,
    .joywp-testimonial-quote-with-avatar-unit *{
        -webkit-box-sizing:border-box;
        box-sizing:border-box;
        -webkit-transition:all 0.35s cubic-bezier(0.25, 0.5, 0.5, 0.9);
        transition:all 0.35s cubic-bezier(0.25, 0.5, 0.5, 0.9);
    }

    .joywp-testimonial-quote-with-avatar-avatar{
        display:block;
        max-width:100%;
        vertical-align:middle;
        height:90px;
        width:90px;
        border-radius:50%;
        margin-top:40px;
        margin-left:10px;
    }

    .joywp-testimonial-quote-with-avatar-quote{
        display:block;
        border-radius:8px;
        position:relative;
        background-color:#fafafa;
        padding:25px 50px 30px 50px;
        font-size:0.8em;
        font-weight:500;
        line-height:1.6em;
        font-style:italic;
        max-width:100%;
    }

    .joywp-testimonial-quote-with-avatar-quote-text{
        position:relative;
        z-index:1;
        word-break:break-word;
        overflow-wrap:break-word;
    }

    /* No pseudo-elements for quote marks; real elements so values are markup-regulated */
    .joywp-testimonial-quote-with-avatar-quote-mark{
        position:absolute;
        font-size:50px;
        opacity:0.3;
        font-style:normal;
        line-height:1;
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
        left:45px;
        width:0;
        height:0;
        border-left:0 solid transparent;
        border-right:25px solid transparent;
        border-top:25px solid #fafafa;
    }

    .joywp-testimonial-quote-with-avatar-author{
        position:absolute;
        left:0;
        right:0;
        bottom:45px;
        padding-left:120px;
        padding-right:10px;
        text-transform:uppercase;
        -webkit-transform:translateY(50%);
        transform:translateY(50%);
        max-width:100%;
    }

    .joywp-testimonial-quote-with-avatar-author-name{
        opacity:0.8;
        font-weight:800;
        overflow-wrap:break-word;
        word-break:break-word;
    }

    .joywp-testimonial-quote-with-avatar-author-meta{
        font-weight:400;
        text-transform:none;
        padding-left:0;
        opacity:0.8;
        overflow-wrap:break-word;
        word-break:break-word;
    }

    /* Responsive: keeps everything inside any container width (even 10%) */
    @media (max-width: 360px){
        .joywp-testimonial-quote-with-avatar-unit{
            min-width:0;
        }

        .joywp-testimonial-quote-with-avatar-quote{
            padding:18px 18px 22px 18px;
        }

        .joywp-testimonial-quote-with-avatar-avatar{
            height:72px;
            width:72px;
            margin-top:16px;
            margin-left:8px;
        }

        .joywp-testimonial-quote-with-avatar-author{
            position:static;
            -webkit-transform:none;
            transform:none;
            padding:10px 8px 0 8px;
        }

        .joywp-testimonial-quote-with-avatar-arrow{
            left:28px;
            border-right-width:18px;
            border-top-width:18px;
        }

        .joywp-testimonial-quote-with-avatar-quote-mark{
            font-size:40px;
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
