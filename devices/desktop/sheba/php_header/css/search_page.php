.breadCrumbs{
    margin-bottom: 13px !important;
}

.gsc-above-wrapper-area{
    border: none !important;
}

.search_page .gsc-wrapper .gsc-webResult .gsc-result{
    padding: 14px 0 8px 0 !important;
}
<?php 
/*if is english subdomain - search only in english sites - else search only in hebrew sites if add new domain to array - change also in process search page*/ 
$englishSubdomainsArr = ["talpiot", "tto","eng"];
$fullHostURI = explode('.', $_SERVER['SERVER_NAME']); 
$subdomainForSearch = $fullHostURI[0]; 
if(in_array($subdomainForSearch, $englishSubdomainsArr)){?>
    .gsc-control-wrapper-cse, .gs-bidi-start-align gs-snippet, .gs-bidi-start-align{
        direction: ltr !important;
        text-align: left !important;
    }
<?php }else{?>
    .gsc-control-wrapper-cse, .gs-bidi-start-align gs-snippet, .gs-bidi-start-align{
        direction: rtl !important;
        text-align: right !important;
    }
<?php }
?>


.pageTitle{
    display: none !important;
}

.gsc-control-cse div{
    padding: 0px !important;
}

.search_page .gsc-control-cse{
    padding: 0px !important;
}

.gsc-option-menu-ite{
    text-align: center !important;
}

.gsc-webResult.gsc-result, .gsc-results .gsc-imageResult{
    border-bottom: 1px solid #EAEAEA !important;
}

.gsc-webResult.gsc-result:hover, .gsc-imageResult:hover{
    border-bottom: 1px solid #EAEAEA !important;
}

.gs-result .gs-title, .gs-result .gs-title *{
    color: #1ABC9C !important;
    font-size: 20px !important;
    text-decoration: none !important;
    font-family: 'Open Sans', 'Open Sans Hebrew' !important;
}

.gsc-control-cse .gs-spelling, .gsc-control-cse .gs-result .gs-title, .gsc-control-cse .gs-result .gs-title *{
    color: #1ABC9C !important;
    font-size: 22px !important;
    text-decoration: none !important;
    font-family: 'Open Sans', 'Open Sans Hebrew' !important;
}

.gs-webResult.gs-result a.gs-title:visited, .gs-webResult.gs-result a.gs-title:visited b, .gs-imageResult a.gs-title:visited, .gs-imageResult a.gs-title:visited b{
    color: #1ABC9C !important;
    font-size: 20px !important;
    text-decoration: none !important;
    font-family: 'Open Sans', 'Open Sans Hebrew' !important;
}

.gs-webResult.gs-result a.gs-title:link, .gs-webResult.gs-result a.gs-title:link b, .gs-imageResult a.gs-title:link, .gs-imageResult a.gs-title:link b{
    color: #1ABC9C !important;
    font-size: 20px !important;
    text-decoration: none !important;
    font-family: 'Open Sans', 'Open Sans Hebrew' !important;
}

.gs-webResult div.gs-visibleUrl, .gs-imageResult div.gs-visibleUrl{
    color: #7B7B7B !important;
    font-size: 14px !important;
}

.gs-webResult .gs-snippet, .gs-imageResult .gs-snippet, .gs-fileFormatType{
    color: #444444 !important;
    font-size: 14px !important;
}

.gsc-result-info{
    text-align: <?php echo $gui->getLeft();?> !important;
}

.gsc-orderby-container{
    text-align: <?php echo $gui->getRight();?> !important;
}

.gsc-expansionArea .gsc-cursor-box .gsc-cursor{
    display: block !important ;
}

.gsc-results .gsc-cursor-box .gsc-cursor-page{
    color: #444444 !important;
    font-size: 14px !important;
    font-weight: normal !important;
    background-color: #f5f5f5 !important;
}

.gsc-results .gsc-cursor-page.gsc-cursor-current-page{
    color: #1abc9c !important;
    font-weight: bold !important;
}

.gsc-results .gsc-cursor-box .gsc-cursor-page:hover{
    color: #1abc9c !important;
    font-weight: bold !important;
}

.gsc-results .gsc-cursor-box{
    background-color: #f5f5f5 !important;
    padding: 8px !important;
    display: inline-table !important;
    margin: 38px 0 !important;
}

.gsc-selected-option-container{
    width: 100px !important !important;
}

.gsc-control-cse .gsc-option-selector{
    right: 18px !important;
}

.gsc-option{
    width: 110px !important;
    text-align: center !important;
}

.gsc-expansionArea > .gsc-result:last-child{
    margin-bottom: 20px !important;
    border: none !important;
}