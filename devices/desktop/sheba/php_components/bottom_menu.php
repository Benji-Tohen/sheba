<?php
$bottomMenuTitle=$wm->getShowenMenuLevel($wm->getBottomMenuId($_SESSION["WM"]["Lang"]));
foreach($bottomMenuTitle as $bottomMenuCategory){
    $categoryLinks=$wm->getShowenMenuLevel($bottomMenuCategory["ID"]);
    $countLinks=count($bottomMenuTitle);?>
        <div class="bottom-menu-category">
            <h5><?php echo $bottomMenuCategory['Name'];?></h5>
            <?php foreach($categoryLinks as $catlink){
                $link=$wm->getLink($catlink);?>
                <a name="bottom<?php echo $bottomL;?>" title="<?php echo $catlink["Name"];?>" href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" class="bottomMenuCategoryItem">
                    <?php echo $catlink["Name"];?>
                </a>
            <?php }?>
        </div>
<?php } ?>
