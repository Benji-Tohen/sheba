<div class="row linksRow">
	<div class="col-12 col-sm-6 col-md-6 col-lg-6">
		<?php $link=$wm->getLink($arr[$i]);?>
		<div class="row linksItem">
			<div class="col-12 col-lg-4 linksItemImage">
			<?php if($arr[$i]["Top_Header"]){?>
				<a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">
					<img src="<?php echo $thumb_call.$arr[$i]["Top_Header"];?>" alt="<?php echo $arr[$i]["Name"];?>" title="<?php echo $arr[$i]["Name"];?>" class="img-fluid" />
				</a>
			<?php }?>
			</div>

			<div class="col-12 col-lg-8 linksItemText">
				<h2>
					<a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">
						<?php echo $arr[$i]["Name"];?>
					</a>
				</h2>
				<div class="linksItemSubTitle"><?php echo nl2br($arr[$i]["Sub_Title"]);?></div>	
			</div>
		</div>
	</div>

	<?php if($arr[$i+1]){?>
		<?php $link=$wm->getLink($arr[$i+1]);?>
		<div class="col-12 col-sm-6 col-md-6 col-lg-6">
			<div class="row linksItem">
				<div class="col-12 col-lg-4 linksItemImage">
				<?php if($arr[$i+1]["Top_Header"]){?>
					<a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+1]["Name"];?>">
						<img src="<?php echo $thumb_call.$arr[$i+1]["Top_Header"];?>" alt="<?php echo $arr[$i+1]["Name"];?>" title="<?php echo $arr[$i+1]["Name"];?>" class="img-fluid" />
					</a>
				<?php }?>
				</div>

				<div class="col-12 col-lg-8 linksItemText">
					<h2>
						<a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+1]["Name"];?>">
							<?php echo $arr[$i+1]["Name"];?>
						</a>
					</h2>
					<div class="linksItemSubTitle"><?php echo nl2br($arr[$i+1]["Sub_Title"]);?></div>	
				</div>
			</div>
		</div>
	<?php }?>
</div>
