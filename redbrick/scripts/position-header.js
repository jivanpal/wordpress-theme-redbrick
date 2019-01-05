/**
 * This script ensures that the Redbrick site header is always visible at the
 * top of the viewport (but below the WordPress admin bar if it is present)
 * by toggling the `notSticky` class appropriately.
 */

var header = null;

/**
 * Toggle the class `notSticky` on the header based on whether the header should
 * be moving when we scroll.
 */
function redbrick_set_header_stickiness(event) {
    var adminBarIsPresent = jQuery('body').hasClass('admin-bar');
    var viewportWidth = jQuery(window).width();
    var scrollHeight = jQuery(this).scrollTop();
    
    console.log("SCROLLING");
    console.log("adminBar? "+(adminBarIsPresent?"yes":"no"));
    console.log("vw = "+viewportWidth);
    console.log("sh = "+scrollHeight);

    if (   adminBarIsPresent
        && viewportWidth <= 600 // admin bar is not sticky only when the condition holds
        && scrollHeight < 46    // height of admin bar is 46 pixels
    ) {
        header.addClass('notSticky');
    } else {
        header.removeClass('notSticky');
    }
}

function redbrick_position_header() {
    header = jQuery('header');
    redbrick_set_header_stickiness();
    jQuery(window).on('scroll', redbrick_set_header_stickiness);
    jQuery(window).on('resize', redbrick_set_header_stickiness);
}

jQuery(redbrick_position_header);
