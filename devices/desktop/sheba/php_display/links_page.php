<div class="container">
	<div class="pageTitle"><h1><?php echo $wmPage["h1"];?></h1></div>
	<?php require_once(dirname(__FILE__)."/../php_components/news_text.php");?>
	<div class="linksPageAll">
		<?php for($i=0;$i<count($arr);$i=($i+2)){?>
		<?php $link=$wm->getLink($arr[$i]);?>
			<?php include(dirname(__FILE__)."/../php_html/".$wmPage["Type"]["Page"]);?>
		<?php }?>
		<?php require_once(dirname(__FILE__)."/../php_components/more.php");?>
	</div>
</div>