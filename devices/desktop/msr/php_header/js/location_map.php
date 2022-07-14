<?php /*require_once(dirname(__FILE__)."/../../php_components/more_items_js.php");*/?>
function clickroute(lati,long) {
$(window).animate({ scrollTop: 0 }, 'slow');
      $('body,html').animate({
        scrollTop: 250
      }, 800);
      var latLng = new google.maps.LatLng(lati, long); //Makes a latlng
      map.panTo(latLng); //Make map global
      map.setZoom(18);
      console.log("kaki");
  }
function updateChildrenList(){
	var searchedText = jQuery("#searchChildren").val();
        $(".item").show();
	$(".item").each(function(index, value) { 
            if($(this).attr('id').indexOf(searchedText) == -1){
                $(this).hide();
            }else{
                 $(this).show();
            }
        });
    }






	
