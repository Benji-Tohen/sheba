<?php
session_start();

//error_reporting(E_ALL);
//ini_set('display_errors','On');

function getsize($path){
if(!file_exists($path)) return 0;
if(is_file($path)) return filesize($path);
$self = __FUNCTION__;
$ret = 0;
foreach(glob($path."/*") as $fn)
$ret += $self($fn);
return $ret;
}

function formatbytes($val, $digits = 3, $mode = "SI", $bB = "B"){ //$mode == "SI"|"IEC", $bB == "b"|"B"
        $si = array("", "k", "M", "G", "T", "P", "E", "Z", "Y");
        $iec = array("", "Ki", "Mi", "Gi", "Ti", "Pi", "Ei", "Zi", "Yi");
        switch(strtoupper($mode)) {
            case "SI" : $factor = 1000; $symbols = $si; break;
            case "IEC" : $factor = 1024; $symbols = $iec; break;
            default : $factor = 1000; $symbols = $si; break;
        }
        switch($bB) {
            case "b" : $val *= 8; break;
            default : $bB = "B"; break;
        }
        for($i=0;$i<count($symbols)-1 && $val>=$factor;$i++)
            $val /= $factor;
        $p = strpos($val, ".");
        if($p !== false && $p > $digits) $val = round($val);
        elseif($p !== false) $val = round($val, $digits-$p);
        return round($val, $digits) . " " . $symbols[$i] . $bB;
}

function niceSize($size){
	return formatbytes($size, 3, "SI", "B");
}

?>
<?php require_once('common/header.php');?>
<?php require_once('common/body.php');?>

<div class="editPagePadding">
<div class="listItemsScrollerHigher">

<table>
	<tr>
		<td>משקל כולל של האתר:</td>
		<td dir="ltr"><?php echo file_exists("../../")?niceSize(getsize("../../")):"0";?></td>
	</tr>
	<tr>
		<td>כמות דפים באתר:</td>
		<td><?php echo $db->getField("SELECT COUNT(*) AS numPages FROM wm_pages", "numPages");?></td>
	</tr>
	<tr>
		<td>כמות דפים לפי סוג דף:</td>
		<td><?php
            $querySt="SELECT ty.Name as pageType, count(*) as numPages, SUM(noindex) as openToGoogle , SUM(Hide_On_Menu) as hidden
                      FROM wm_pages as pa, wm_pagetype as ty
                      WHERE pa.Page_Type=ty.ID
                      AND ty.ID not in (12,38,62,35,33,76,53,60,62,54,55,65)
                      group by ty.Name";
            $pageTypesArr= $db->getArray($querySt);
            $totalNumPages=0;
            $totalOpenToGoogle=0;
            $totalNotHidden=0;
            $index=0;
            $arrCount=count($pageTypesArr);
            echo "<table border='1'>";
            echo "<tr><th>סוג דף</th><th>כמות כללית</th><th>כמה פתוחים לגוגל</th><th>כמה לא מוסתרים</th></tr>";
            foreach($pageTypesArr as $item){
                if($item['openToGoogle']=='0'){$item['openToGoogle']=$item["numPages"];}else{$item['openToGoogle']=($item["numPages"]-$item['openToGoogle']);}
                if($item['openToGoogle']=='0'){$item['hidden']=$item["numPages"];}else{$item['hidden']=($item["numPages"]-$item['hidden']);}

                $totalNumPages=intval($item["numPages"])+$totalNumPages;
                $totalOpenToGoogle=intval($item['openToGoogle'])+$totalOpenToGoogle;
                $totalNotHidden=intval($item['hidden'])+$totalNotHidden;

                if($index!==($arrCount-1)){
                    echo "<tr><td>".$item["pageType"]."</td><td>".$item["numPages"]."</td><td>".$item['openToGoogle']."</td><td>".$item['hidden']."</td></tr>";
                }else{
                    echo '<tr><td><b>סה"כ</b></td><td><b>'.$totalNumPages.'</b></td><td><b>'.$totalOpenToGoogle.'</b></td><td><b>'.$totalNotHidden.'</b></td></tr>';
                }
                $index++;
            }
            echo "</table>";
            ?></td>
	</tr>
	<tr>
		<td>מילות חיפוש פופולריות באתר:</td>
		<td>
            <?php
                $querySearchWords="SELECT search_word, count_searches FROM wm_search_words WHERE 1 ORDER BY count_searches DESC LIMIT 10";
                $arrSearchWord=$db->getArray($querySearchWords);
                echo "<table border='1'>";
                echo "<tr><th>מילת חיפוש</th><th>כמות</th></tr>";
                foreach($arrSearchWord as $word){
                        echo "<tr><td>".$word["search_word"]."</td><td>".$word["count_searches"]."</td></tr>";
                }
                echo "</table>";
            ?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
</table>


</div>
</div>