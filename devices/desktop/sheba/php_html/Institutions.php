<?php $link=$wm->getLink($arr[$i]);?>
<a 
    href="<?php echo $link["Link"];?>" 
    target="<?php echo $link["Target"];?>" 
    title="<?php echo str_replace('"','&quot;',$arr[$i]["Name"]);?>" 
    class="d-flex justify-content-start item"
>  
    <!-- ITEM ICON -->
    <div class="wrapp-item-icon" >
        <div class="itemIcon"><i class="fas fa-chevron-<?php echo $gui->getRight();?>"></i></div>
    </div>
    <!-- ITEM TITLE -->
    <div class="itemText">
        <h3><?php echo $arr[$i]['Name'];?></h3>
    </div>
</a>
