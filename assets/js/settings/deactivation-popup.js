(function($) {
    var pluginDeactivationLink = 'tr[data-plugin="joywp-testimonials-wpbakery-addons/joywp-testimonials-wpbakery-addons.php"] .deactivate a';
    var deactivationUrl = $(pluginDeactivationLink).attr('href');

    $(pluginDeactivationLink).on('click', function(e) {
        e.preventDefault();
        $('#joywp-deactivation-popup').show();
    });

    $('#joywp-deactivation-popup .joywp-deactivation-skip').on('click', function() {
        window.location.href = deactivationUrl;
    });

    $('#joywp-deactivation-popup .joywp-deactivation-submit').on('click', function() {
        var $btn = $(this);
        var originalHtml = $btn.html();

        $btn.prop('disabled', true);

        var data = $('#joywp-deactivation-form').serialize();
        data += '&action=joywp_testimonials_wpb_deactivate_feedback';

        $.ajax({
            type: 'POST',
            url: window.ajaxurl,
            data: data,
            complete: function() {
                $btn.html(originalHtml);
                $btn.prop('disabled', false);
                window.location.href = deactivationUrl;
            },
        });
    });

    function updateTextareaVisibility() {
        $('.joywp-form-group').each(function() {
            var $group = $(this);
            var $radio = $group.find('input[type="radio"]');
            var $textarea = $group.find('textarea');
            if ($textarea.length) {
                if ($radio.is(':checked')) {
                    $textarea.show();
                } else {
                    $textarea.hide();
                }
            }
        });
    }

    // Bind to radio change
    $('input[name="reason_key"]').on('change', function() {
        updateTextareaVisibility();
    });

    // Initial state
    updateTextareaVisibility();

    // Close popup when clicking outside the content
    $('#joywp-deactivation-popup .joywp-deactivation-popup-overlay').on('click', function() {
        $('#joywp-deactivation-popup').hide();
    });
})(jQuery);
