$(document).ajaxStop(function() {
  $(".loader").fadeOut(300);
});

function updateChildrenList(event){
    
        if(event.target.id =='searchChildren'){/*clicked on input*/
            var elem = "onlyName";
        }else{/*clicked on button*/
            var elem = "all";
        }
        var searchedText = $("#searchChildren").val();
        if(searchedText.length >2 && event.target.id=='searchChildren' || event.target.id!='searchChildren' && searchedText.length >1){
            $(".loader").fadeIn(300);
            if(true){ 
                $.ajax({
                type: "POST",
                url: "<?php echo $cfg["WM"]["Server"];?>/ajax/<?php echo str_replace(".php",'',$wmPage["Type"]["Page"]);?>",
                /* data: "searchedText="+searchedText+"&parentId="+parseInt(<?php echo $wmPage['ID']?>)+"&searchType="+elem, */
                data: "searchedText="+searchedText+"&parentId="+parseInt(<?php echo $wmPage['ID']?>)+"&lang=<?php echo $wmPage['Lang'];?>",
                async:"true",
                error: function () {
                    $(".loader").fadeOut(300);
                   
                },
                success: function(data){
                    $("#childrenWrap").html(data);

                }
            });
        }
    }
}
    
$(document).ready(function(){
    $("#searchChildren").keyup(function( event ) {
        updateChildrenList(event);
    });
    $("#searchChildren").click(function( event ) {
        updateChildrenList(event);
    });
    $(".searchBoxButton").keyup(function( event ) {
        updateChildrenList(event);
    });
    $(".searchBoxButton").click(function( event ) {
        updateChildrenList(event);
    });
});

