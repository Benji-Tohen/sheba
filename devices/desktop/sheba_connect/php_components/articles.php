<?php 

$arrHomeEventsRelated = $wm->getConnectedPages($wmPage["ID"],"103,98,96,93,95,102,127,146","wm_connected_pages_ids.Ordering ASC","0,4");
$thumb_call_articles = $cfg["WM"]["Server"]."/webfiles/images/cache/270X180/zcX1/";

?>
<?php if(!empty($arrHomeEventsRelated)){ ?>
<div class="articles-section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2><?php echo $trans->getText('connect_Articles');?></h2>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="articles-items">
					<?php foreach ($arrHomeEventsRelated as $articleItemKey => $articleItem) { 
						$articleLink = $wm->getLink($articleItem);
					?>
						<a href="<?php echo $articleLink['Link']; ?>" target="<?php echo $articleLink['Target']; ?>" class="article-item">
							<div class="article-item-img-container">
								<div class="article-item-img-label"><?php echo $trans->getText("must_read");?></div>
								<img src="<?php echo $thumb_call_articles.$articleItem['Top_Header']; ?>" alt="<?php echo $articleItem['Name']; ?>" class="article-item-img img-fluid" />
								<span class="article-item-line"></span>
							</div>
							<span class="article-item-text"><?php echo $string->shorten($articleItem['Name'], 45, true); ?></span>
						</a>
					<?php } ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<a href="<?php echo $trans->getText("all_articles_link"); ?>" class="defaultBtn articles-all-link"><?php echo $trans->getText("All Articles"); ?></a>
			</div>
		</div>
	</div>
</div>
<?php }?>