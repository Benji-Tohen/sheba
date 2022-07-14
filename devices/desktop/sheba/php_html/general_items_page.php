<?php $link=$wm->getLink($arr[$i]);?>
<div class="container">
    <a 
        href="<?php echo ($clickableItem) ? $link["Link"] : '';?>" 
        target="<?php echo $link["Target"];?>" 
        title="<?php echo str_replace('"','&quot;',$arr[$i]["Name"]);?>" 
        class="row item <?php echo ($clickableItem) ? '' : 'notClickable';?> <?php echo $arr[$i]['Page_Type'] == 151?'link-item':''; ?>"
    > 
        <div class="row">
            <!-- ITEM ICON -->
            <?php if($arr[$i]["Top_Header"]){ ?>
                <div class="col-3 col-sm-4 col-md-2 col-lg-2 itemImage">
                    <img src="<?php echo $cfg["WM"]["Server"];?>/<?php echo $arr[$i]["Top_Header"];?>" alt="<?php echo str_replace('"','&quot;',$arr[$i]["Name"]);?>" class="img-fluid">
                </div>
            <?php } else if($arr[$i]['Page_Type'] != 151) {?>
                <div class="col-3 col-sm-4 col-md-2 col-lg-2">
                <div class="itemIcon"><i class="fas fa-angle-<?php echo $gui->getRight(); ?>"></i></div>
                </div>
            <?php }?>
        
            <!-- ITEM TITLE -->
            <?php if($arr[$i]['Page_Type'] != 151) {?>
                <div class="col-7 col-sm-7 col-md-9 col-lg-9 itemText">
        
                    <h3 ><?php echo $arr[$i]['Name'];?></h3>
                </div>
            <?php } else { ?>
                <div class="col-12 col-md-12 col-lg-12 itemText">
                    <h3 class="title-item"><?php echo $arr[$i]['Name'];?></h3>
                </div>
            <?php } ?>  
        </div> 
    </a>
</div>
