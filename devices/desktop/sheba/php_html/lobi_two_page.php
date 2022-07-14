<?php
    $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."390"."X"."235"."/iarX1/";
    $link=$wm->getLink($arr[$i]);?>
	<div class="col-6 col-sm-6 col-md-6 col-lg-6 item twoItemsRow">
        <?php /*special open chat item!*/
            if($arr[$i]['Conversion']!=''){
                $linkHTML = "onclick='".$arr[$i]['Conversion']."; return false;'"; 
                $isConversion = 1;// Item with JS redirect
            }else if($clickableItem){
                $linkHTML = "href='".$link["Link"]."'"; // Item with link
            } else {
                $linkHTML = "href=''"; // Item not clickable
            }
        ?>

        <?php if($arr[$i]["Top_Header"]){?>
            <a <?php echo $linkHTML;?> class="<?php echo ($clickableItem) ? '' : 'notClickable '; echo (isset($arr[$i]["custom_class"]) && $arr[$i]["custom_class"]) ? "custom_".$arr[$i]["custom_class"] : '';?>" <?php echo $isConversion ? 'href="#"': '';?> target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">
            <img src="<?php echo $thumb_call.$arr[$i]["Top_Header"];?>" alt="<?php echo $arr[$i]["Top_Header_Alt"] ? $arr[$i]["Top_Header_Alt"] : $arr[$i]["Name"];?>" title="<?php echo $arr[$i]["Name"];?>" class="img-fluid" />
                <div class="titleOverlay">
                    <h4>
                        <?php echo $arr[$i]["External_Sub_Title"] ? $arr[$i]["External_Sub_Title"] : $arr[$i]["Sub_Title"]; ?>
                    </h4>
                </div>
            </a>
        <?php } ?>    
    </div>
    
	<?php if(false && $arr[$i+1]){
            $link=$wm->getLink($arr[$i+1]);
            ?>
	   <div class="col-6 col-sm-6 col-md-6 col-lg-6 item">
            <?php /*special open chat item!*/
            if($arr[$i]['Conversion']!=''){
                $onclickEvent = $arr[$i+1]['Conversion'];
            }else{
                $onclickEvent=null;
            }
            ?>
            <a onclick="<?php echo $onclickEvent ? $onclickEvent: ''?>" class="<?php echo (isset($arr[$i+1]["custom_class"]) && $arr[$i+1]["custom_class"]) ? "custom_".$arr[$i+1]["custom_class"] : '';?>" href="<?php echo $onclickEvent ? '#': $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+1]["Name"];?>">
                <?php if($arr[$i+1]["Top_Header"]){?>
                <img src="<?php echo $thumb_call.$arr[$i+1]["Top_Header"];?>" alt="<?php echo $arr[$i+1]["Name"];?>" title="<?php echo $arr[$i+1]["Name"];?>" class="img-fluid" />
                <?php } else { ?>
                <img src="<?php echo $cfg["WM"]["Server"]."/site/images/defaultLobi.jpg";?>" alt="<?php echo $arr[$i+1]["Name"];?>" title="<?php echo $arr[$i+1]["Name"];?>" class="img-fluid" />
                <?php }?>
                <div class="titleOverlay">
                    <h4>
                        <?php /*
                        if(intval(mb_strlen($arr[$i+1]["Sub_Title"], 'UTF-8'))>33){
                        echo mb_substr($arr[$i+1]["Sub_Title"],0,80, "utf-8")."...";
                        }else{ }*/
                        echo $arr[$i+1]["Sub_Title"];
                        ?>
                    </h4>
                </div>
            </a>
    </div>
	<?php }?>

