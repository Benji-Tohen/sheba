$(document).ready(function() {
        // Replace all SVG images with inline SVG
        jQuery('img.svg').each(function(){
            var $img = jQuery(this);
            var imgID = $img.attr('id');
            var imgClass = $img.attr('class');
            var imgURL = $img.attr('src');

            jQuery.get(imgURL, function(data) {
                /* Get the SVG tag, ignore the rest */
                var $svg = jQuery(data).find('svg');

                /* Add replaced image's ID to the new SVG */
                if(typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }
                /* Add replaced image's classes to the new SVG */
                if(typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass+' replaced-svg');
                }

                /* Remove any invalid XML tags */
                $svg = $svg.removeAttr('xmlns:a');

                /* Replace image with new SVG */
                $img.replaceWith($svg);

            }, 'xml');

        });
});



function toggleMenu(){
    $('.mobileTopMenuWrap').fadeToggle();
    return true;
}


function toggleSearch(){
    if($('.searchForm').attr('data-toggle-status') === "true"){
        $('.searchForm').attr('data-toggle-status', "false");
        $('.searchForm').fadeOut(100);
        $('.search-toggle-btn').children('i').removeClass('fa-times');
        $('.search-toggle-btn').children('i').addClass('fa-search');
    } else {
        $('.searchForm').attr('data-toggle-status', "true");
        $('.searchForm').fadeIn(100);
        $('.search-toggle-btn').children('i').removeClass('fa-search');
        $('.search-toggle-btn').children('i').addClass('fa-times');
    }
}