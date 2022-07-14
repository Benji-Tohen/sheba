<div class="row teamRow">
	<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
		<?php $link=$wm->getLink($arr[$i]);?>
		<div class="teamItem">
			<div class="teamItemImage">
				<?php if($arr[$i]["Top_Header"]){?>
					<a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">
						<img src="<?php echo $thumb_call.$arr[$i]["Top_Header"];?>" alt="<?php echo $arr[$i]["Name"];?>" title="<?php echo $arr[$i]["Name"];?>" class="img-responsive" />
					</a>
				<?php }?>
			</div>
			<h2>
				<a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">
					<?php echo $arr[$i]["Name"];?>
				</a>
			</h2>
			<div class="teamItemSubTitle"><?php echo nl2br($arr[$i]["Sub_Title"]);?></div>	
		</div>
	</div>

	<?php if($arr[$i+1]){?>
		<?php $link=$wm->getLink($arr[$i+1]);?>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
			<div class="teamItem">
				<div class="teamItemImage">
					<?php if($arr[$i+1]["Top_Header"]){?>
						<a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+1]["Name"];?>">
							<img src="<?php echo $thumb_call.$arr[$i+1]["Top_Header"];?>" alt="<?php echo $arr[$i+1]["Name"];?>" title="<?php echo $arr[$i+1]["Name"];?>" class="img-responsive" />
						</a>
					<?php }?>
				</div>

				<div class="caption teamItemText">
					<h2>
						<a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+1]["Name"];?>">
							<?php echo $arr[$i+1]["Name"];?>
						</a>
					</h2>
					<div class="teamItemSubTitle"><?php echo nl2br($arr[$i+1]["Sub_Title"]);?></div>	
				</div>
			</div>
		</div>
	<?php }?>

	<?php if($arr[$i+2]){?>
		<?php $link=$wm->getLink($arr[$i+2]);?>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
			<div class="teamItem">
				<div class="teamItemImage">
					<?php if($arr[$i+2]["Top_Header"]){?>
						<a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+2]["Name"];?>">
							<img src="<?php echo $thumb_call.$arr[$i+2]["Top_Header"];?>" alt="<?php echo $arr[$i+2]["Name"];?>" title="<?php echo $arr[$i+2]["Name"];?>" class="img-responsive" />
						</a>
					<?php }?>
				</div>

				<div class="caption teamItemText">
					<h2>
						<a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+2]["Name"];?>">
							<?php echo $arr[$i+2]["Name"];?>
						</a>
					</h2>
					<div class="teamItemSubTitle"><?php echo nl2br($arr[$i+2]["Sub_Title"]);?></div>	
				</div>
			</div>
		</div>
	<?php }?>

	<?php if($arr[$i+3]){?>
		<?php $link=$wm->getLink($arr[$i+3]);?>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
			<div class="teamItem">
				<div class="teamItemImage">
					<?php if($arr[$i+3]["Top_Header"]){?>
						<a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+3]["Name"];?>">
							<img src="<?php echo $thumb_call.$arr[$i+3]["Top_Header"];?>" alt="<?php echo $arr[$i+3]["Name"];?>" title="<?php echo $arr[$i+3]["Name"];?>" class="img-responsive" />
						</a>
					<?php }?>
				</div>

				<div class="caption teamItemText">
					<h2>
						<a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+3]["Name"];?>">
							<?php echo $arr[$i+3]["Name"];?>
						</a>
					</h2>
					<div class="teamItemSubTitle"><?php echo nl2br($arr[$i+3]["Sub_Title"]);?></div>	
				</div>
			</div>
		</div>
	<?php }?>
</div>
