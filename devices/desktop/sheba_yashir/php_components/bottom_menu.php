<?php $bottomMenu=$wm->getShowenMenuLevel($wm->getBottomMenuId($_SESSION["WM"]["Lang"])); ?>

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
	    </div>
	<?php }?>
</div>