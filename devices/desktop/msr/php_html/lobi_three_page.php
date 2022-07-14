<div class="row threeItemsRow">
    <?php


            echo "<div style='display: none;'>";
            echo "shery: ";
            echo "<pre>";
            print_r($wmPage["vertical_images"]);
            echo "</pre>";
            echo "</div>";
    
        if($wmPage["vertical_images"]==1){
            $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."270"."X"."346"."/iarX1/";
        } else {
            $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."380"."X"."227"."/iarX1/";
        }
    $link=$wm->getLink($arr[$i]);?>
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 item">
        <?php if($arr[$i]["Top_Header"]){ 

            ?>

            <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">
                <img src="<?php echo $thumb_call.$arr[$i]["Top_Header"];?>" alt="<?php echo $string->htmlentities($arr[$i]["Name"]);?>" title="<?php echo $string->htmlentities($arr[$i]["Name"]);?>" class="img-responsive" />
                <div class="titleOverlay">
                    <h4>
                        <?php
                        /*if(intval(mb_strlen($arr[$i]["Sub_Title"], 'UTF-8'))>43){
                        echo mb_substr($arr[$i]["Sub_Title"],0,500, "utf-8")."...";
                        }else{
                        
                        }*/echo ($arr[$i]["Sub_Title"]!='' ? $arr[$i]["Sub_Title"]: $arr[$i]["Name"]);?>
                    </h4>
                </div>
            </a>
        <?php }?>    
    </div>

    
	<?php if($arr[$i+1]){
            $link=$wm->getLink($arr[$i+1]);
            ?>
	   <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 item">
        <?php if(!$arr[$i+1]["Top_Header"]){
            $arr[$i+1]["Top_Header"] = $db->getRow("SELECT wm_doctor_title.picture FROM wm_pages INNER JOIN wm_doctor_title ON wm_doctor_title.ID = wm_pages.wm_doctor_title WHERE wm_pages.ID =".$arr[$i+1]["ID"]);
        }?>
            <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+1]["Name"];?>">
                <img src="<?php echo $thumb_call.$arr[$i+1]["Top_Header"];?>" alt='<?php echo $string->htmlentities($arr[$i+1]["Name"]);?>' title="<?php echo $string->htmlentities($arr[$i+1]["Name"]);?>" class="img-responsive" />
                <div class="titleOverlay">
                    <h4>
                        <?php /*
                        if(intval(mb_strlen($arr[$i+1]["Sub_Title"], 'UTF-8'))>43){
                        echo mb_substr($arr[$i+1]["Sub_Title"],0,500, "utf-8")."...";
                        }else{*/
                        echo ($arr[$i+1]["Sub_Title"]!='' ? $arr[$i+1]["Sub_Title"]: $arr[$i+1]["Name"]);
                        ?>
                    </h4>
                </div>
            </a>
        
    </div>
	<?php }?>
    
    <?php if($arr[$i+2]){
        $link=$wm->getLink($arr[$i+2]);
        ?>
	   <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 item">
        <?php if($arr[$i+2]["Top_Header"]){?>
            <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+2]["Name"];?>">
                <img src="<?php echo $thumb_call.$arr[$i+2]["Top_Header"];?>" alt="<?php echo $string->htmlentities($arr[$i+2]["Name"]);?>" title="<?php echo $string->htmlentities($arr[$i+2]["Name"]);?>" class="img-responsive" />
                <div class="titleOverlay">
                    <h4>
                        <?php
                        /*if(intval(mb_strlen($arr[$i+2]["Sub_Title"], 'UTF-8'))>43){
                        echo mb_substr($arr[$i+2]["Sub_Title"],0,500, "utf-8")."...";
                        }else{
                         } */ echo ($arr[$i+2]["Sub_Title"]!='' ? $arr[$i+2]["Sub_Title"]: $arr[$i+2]["Name"]);
                        ?>
                    </h4>
                </div>
            </a>
        <?php }?>
    </div>
	<?php }?>
</div>
