<?php
    if($wmPage["vertical_images"]==1){
        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."270"."X"."346"."/iarX1/";
        /*
        if($wmPage["Enable_SideContent"]){
            $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."270"."X"."346"."/iarX1/";
        }else{
            $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."325"."X"."346"."/iarX1/";
        }
        */
    } else {
        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."220"."X"."230"."/iarX1/";
    }

    if($arr[$i]["Top_Header"]){ $link=$wm->getLink($arr[$i]);?>
	<div class="col-6 col-sm-4 col-md-4 col-lg-4 item threeItemsRow">
        <?php if($arr[$i]["Top_Header"]){ ?>
            <a href="<?php echo ($clickableItem) ? $link["Link"] : '';?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>" class="<?php echo ($clickableItem) ? '' : 'notClickable';?>">
                <img src="<?php echo $thumb_call.$arr[$i]["Top_Header"];?>" alt="<?php echo $string->htmlentities($arr[$i]["Name"]);?>" title="<?php echo $string->htmlentities($arr[$i]["Name"]);?>" class="img-fluid" />
                <div class="titleOverlay">
                    <h4>
                        <?php /* echo ($arr[$i]["Sub_Title"]!='' ? $arr[$i]["Sub_Title"]: $arr[$i]["Name"]); */?>
                        <?php if ($arr[$i]["External_Sub_Title"]) {
                            echo $arr[$i]["External_Sub_Title"];
                        } else if ($arr[$i]["Sub_Title"]) {
                            echo $arr[$i]["Sub_Title"];
                        } else {
                            echo $arr[$i]["Name"];
                        } ?>
                    </h4>
                </div>
            </a>
        <?php }?>    
    </div>

    
	<?php }
        if(false && $arr[$i+1]){
            $link=$wm->getLink($arr[$i+1]);
        ?>
	    <div class="col-6 col-sm-4 col-md-4 col-lg-4 item">
        <?php if(!$arr[$i+1]["Top_Header"]){
            $arr[$i+1]["Top_Header"] = $db->getRow("SELECT wm_doctor_title.picture FROM wm_pages INNER JOIN wm_doctor_title ON wm_doctor_title.ID = wm_pages.wm_doctor_title WHERE wm_pages.ID =".$arr[$i+1]["ID"]);
        }?>
            <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+1]["Name"];?>">
                <img src="<?php echo $thumb_call.$arr[$i+1]["Top_Header"];?>" alt='<?php echo $string->htmlentities($arr[$i+1]["Name"]);?>' title="<?php echo $string->htmlentities($arr[$i+1]["Name"]);?>" class="img-fluid" />
                <div class="titleOverlay">
                    <h4>
                        <?php echo ($arr[$i+1]["Sub_Title"]!='' ? $arr[$i+1]["Sub_Title"]: $arr[$i+1]["Name"]);
                        ?>
                    </h4>
                </div>
            </a>
        </div>
	<?php }?>
    
    <?php if(false && $arr[$i+2]){
        $link=$wm->getLink($arr[$i+2]);
        ?>
	   <div class="col-6 col-sm-4 col-md-4 col-lg-4 item">
        <?php if($arr[$i+2]["Top_Header"]){?>
            <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+2]["Name"];?>">
                <img src="<?php echo $thumb_call.$arr[$i+2]["Top_Header"];?>" alt="<?php echo $string->htmlentities($arr[$i+2]["Name"]);?>" title="<?php echo $string->htmlentities($arr[$i+2]["Name"]);?>" class="img-fluid" />
                <div class="titleOverlay">
                    <h4>
                        <?php echo ($arr[$i+2]["Sub_Title"]!='' ? $arr[$i+2]["Sub_Title"]: $arr[$i+2]["Name"]);
                        ?>
                    </h4>
                </div>
            </a>
        <?php }?>
    </div>
	<?php }?>