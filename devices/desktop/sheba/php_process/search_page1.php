<?php /*
<script>
(function() {
  var cx = '006838370188681540999:qtoedthnhl4';
  var gcse = document.createElement('script');
  gcse.type = 'text/javascript';
  gcse.async = true;
  gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
      '//www.google.com/cse/cse.js?cx=' + cx;
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(gcse, s);
})();
</script>
<gcse:searchresults-only></gcse:searchresults-only>
*/ 

?>
  



<?php

$wm->initGetParams();

$q=urldecode($_GET["q"]);
$q = str_replace(array(";","(",")",'"'),"",strip_tags($q)); // prevent cross-site scripting 

if($_GET["q"]){
    $wm->insertSearch($q);
}

$_SESSION['q'] = $q;

/*$arr=$wm->getSearchArr($q, $wmPage["Lang"]);*/
/*
$totalItems = count($arr);

$start = isset($_GET['start']) ? $_GET['start'] : 0;
$numItems=intval($params->getValue("search_page_num_items"));
$arr=$wm->getSearchArr($q, $wmPage["Lang"], "LIMIT $start, $numItems");
*/

$thumbWidth=$params->getValue("news_page_image_width");
$thumbHeight=$params->getValue("news_page_image_height");
//$thumb_call=$cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?zc=1&amp;w=$thumbWidth&amp;h=$thumbHeight&amp;src=";
/*$thumbWidth=339;
$thumbHeight=225;*/
$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/".$thumbWidth."X".$thumbHeight."/zcX1/";
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
  })();
</script>


