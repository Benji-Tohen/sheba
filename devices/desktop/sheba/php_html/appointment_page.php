<?php
    $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."390"."X"."235"."/iarX1/";
    $link=$wm->getLink($arr[$i]);?>
	<div class="mainItemWrap">
        <div class="itemCard">
            <?php /*special open chat item!*/
                if($arr[$i]['Conversion']!=''){
                    $linkHTML = "onclick='".$arr[$i]['Conversion']."; return false;'"; 
                    $isConversion = 1;// Item with JS redirect
                }else{
                    $linkHTML = "href='".$link["Link"]."'"; // Item with link
                }
                ?>
            <?php if($arr[$i]["Top_Header"]){?>
                <a <?php echo $linkHTML;?> class="<?php echo ($clickableItem) ? '' : 'notClickable '; echo (isset($arr[$i]["custom_class"]) && $arr[$i]["custom_class"]) ? "custom_".$arr[$i]["custom_class"] : '';?>" <?php echo $isConversion ? 'href="#"': '';?> target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">
                    <img src="<?php echo $cfg["WM"]["Server"]."/".$arr[$i]["Top_Header"];?>" alt="<?php echo $arr[$i]["Top_Header_Alt"] ? $arr[$i]["Top_Header_Alt"] : $arr[$i]["Name"];?>" title="<?php echo $arr[$i]["Name"];?>" class="img-fluid imageItem" />
                    <div class="titleOverlay">
                        <h2 class="itemTitle"><?php echo $arr[$i]["h1"]; ?></h2>
                        <h4 class="itemSubTitle">
                            <?php echo nl2br($arr[$i]["Sub_Title"]); ?>
                        </h4>
                    </div>
                </a>
            <?php }?>    
        </div>
    </div>

    

