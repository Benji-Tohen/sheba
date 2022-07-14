<?php $link=$wm->getLink($arr[$i]);?>
<div class="row item">  
    <!-- ITEM IMAGE -->
    <div class="col-12 col-md-5 col-lg-5 itemImage">
        <?php if($arr[$i]["Top_Header"]){?>
			<a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">
				<img src="<?php echo $thumb_call.$arr[$i]["Top_Header"];?>" alt="<?php echo $arr[$i]["Name"];?>" title="<?php echo $arr[$i]["Name"];?>" class="img-fluid" />
			</a>
		<?php }?>
    </div>

    <!-- ITEM TITLE -->
    <div class="col-12 col-md-7 col-lg-7 itemText">
        <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">
            <h3><?php echo $arr[$i]['Name'];?></h3>
            <h4><?php echo $arr[$i]["External_Sub_Title"] ? nl2br($arr[$i]["External_Sub_Title"]) : nl2br($arr[$i]["Sub_Title"]); ?></h4>
        </a>
    </div>
</div>
