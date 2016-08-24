/**
 * Created by Huma on 5/3/2016.
 */


jQuery(document).ready(function () {
    jQuery('.cat-parent').children('a').attr('href', 'javascript:;');
    jQuery('li.cat-parent a').click(function (event) {
        jQuery(this).toggleClass('opened');
        event.preventDefault();
        jQuery('#ajax-loading-screen').stop().transition({'opacity': 0}, 1,
            function () {
                jQuery(this).css({'display': 'none'});
            });
        jQuery(this).parent('.cat-parent').children('.children').toggle(500);
    });
});