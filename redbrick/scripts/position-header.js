function redbrick_position_header() {
    var header = jQuery('header');
    var fixedPosition = 46;

    jQuery(window).scroll(function(event) {
        var windowPosition = jQuery(this).scrollTop();
        if (windowPosition > fixedPosition) {
            header.addClass('fixed');
        } else {
            header.removeClass('fixed');
        }
    });
}
jQuery(redbrick_position_header);
