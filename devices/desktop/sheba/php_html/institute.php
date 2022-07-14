<?php
$fromAjax = isset($fromAjax) ? $fromAjax: '';
 $link=$wm->getLink($arr[$i]);?>
<a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $string->htmlentities($arr[$i]["Name"]);?>" class="row item institutions-item">  
    <?php /*
    <!-- ITEM ICON -->
    <div class="col-3 col-sm-2 col-md-2 col-lg-2">
        <div class="itemIcon"><i class="fa fa-plus"></i></div>
    </div>
    */ ?>

    <!-- ITEM TITLE -->
    <div class="col-8 col-sm-10 col-md-10 col-lg-10 itemText">
        <h3><?php echo $arr[$i]['Name'];?></h3>
        <?php /*
        <?php if ($arr[$i]["Sub_Title"]) { ?><h5 class="subTitle"><?php echo nl2br($arr[$i]["Sub_Title"]);?></h5><?php } ?>
        <?php if ($fromAjax==1) { ?><h5><?php echo ($fromAjax == 1 ? strip_tags($nav):'')?></h5><?php } ?>
        */ ?>
    </div>
    
    <!-- ITEM Arrow -->
    <div class="col-2 col-sm-2 col-md-2 col-lg-2 itemArrow">
        <i class="fa fa-angle-double-left"></i>
    </div>
</a>