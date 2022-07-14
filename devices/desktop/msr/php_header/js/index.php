$(document).ready(function() {

    if($(window).width()<766){
        $('.dropdown').on("click",
            function() {
                $(this).addClass("open");
            }, function() {
                $(this).parent().parent().removeClass("open");
            }
        );
    }else{
        $('.dropdown').hover(
            function() {
                $(this).addClass("open");
            }, function() {
                $(this).removeClass("open");
            }
        );
    }




$(function() {
 $('input, textarea').placeholder();
});

/*
$.fn.clickOff = function(callback, selfDestroy) {
    var clicked = false;
    var parent = this;
    var destroy = selfDestroy || true;

    parent.click(function() {
        clicked = true;
    });

    $(document).click(function(event) {
        if (!clicked) {
            callback(parent, event);
        }
        if (destroy) {
            //parent.clickOff = function() {};
            //parent.off("click");
            //$(document).off("click");
            //parent.off("clickOff");
        };
        clicked = false;
    });
};

$( ".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });*/
$(".myDiv").click(function() {
    $(this).find(".shareDialog").slideToggle();
})
/*function to hide .myDiv when click outside - can be slow on client!!*/
$(document).mouseup(function (e)
{
    var container = $(".shareDialog");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.hide();
    }
});
/*$("#myDiv").clickOff(function() {
    $("#myDiv .shareDialog").hide();

});*/


    $(".sideMenuToggle").click(function(){
        $(".sideMenuWrap").toggle();

    });

    $(".closeSideMenu").click(function(){
        $(".sideMenuWrap").toggle();
    });

     /* Replace all SVG images with inline SVG*/

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


    /* SHARE BUTTONS TOGGLE */





    /* SHARE BUTTONS TOGGLE */
    $("#emailDialogToggle").click(function(){
        $(".emailDialog").slideToggle();
    });
    $("#emailDialogToggle2").click(function(){
        $(".emailDialog").slideToggle();
    });

    /* Detect IE and Firfox and Add Class For CSS */
    if(navigator.userAgent.match(/Trident/)) {
        $('.siteWrapper').addClass('ie');
    }else{
        if(navigator.userAgent.match(/Firefox/)){
            $('.siteWrapper').addClass('ff');
        }
    }
    $(".accessibilityLink").focus(function() { $(this).css("top", "20px");});
    $(".accessibilityLink").blur(function() { $(this).css("top", "-1000px");});
    $( ".searchToggle" ).click(function() {
        $( ".searchMobileForm" ).toggle()
    });

    $( "#closeSearchForm" ).click(function() {
        $( ".searchWrapperCont" ).slideUp("fast")
    });
/*
    $(".navbar-nav").hover(function(){
        if($(this).find("ul").hasClass("open")){

            $(this).find("ul").fadeOut("fast");
            $(this).find("ul").removeClass("open");
        }else{

            $(this).find("ul").fadeIn("fast");
            $(this).find("ul").addClass("open");
        }
*/


    if(window.innerWidth > 992){
        /* Load Desktop */
        initDesktopCarousel();
        
        /* Delay mobile load */
        setTimeout(function() {
            initMobileCarousel();
        }, 2000);
    } else {
        /* Load Mobile */
        initMobileCarousel();

        /* Delay desktop load */
        setTimeout(function() {
             initDesktopCarousel();
        }, 2000);
    }
});



function initDesktopCarousel(){
    $('.row_slick_gallery').slick({
        rtl:true,
        dots: false,
        infinite: true,
        responsive:true,
        speed: 500,
        fade: true,
        autoplay:true,
        autoplaySpeed:3000,
        nextText:'',
        prevText:'',
        cssEase: 'linear'
    });
}

function initMobileCarousel(){
    $('.mobile_slick_gallery').slick({
        rtl:true,
        dots: false,
        infinite: true,
        responsive:true,
        speed: 500,
        fade: true,
        autoplay:true,
        autoplaySpeed:30000,
        nextText:'',
        prevText:'',
        cssEase: 'linear'
    });
}

    /* Shrink Logo on scroll down

    $(window).bind('mousewheel DOMMouseScroll', function(event){


        if (event.originalEvent.wheelDelta > 0 || event.originalEvent.detail < 0) {

        }
        else {
            $('.logo').css('width','50%');
        }

    });

    end*/


	$('.loginButton').click(function(){
		$('.loginFrame').fadeIn();
		$('.loginFrameWrapper').fadeIn();
	});

	$('.openForgotPassword').click(function(){
		$('.openForgotPassword').fadeOut();
		$('.forgotPasswordForm').slideDown();
	});

	$('.loginFormClose').click(function(){
		$('.loginFrameWrapper').fadeOut();
		$('.loginFrame').fadeOut();
	});

	$('.basket').click(function(){
		<?php
			$cartPageId=$wm->getIdByPageType(72, $wmPage["Lang"]);
			$cartPage=$wm->getValues($cartPageId);
			$cartPage=$cfg["WM"]["Server"]."/".$wm->getAlias($cartPage);
		?>
		document.location="<?php echo $cartPage;?>";
	});


<?php
$queryLanguages="
	SELECT wm_pages.ID, wm_pages.Alias, wm_languages.Name, wm_pages.Lang
	FROM wm_pages
	INNER JOIN wm_languages ON wm_languages.Lang=wm_pages.Lang
	WHERE wm_pages.Parent=1 AND wm_pages.Deleted=0
";
$arrLanguages=	$db->getArray($queryLanguages);

if(count($arrLanguages)>1){?>
    $("#languageSelect dt a").click(function() {
        $("#languageSelect dd ul").toggle();
    });

    $("#languageSelect dd ul li a").click(function() {
        var text = $(this).html();
        $("#languageSelect dt a span").html(text);
        $("#languageSelect dd ul").hide();
/*
$("#result").value=getSelectedValue("sample");
document.searchForm.product.value=getSelectedValue("languageSelect");
*/
	document.location=getSelectedValue("languageSelect");
    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }
    $('.subscribeButton').bind('click', function(e) {
        jQuery(".loader").fadeIn(100);
        jQuery.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"].'/'.$device?>/php_process/form_page.php",
            data: $('#emailNewsletter').serialize(),
            async:"true",
            error: function () {
                jQuery(".loader").fadeOut(300);
                /*alert('קרתה תקלה, אנא נסה/י שנית');*/
            },
            success: function(data){
                alert('תודה על הרשמתך..(יש לפתח)');
                jQuery(".loader").fadeOut(300);
            }
        });
     });
    $(document).bind('click', function(e) {
        var $clicked = $(e.target);
        if (! $clicked.parents().hasClass("dropdown"))
            $("#languageSelect dd ul").hide();
    });
<?php }?>

 function getCitiesAjax(thisObj){
     jQuery(thisObj);
     jQuery(".loader").fadeIn(300);
	if(true){
        jQuery.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"];?>/site/php_components/ajax_get_cities.php",
            data: "cityName="+thisObj.value+"&inputId="+thisObj.id,
            async:"true",
            error: function () {
                /*alert('קרתה תקלה, אנא נסה/י שנית');*/
                jQuery(".loader").fadeIn(300);
            },
            success: function(data){
                jQuery("#autocompleteDiv").show();
                jQuery("#autocompleteDiv").html(data);
                jQuery(".loader").fadeOut(300);
            }
        });
    }
 }

