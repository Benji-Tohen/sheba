<?php
/* rel=”next and rel=”prev” indicates to Google that content is linked together through a paginated series */

if(isset($sp) && $sp && $sp->getNumPages()>1){

    if((intval($page)-1)>0){?>
    <link rel="prev" href="<?php echo $cfg["WM"]["Server"];?>/<?php echo $wmPage["Alias"]?$wmPage["Alias"]:$wmPage["ID"];?>/<?php echo (intval($page)-1);?>" />
    <?php }
    if(intval($page)!==intval($sp->getNumPages())){?>
    <link rel="next" href="<?php echo $cfg["WM"]["Server"];?>/<?php echo $wmPage["Alias"]?$wmPage["Alias"]:$wmPage["ID"];?>/<?php echo (intval($page)+1);?>" />
    <?php }

}

/* end */
?>
    
    
<?php
/*
$searchterm='שיבא';
$searchterm=urlencode($searchterm);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q='.$searchterm.'&start=0');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, 'http://www.syntax.cwarn23.info/');
$body = curl_exec($ch);
curl_close($ch);
$string = json_decode($body);
$dstring='';
foreach ($string->responseData->results AS $val) {
$dstring.='<<---<<>-><';
$dstring.=str_replace(array('<<---<<>-><','<b>','</b>','<em>','</em>','<i>','</i>'),'',$val->title);
$dstring.='<<---<<>-><';
$dstring.=str_replace('<<---<<>-><','',$val->url);
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q='.$searchterm.'&start=4');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, 'http://www.syntax.cwarn23.info/');
$bodyb = curl_exec($ch);
curl_close($ch);
$stringb = json_decode($bodyb);
foreach ($stringb->responseData->results AS $valb) {
$dstring.='<<---<<>-><';
$dstring.=str_replace(array('<<---<<>-><','<b>','</b>','<em>','</em>','<i>','</i>'),'',$valb->title);
$dstring.='<<---<<>-><';
$dstring.=str_replace('<<---<<>-><','',$valb->url);
}
$dstring=substr($dstring,11);
//echo '<br>'.$dstring;
$array=explode ('<<---<<>-><',$dstring);
echo '<xmp>';
print_r($array);
echo '</xmp>';

*/
?>

    