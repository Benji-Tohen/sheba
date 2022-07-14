<div class="row twoItemsRow">
    <?php

    $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."390"."X"."235"."/iarX1/";
    $link=$wm->getLink($arr[$i]);?>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 item">
        <?php if($arr[$i]["Top_Header"]){?>
            <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">
                <img src="<?php echo $thumb_call.$arr[$i]["Top_Header"];?>" alt="<?php echo $arr[$i]["Name"];?>" title="<?php echo $arr[$i]["Name"];?>" class="img-responsive <?php if($isMesserPage==1){echo 'round-corners';}?>" />
                <div class="titleOverlay">
                    <h4>
                        <?php /* 
                        if(intval(mb_strlen($arr[$i]["Sub_Title"], 'UTF-8'))>33){
                        echo mb_substr($arr[$i]["Sub_Title"],0,80, "utf-8")."...";
                        }else{
                        }
                        */
                        echo $arr[$i]["Sub_Title"];
                        ?>
                    </h4>
                </div>
            </a>
        <?php }?>    
    </div>

    
	<?php if($arr[$i+1]){
            $link=$wm->getLink($arr[$i+1]);
            ?>
	   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 item">
            <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+1]["Name"];?>">
                <?php if($arr[$i+1]["Top_Header"]){?>
                <img src="<?php echo $thumb_call.$arr[$i+1]["Top_Header"];?>" alt="<?php echo $arr[$i+1]["Name"];?>" title="<?php echo $arr[$i+1]["Name"];?>" class="img-responsive" />
                <?php } else { ?>
                <img src="<?php echo $cfg["WM"]["Server"]."/site/images/defaultLobi.jpg";?>" alt="<?php echo $arr[$i+1]["Name"];?>" title="<?php echo $arr[$i+1]["Name"];?>" class="img-responsive" />
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
</div>