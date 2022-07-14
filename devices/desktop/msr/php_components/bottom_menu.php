<?php

$bottomMenu=$wm->getShowenMenuLevel($wm->getBottomMenuId($_SESSION["WM"]["Lang"]));
$i=0;
$bottomL = 1;
?>
<?php foreach($bottomMenu as $bottomMenuCategory){
    $categoryLinks=$wm->getShowenMenuLevel($bottomMenuCategory["ID"]);
    $countLinks=count($categoryLinks);
    ?>
<?php //if($i<$countLinks+1){?>
<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 bottomMenuCategory">
    
    <h5 class="bottomMenuCategoryTitle"><?php echo $bottomMenuCategory['Name']; ?></h5>
    <?php
    foreach($categoryLinks as $catlink){
    $link=$wm->getLink($catlink);
    ?>
    <a name="bottom<?php echo $bottomL;?>" href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" class="bottomMenuCategoryItem">
        <h5><?php echo $catlink["Name"];?></h5>
    </a>
    <?php $bottomL++; ?>
    <?php }?>
</div>
<?php //}
    $i++;}?>
