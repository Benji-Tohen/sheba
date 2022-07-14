var searchState = {
    searching: false
}

function searchDoctorsFromCookie(){
    var searchDoctorsQuery = {};

    /* Check if cookie of prev query exists */
    var searchDoctorsQueryString = readCookie('search_doc_query');
    
    if(searchDoctorsQueryString){
        searchDoctorsQuery = JSON.parse(searchDoctorsQueryString);

        $('#searchByName').val(searchDoctorsQuery.keywords);
        $('#searchByMedDomain > option[value='+searchDoctorsQuery.domain+']').prop('selected', true);
        $('#searchByUnit > option[value='+searchDoctorsQuery.unit+']').prop('selected', true);
        searchDoctors(searchDoctorsQuery);
        eraseCookie('search_doc_query');
    }
}

function searchDoctors(searchDoctorsQuery){
    $(".loader").fadeIn(300);
    delayBtn('#searchKeywordBtn', 90000);
    delayBtn('#searchLetterBtn', 90000);

    if(!searchState.searching){
        searchState.searching = true;

        if(typeof searchDoctorsQuery === 'object' && !$.isEmptyObject(searchDoctorsQuery)){
            var searchedName = searchDoctorsQuery.keywords;
            var searchByMedDomain = searchDoctorsQuery.domain;
            var searchByUnit = searchDoctorsQuery.unit;
        } else {
            searchedName = $("#searchByName").val();
            searchByMedDomain = ($("#searchByMedDomain option:selected" ).val() == 0 ? '': $("#searchByMedDomain option:selected" ).val());
            searchByUnit = ($("#searchByUnit option:selected" ).val() == 0 ? '' : $("#searchByUnit option:selected" ).val());
            
            searchDoctorsQuery = {
                'keywords': searchedName,
                'domain': searchByMedDomain,
                'unit': searchByUnit
            };

            /* Store search query in cookie for back button */
            var searchDoctorsQueryString = JSON.stringify(searchDoctorsQuery);
            createCookie('search_doc_query', searchDoctorsQueryString, 0.048);
        }

        var search_only_specialist_doctors = $("#search_only_specialist_doctors").val();

        $.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"];?>/ajax/<?php echo str_replace('.php', '', $wmPage["Type"]["Page"]);?>",
            data: "searchedName="+searchedName+"&searchByMedDomain="+searchByMedDomain+"&searchByUnit="+searchByUnit+"&parentPageId=<?php echo $wmPage['ID']?>&search_only_specialist_doctors="+search_only_specialist_doctors,
            async:"true",
            error: function () {
                /*alert('קרתה תקלה, אנא נסה/י שנית');*/
            },
            success: function(data){
                $(".loader").fadeOut(300);
                $("#childrenWrap").html(data);
                disableDelayBtn('#searchKeywordBtn');
                disableDelayBtn('#searchLetterBtn');
                searchState.searching = false;
            }
        });
    }
}
var selected_letter=null;
function searchDoctorsAlpha(value,obj){
    $(".loader").fadeIn(300);
    delayBtn('#searchKeywordBtn', 90000);
    delayBtn('#searchLetterBtn', 90000);
	if(true){ 
        $.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"];?>/ajax/<?php echo str_replace('.php', '', $wmPage["Type"]["Page"]);?>",
            data: "searchedAlpha="+value+"&parentPageId=<?php echo $wmPage['ID']?>",
            async:"true",
            error: function () {
                /*alert('קרתה תקלה, אנא נסה/י שנית');*/
            },
            success: function(data){
                $(".loader").fadeOut(300);
                $("#childrenWrap").html(data);
                disableDelayBtn('#searchKeywordBtn');
                disableDelayBtn('#searchLetterBtn');
            }
        });
      if (selected_letter) $(selected_letter).css({backgroundColor:"",color:""});
        $(obj).css({backgroundColor:"#1abc9c",color:"#ffffff"});
        selected_letter = obj;
        $("h2[class=searchCategodyTitle]").html(obj.innerHTML);
    }
}

function searchDoctorsAll(){
    $(".loader").fadeIn(300);
    delayBtn('#searchKeywordBtn', 90000);
    delayBtn('#searchLetterBtn', 90000);
	if(true){ 
        $.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"];?>/ajax/<?php echo str_replace('.php', '', $wmPage["Type"]["Page"]);?>",
            data: "parentPageId=<?php echo $wmPage['ID']?>",
            async:"true",
            error: function () {
                /*alert('קרתה תקלה, אנא נסה/י שנית');*/
            },
            success: function(data){
                $("h2[class=searchCategodyTitle]").html("");
                $(selected_letter).css({backgroundColor:"",color:""});
                $("#searchByMedDomain").val(0);
                $("#searchByUnit").val(0);
                $(".loader").fadeOut(300);
                $("#childrenWrap").html(data);
                disableDelayBtn('#searchKeywordBtn');
                disableDelayBtn('#searchLetterBtn');
            }
        });
    }
}

$(document).ready(function(){
    setTimeout(function(){
        searchDoctorsFromCookie();
    },100)

    /* On ENTER pressed in input */
    $('#searchByName').on('keypress', function(event){
        if (event.keyCode === 13) {
            event.preventDefault();
            searchDoctors();
        }
    });
});
	
