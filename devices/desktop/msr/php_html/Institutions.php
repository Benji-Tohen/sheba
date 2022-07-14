<?php
$fromAjax = isset($fromAjax) ? $fromAjax: '';
 $link=$wm->getLink($arr[$i]);?>
<a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $string->htmlentities($arr[$i]["Name"]);?>" class="row item">  
    <!-- ITEM ICON -->
    <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">
        <div class="itemIcon"><i class="fa fa-map-marker"></i></div>
    </div>

    <!-- ITEM TITLE -->
    <div class="col-xs-7 col-sm-9 col-md-9 col-lg-9 itemText">
        <h3><?php echo $arr[$i]['Name'];?></h3>
        <?php if ($arr[$i]["Sub_Title"]) { ?><h5 class="subTitle"><?php echo nl2br($arr[$i]["Sub_Title"]);?></h5><?php } ?>
        <?php if ($fromAjax==1) { ?><h5><?php echo ($fromAjax == 1 ? strip_tags($nav):'')?></h5><?php } ?>
    </div>
    
    <!-- ITEM Arrow -->
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 itemArrow">
        <div class="clinicArrow"></div>
    </div>
    
</a>
