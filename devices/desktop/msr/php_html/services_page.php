<div class="row twoItemsRow">
    <?php $link=$wm->getLink($arr[$i]);?>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 item">
        <?php if($arr[$i]["Top_Header"]){?>
            <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">
                <img src="<?php echo $thumb_call.$arr[$i]["Top_Header"];?>" alt="<?php echo $arr[$i]["Name"];?>" title="<?php echo $arr[$i]["Name"];?>" class="img-responsive" />
                <div class="titleOverlay">
                    <h4><?php echo $arr[$i]['Sub_Title'];?></h4>
                </div>
            </a>
        <?php }?>    
    </div>

    
	<?php if($arr[$i+1]){?>
	   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 item">
        <?php if($arr[$i+1]["Top_Header"]){?>
            <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+1]["Name"];?>">
                <img src="<?php echo $thumb_call.$arr[$i+1]["Top_Header"];?>" alt="<?php echo $arr[$i+1]["Name"];?>" title="<?php echo $arr[$i+1]["Name"];?>" class="img-responsive" />
                <div class="titleOverlay">
                    <h4><?php echo $arr[$i+1]['Sub_Title'];?></h4>
                </div>
            </a>
        <?php }?>
    </div>
	<?php }?>
</div>