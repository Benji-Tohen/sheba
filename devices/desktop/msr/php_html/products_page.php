	<div class="services">
		<?php $link=$wm->getLink($arr[$i]);?>
		<div class="servicesItemRight">
			<div class="servicesItemImage">
			<?php if($arr[$i]["Top_Header"]){?>
				<div class="servicesItemImageInner"><a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>"><img src="<?php echo $thumb_call.$arr[$i]["Top_Header"];?>" alt="<?php echo $arr[$i]["Name"];?>" /></a></div>
			<?php }?>
			</div>
			<div class="clear"></div>
			<div class="servicesItemText">
				<div class="servicesItemTextInner">
					<div class="servicesItemTitle"><h2><a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>"><?php echo $arr[$i]["Name"];?></a></h2></div>
					<div class="servicesItemSubTitle"><?php //echo nl2br($arr[$i]["Sub_Title"]);?></div>			
				</div>
				<div class="clear"></div>					
			</div>
		</div>


		<?php if($arr[$i+1]){?>
		<?php $link=$wm->getLink($arr[$i+1]);?>
		<div class="servicesItemCenter">
			<div class="servicesItemImage">
			<?php if($arr[$i+1]["Top_Header"]){?>
				<div class="servicesItemImageInner"><a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>"><img src="<?php echo $thumb_call.$arr[$i+1]["Top_Header"];?>" alt="<?php echo $arr[$i+1]["Name"];?>" /></a></div>
			<?php }?>
			</div>
			<div class="clear"></div>
			<div class="servicesItemText">
				<div class="servicesItemTextInner">
					<div class="servicesItemTitle"><h2><a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>"><?php echo $arr[$i+1]["Name"];?></a></h2></div>
					<div class="servicesItemSubTitle"><?php //echo nl2br($arr[$i+1]["Sub_Title"]);?></div>			
				</div>
				<div class="clear"></div>					
			</div>
		</div>
		<?php }?>

		<?php if($arr[$i+2]){?>
		<?php $link=$wm->getLink($arr[$i+2]);?>
		<div class="servicesItemLeft" onclick="document.location='<?php echo $link["Link"];?>';">
			<div class="servicesItemImage">
			<?php if($arr[$i+1]["Top_Header"]){?>
				<div class="servicesItemImageInner"><a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>"><img src="<?php echo $thumb_call.$arr[$i+2]["Top_Header"];?>" alt="<?php echo $arr[$i+2]["Name"];?>" /></a></div>
			<?php }?>
			</div>
			<div class="clear"></div>
			<div class="servicesItemText">
				<div class="servicesItemTextInner">
					<div class="servicesItemTitle"><h2><a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>"><?php echo $arr[$i+2]["Name"];?></a></h2></div>
					<div class="servicesItemSubTitle"><?php //echo nl2br($arr[$i+2]["Sub_Title"]);?></div>					
				</div>
				<div class="clear"></div>			
			</div>
		</div>
		<?php }?>

		<div class="clear"></div>
	</div>
