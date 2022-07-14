<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-offset-2 col-lg-offset-0 col-md-8 col-lg-6">
			<?php if($wmPage["Video_Embed"]){ ?>
				<iframe class="homepageVideo" width="100%" height="290" src="https://www.youtube.com/embed/<?php echo $wmPage["Video_Embed"];?>?autoplay=0&showinfo=0&controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			<?php } else { ?>
				<img src="<?php echo $thumb_call_inner.$wmPage['Top_Header2'];?>" alt="<?php echo $wmPage['Top_Header2_Alt'];?>" class="img-responsive" />
			<?php }?>

			<?php if($wmPage['Video_Text']){ ?>
				<?php if($wmPage['AudioFile']!=''){ ?>
				<a href="<?php echo $wmPage['AudioFile']?>" class="homepageVideoDesc"><?php echo $string->shorten($wmPage['Video_Text'], 38, false);?></a>
				<?php } else { ?>
				<div class="homepageVideoDesc"><?php echo $string->shorten($wmPage['Video_Text'], 38, false);?></div>
				<?php } ?>
			<?php }?>
		</div>

		<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-offset-2 col-lg-offset-0 col-md-8 col-lg-6">
			<div class="row">
				<div class="col-xs-12">
					<?php $homepageItemOneLink = $wm->getLink($homepageItemsArr[0]);?>
					<a href="<?php echo $homepageItemOneLink['Link'];?>" target="<?php echo $homepageItemOneLink['Target'];?>" class="homepageItemsBtnBig" style="background-image: url(<?php echo $homepageItemsArr[0]['Top_Header'];?>)">
						<?php 
							if(!$homepageItemsArr[0]['Top_Header']){
								echo $string->shorten($homepageItemsArr[0]["Name"], 54, false);
							}
						?>
					</a>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<?php $homepageItemTwoLink = $wm->getLink($homepageItemsArr[1]);?>
					<a href="<?php echo $homepageItemTwoLink['Link'];?>" target="<?php echo $homepageItemTwoLink['Target'];?>" class="homepageItemsBtn" style="background-image: url(<?php echo $homepageItemsArr[1]['Top_Header'];?>)">
						<?php 
							if(!$homepageItemsArr[1]['Top_Header']){
								echo $string->shorten($homepageItemsArr[1]["Name"], 54, false);
							}
						?>
					</a>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<?php $homepageItemThreeLink = $wm->getLink($homepageItemsArr[2]);?>
					<a href="<?php echo $homepageItemThreeLink['Link'];?>" target="<?php echo $homepageItemThreeLink['Target'];?>" class="homepageItemsBtn" style="background-image: url(<?php echo $homepageItemsArr[2]['Top_Header'];?>)">
						<?php 
							if(!$homepageItemsArr[2]['Top_Header']){
								echo $string->shorten($homepageItemsArr[2]["Name"], 54, false);
							}
						?>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>