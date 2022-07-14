<?php
	$bottomMenu=$wm->getShowenMenuLevel($wm->getBottomMenuId($_SESSION["WM"]["Lang"]));
	$footerItemsID = $wm->getIdByPageType(129);
	$footerItemsArr = $wm->getMenuLevel($footerItemsID);
?>

<div class="row">
	<?php foreach($bottomMenu as $key => $bottomMenuCategory){?>
	    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 menuFolder">
            <?php 
	            $categoryLinks=$wm->getShowenMenuLevel($bottomMenuCategory["ID"]);
            ?>
            <div class="bmCategoryName"><?php echo $bottomMenuCategory["Name"];?></div>
            <?php foreach($categoryLinks as $catlink){
                $link=$wm->getLink($catlink);
            ?>
	            <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" class="bmLink">
	                <?php echo $catlink["Name"];?>
	            </a>
            <?php }?>

            <?php if($key == 3){ ?>
	            <?php foreach ($footerItemsArr as $key => $footerItem) {
	            	$link = $wm->getLink($footerItem);
	            	?>
	            	<a href="<?php echo $link['Link'];?>" target="<?php echo $link['Target'];?>" title="<?php echo $footerItem['Name'];?>" class="footerItem"><?php echo $footerItem['Name'];?></a>
	            <?php }?>
            <?php }?>
	    </div>
	<?php }?>
</div>