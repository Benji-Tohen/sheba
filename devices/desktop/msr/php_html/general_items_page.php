<?php $link=$wm->getLink($arr[$i]);?>
<a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo str_replace('"','&quot;',$arr[$i]["Name"]);?>" class="row item">  
    <!-- ITEM ICON -->
    <?php if($arr[$i]["Top_Header"]){?>
    <div class="col-xs-4 col-sm-4 col-md-2 col-lg-2 itemImage">
        <img src="<?php echo $cfg["WM"]["Server"];?>/<?php echo $arr[$i]["Top_Header"];?>" alt="<?php echo str_replace('"','&quot;',$arr[$i]["Name"]);?>" class="img-responsive">
    </div>
    <?php } else {?>
        <div class="col-xs-4 col-sm-4 col-md-2 col-lg-2">
            <div class="itemIcon"><i class="fa fa-plus"></i></div>
        </div>
    <?php }?>

    <!-- ITEM TITLE -->
    <div class="col-xs-7 col-sm-7 col-md-9 col-lg-9 itemText">
        <h3><?php echo $arr[$i]['Name'];?></h3>
	<?php if ($arr[$i]["Sub_Title"]) { ?>
        <h5 class="subTitle">
            <?php
            if(intval(mb_strlen($arr[$i]["Sub_Title"], 'UTF-8'))>293){
            echo mb_substr($arr[$i]["Sub_Title"],0,290, "utf-8")."...";
            }else{
            echo $arr[$i]["Sub_Title"];
            }?>
        </h5>
	<?php } ?>
        <h5><?php echo strip_tags($nav);?></h5>
    </div>
    
    <!-- ITEM Arrow -->
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 itemArrow">
        <div class="clinicArrow"></div>
    </div>
    
</a>
