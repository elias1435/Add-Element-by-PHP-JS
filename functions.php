<?php
/* add this code to wordpress functions
I want to add a shortcode `[some_code id="1"]` before this id "s-share-buttons"

function add_shortcode_before_share_buttons_inline_script() {
    if (is_single()) { // Only on single post pages
        // Generate the shortcode output
        $shortcode_output = '<div class="after-post-ads">' . do_shortcode('[some_code id="1"]') . '</div>';

        // Inline JavaScript to insert the shortcode before the div
        $script = "
            document.addEventListener('DOMContentLoaded', function() {
                var shareButtonsDiv = document.getElementById('s-share-buttons');
                if (shareButtonsDiv) {
                    var wrapper = document.createElement('div');
                    wrapper.innerHTML = `" . addslashes($shortcode_output) . "`;
                    shareButtonsDiv.parentNode.insertBefore(wrapper.firstChild, shareButtonsDiv);
                }
            });
        ";

        // Add the inline script
        wp_add_inline_script('jquery', $script);
    }
}
add_action('wp_enqueue_scripts', 'add_shortcode_before_share_buttons_inline_script');
