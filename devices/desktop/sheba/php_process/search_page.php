<?php

$wm->initGetParams();
$q=urldecode($_GET["q"]);
$q = str_replace(array(";","(",")",'"'),"",strip_tags($q)); // prevent cross-site scripting 

if($_GET["q"]){
    $wm->insertSearch($q);
}

$_SESSION['q'] = $q;



$thumbWidth=$params->getValue("news_page_image_width");
$thumbHeight=$params->getValue("news_page_image_height");
$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/".$thumbWidth."X".$thumbHeight."/zcX1/";

/*if is english subdomain - search only in english sites - else search only in hebrew sites - if add new domain to array - change also in css search page*/ 
$englishSubdomainsArr = ["talpiot", "tto","eng"];
$fullHostURI = explode('.', $_SERVER['SERVER_NAME']); 
$subdomainForSearch = $fullHostURI[0]; 

$pos=strpos($_GET["a"], "msr=1");
if($pos !== false){
?>
<script>
  (function() {
    var cx = '000592916972073447809:8gy2alw_4wi';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
    setTimeout(function(){  
    $('.gsc-results-wrapper-visible').append("<style>.breadCrumbs{ margin-bottom: 13px; } .gsc-above-wrapper-area{ border: none; } .search_page .gsc-wrapper .gsc-webResult .gsc-result{ padding: 14px 0 8px 0; } .gsc-control-wrapper-cse, .gs-bidi-start-align gs-snippet, .gs-bidi-start-align{ direction: rtl; text-align: right; } .pageTitle{ display: none; } .gsc-control-cse div{ padding: 0px; } .search_page .gsc-control-cse{ padding: 0px; } .gsc-option-menu-ite{ text-align: center; } .gsc-webResult.gsc-result, .gsc-results .gsc-imageResult{ border-bottom: 1px solid #EAEAEA; } .gsc-webResult.gsc-result:hover, .gsc-imageResult:hover{ border-bottom: 1px solid #EAEAEA; } .gs-result .gs-title, .gs-result .gs-title *{ color: #1ABC9C; font-size: 20px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gsc-control-cse .gs-spelling, .gsc-control-cse .gs-result .gs-title, .gsc-control-cse .gs-result .gs-title *{ color: #1ABC9C; font-size: 22px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gs-webResult.gs-result a.gs-title:visited, .gs-webResult.gs-result a.gs-title:visited b, .gs-imageResult a.gs-title:visited, .gs-imageResult a.gs-title:visited b{ color: #1ABC9C; font-size: 20px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gs-webResult.gs-result a.gs-title:link, .gs-webResult.gs-result a.gs-title:link b, .gs-imageResult a.gs-title:link, .gs-imageResult a.gs-title:link b{ color: #1ABC9C; font-size: 20px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gs-webResult div.gs-visibleUrl, .gs-imageResult div.gs-visibleUrl{ color: #7B7B7B; font-size: 14px; } .gs-webResult .gs-snippet, .gs-imageResult .gs-snippet, .gs-fileFormatType{ color: #444444; font-size: 14px; }</style>");
        
       }, 1000);

  })();
</script>
<?php } else if($subdomainForSearch == 'tto'){ ?>

  <script>
    (function() {
      var cx = '006838370188681540999:qtoedthnhl4';
      var gcse = document.createElement('script');
      gcse.type = 'text/javascript';
      gcse.async = true;
      gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
          '//cse.google.com/cse.js?cx=' + cx;
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(gcse, s);
  
      setTimeout(function(){  
      $('.gsc-results-wrapper-visible').append("<style>.breadCrumbs{ margin-bottom: 13px; } .gsc-above-wrapper-area{ border: none; } .search_page .gsc-wrapper .gsc-webResult .gsc-result{ padding: 14px 0 8px 0; } .gsc-control-wrapper-cse, .gs-bidi-start-align gs-snippet, .gs-bidi-start-align{ direction: rtl; text-align: right; } .pageTitle{ display: none; } .gsc-control-cse div{ padding: 0px; } .search_page .gsc-control-cse{ padding: 0px; } .gsc-option-menu-ite{ text-align: center; } .gsc-webResult.gsc-result, .gsc-results .gsc-imageResult{ border-bottom: 1px solid #EAEAEA; } .gsc-webResult.gsc-result:hover, .gsc-imageResult:hover{ border-bottom: 1px solid #EAEAEA; } .gs-result .gs-title, .gs-result .gs-title *{ color: #1ABC9C; font-size: 20px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gsc-control-cse .gs-spelling, .gsc-control-cse .gs-result .gs-title, .gsc-control-cse .gs-result .gs-title *{ color: #1ABC9C; font-size: 22px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gs-webResult.gs-result a.gs-title:visited, .gs-webResult.gs-result a.gs-title:visited b, .gs-imageResult a.gs-title:visited, .gs-imageResult a.gs-title:visited b{ color: #1ABC9C; font-size: 20px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gs-webResult.gs-result a.gs-title:link, .gs-webResult.gs-result a.gs-title:link b, .gs-imageResult a.gs-title:link, .gs-imageResult a.gs-title:link b{ color: #1ABC9C; font-size: 20px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gs-webResult div.gs-visibleUrl, .gs-imageResult div.gs-visibleUrl{ color: #7B7B7B; font-size: 14px; } .gs-webResult .gs-snippet, .gs-imageResult .gs-snippet, .gs-fileFormatType{ color: #444444; font-size: 14px; }</style>");
          
        }, 1000);
    })();
  </script>

<?php } else if(in_array($subdomainForSearch, $englishSubdomainsArr)){ ?>
   <script>
  (function() {
    
    var cx = '006838370188681540999:zwhlcj5b2qs';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
 
     setTimeout(function(){  
    $('.gsc-results-wrapper-visible').append("<style>.breadCrumbs{ margin-bottom: 13px; } .gsc-above-wrapper-area{ border: none; } .search_page .gsc-wrapper .gsc-webResult .gsc-result{ padding: 14px 0 8px 0; } .gsc-control-wrapper-cse, .gs-bidi-start-align gs-snippet, .gs-bidi-start-align{ direction: rtl; text-align: right; } .pageTitle{ display: none; } .gsc-control-cse div{ padding: 0px; } .search_page .gsc-control-cse{ padding: 0px; } .gsc-option-menu-ite{ text-align: center; } .gsc-webResult.gsc-result, .gsc-results .gsc-imageResult{ border-bottom: 1px solid #EAEAEA; } .gsc-webResult.gsc-result:hover, .gsc-imageResult:hover{ border-bottom: 1px solid #EAEAEA; } .gs-result .gs-title, .gs-result .gs-title *{ color: #1ABC9C; font-size: 20px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gsc-control-cse .gs-spelling, .gsc-control-cse .gs-result .gs-title, .gsc-control-cse .gs-result .gs-title *{ color: #1ABC9C; font-size: 22px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gs-webResult.gs-result a.gs-title:visited, .gs-webResult.gs-result a.gs-title:visited b, .gs-imageResult a.gs-title:visited, .gs-imageResult a.gs-title:visited b{ color: #1ABC9C; font-size: 20px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gs-webResult.gs-result a.gs-title:link, .gs-webResult.gs-result a.gs-title:link b, .gs-imageResult a.gs-title:link, .gs-imageResult a.gs-title:link b{ color: #1ABC9C; font-size: 20px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gs-webResult div.gs-visibleUrl, .gs-imageResult div.gs-visibleUrl{ color: #7B7B7B; font-size: 14px; } .gs-webResult .gs-snippet, .gs-imageResult .gs-snippet, .gs-fileFormatType{ color: #444444; font-size: 14px; }</style>");
        
       }, 1000);
  })();
</script>
<?php }else{
?>
    <script>
  (function() {
    
    var cx = '006838370188681540999:ynsksvxmviy';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
 
     setTimeout(function(){  
    $('.gsc-results-wrapper-visible').append("<style>.breadCrumbs{ margin-bottom: 13px; } .gsc-above-wrapper-area{ border: none; } .search_page .gsc-wrapper .gsc-webResult .gsc-result{ padding: 14px 0 8px 0; } .gsc-control-wrapper-cse, .gs-bidi-start-align gs-snippet, .gs-bidi-start-align{ direction: rtl; text-align: right; } .pageTitle{ display: none; } .gsc-control-cse div{ padding: 0px; } .search_page .gsc-control-cse{ padding: 0px; } .gsc-option-menu-ite{ text-align: center; } .gsc-webResult.gsc-result, .gsc-results .gsc-imageResult{ border-bottom: 1px solid #EAEAEA; } .gsc-webResult.gsc-result:hover, .gsc-imageResult:hover{ border-bottom: 1px solid #EAEAEA; } .gs-result .gs-title, .gs-result .gs-title *{ color: #1ABC9C; font-size: 20px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gsc-control-cse .gs-spelling, .gsc-control-cse .gs-result .gs-title, .gsc-control-cse .gs-result .gs-title *{ color: #1ABC9C; font-size: 22px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gs-webResult.gs-result a.gs-title:visited, .gs-webResult.gs-result a.gs-title:visited b, .gs-imageResult a.gs-title:visited, .gs-imageResult a.gs-title:visited b{ color: #1ABC9C; font-size: 20px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gs-webResult.gs-result a.gs-title:link, .gs-webResult.gs-result a.gs-title:link b, .gs-imageResult a.gs-title:link, .gs-imageResult a.gs-title:link b{ color: #1ABC9C; font-size: 20px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gs-webResult div.gs-visibleUrl, .gs-imageResult div.gs-visibleUrl{ color: #7B7B7B; font-size: 14px; } .gs-webResult .gs-snippet, .gs-imageResult .gs-snippet, .gs-fileFormatType{ color: #444444; font-size: 14px; }</style>");
        
       }, 1000);
  })();
</script>
<?php
}
?>

