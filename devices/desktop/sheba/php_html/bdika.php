<?php $link=$wm->getLink($arr_connected_institute[$i]);?>
<a 
    href="<?php echo $link["Link"];?>" 
    target="<?php echo $link["Target"];?>" 
    title="<?php echo $arr_connected_institute[$i]["Name"];?>" 
    class="item"
>  
    <div class="row">
        <!-- ITEM ICON -->
        <div class="col-3 col-sm-2 col-md-2 col-lg-2">
            <div class="itemIcon"><i class="fas fa-map-marker"></i></div>
        </div>

        <!-- ITEM TITLE -->
        <div class="col-7 col-sm-9 col-md-9 col-lg-9 itemText">
            <h3><?php echo $arr_connected_institute[$i]['Name'];?></h3>
            <?php if ($arr_connected_institute[$i]["Sub_Title"]) { ?>
                <h5 class="subTitle">
                    <?php echo nl2br($arr_connected_institute[$i]["Sub_Title"]);?>
                </h5>
            <?php } ?>
            <?php if ($fromAjax==1) { ?>
                <h5>
                    <?php echo ($fromAjax == 1 ? strip_tags($nav):'')?>
                </h5>
            <?php } ?>
        </div>
        
        <!-- ITEM Arrow -->
        <div class="col-1 col-sm-1 col-md-1 col-lg-1 itemArrow">
            <div class="clinicArrow"></div>
        </div>
    </div>
</a>